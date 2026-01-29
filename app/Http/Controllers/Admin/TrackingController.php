<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PurchaseRequest;
use App\Models\PrTimeline;
use App\Models\Department;
use App\Models\User;
use App\Exports\PurchaseRequestsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class TrackingController extends Controller
{
    public function index()
    {
        $requests = PurchaseRequest::with(['department', 'timeline', 'notes' => function($q) {
            $q->where('note_type', 'department')->orderBy('created_at', 'desc');
        }])->orderBy('id', 'desc')->get();
        $departments = \App\Models\Department::all();
        return view('admin.tracking', compact('requests', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'nullable|string',
            'delivery_note' => 'nullable|string',
            'reason' => 'nullable|string',
            'department_note' => 'nullable|string',
            'pr_received_date' => 'nullable|date',
            'pr_approved_date' => 'nullable|date',
            'quotation_date' => 'nullable|date',
            'po_created_date' => 'nullable|date',
            'po_approved_date' => 'nullable|date',
            'contract_signed_date' => 'nullable|date',
            'goods_received_date' => 'nullable|date',
        ]);

        $deptId = $request->input('department_id');
        
        // If department_id is not numeric, it's a new department name
        if ($deptId && !is_numeric($deptId)) {
            $deptName = trim($deptId);
            $department = Department::where('name', $deptName)->first();
            
            if (!$department) {
                // Create Department
                $department = Department::create([
                    'name' => $deptName,
                    'code' => $this->generateInitials($deptName)
                ]);
                
                // Create User for this department
                $username = strtolower($department->code);
                
                // Ensure unique username
                $originalUsername = $username;
                $count = 1;
                while (User::where('name', $username)->exists()) {
                    $username = $originalUsername . $count;
                    $count++;
                }

                User::create([
                    'name' => $username,
                    'password' => '123456', // Fixed password as requested
                    'role' => 'department',
                    'department_id' => $department->id,
                ]);
            }
            $deptId = $department->id;
        }

        $pr = PurchaseRequest::create([
            'department_id' => $deptId ?: null,
            'content' => $validated['content'],
            'status' => $validated['status'] ?: 'Đang xử lý',
            'delivery_note' => $validated['delivery_note'] ?: null,
            'reason' => $validated['reason'] ?: null,
            'department_note' => $validated['department_note'] ?: null,
            'created_by' => auth()->id(),
        ]);

        $timelineFields = [
            'pr_received_date', 'pr_approved_date', 'quotation_date', 
            'po_created_date', 'po_approved_date', 'contract_signed_date', 
            'goods_received_date'
        ];

        $timelineData = $request->only($timelineFields);
        foreach ($timelineData as $key => $value) {
            if (!$value) $timelineData[$key] = null;
        }

        $pr->timeline()->create($timelineData);

        return response()->json([
            'success' => true,
            'data' => $pr->load(['department', 'timeline'])
        ]);
    }

  public function update(Request $request, $id)
{
    $pr = PurchaseRequest::findOrFail($id);

    $field = $request->input('field');
    $value = $request->input('value');

    $prFields = ['content', 'status', 'delivery_note', 'reason', 'department_note'];

    $timelineFields = [
        'pr_received_date', 'pr_approved_date', 'quotation_date',
        'po_created_date', 'po_approved_date', 'contract_signed_date',
        'goods_received_date'
    ];

    if (in_array($field, $prFields)) {
        $pr->update([$field => $value]);
    }
    elseif (in_array($field, $timelineFields)) {

        
        if ($value) {
            try {
                $value = Carbon::parse($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ngày không hợp lệ'
                ], 422);
            }
        }

        if ($field === 'contract_signed_date' && $value) {
            $pr->update(['is_contract_required' => true]);
        }

        $timeline = $pr->timeline ?: $pr->timeline()->create([
            'purchase_request_id' => $pr->id
        ]);

        $timeline->update([
            $field => $value ?: null
        ]);
    }

    return response()->json(['success' => true]);
}

    public function export(Request $request)
    {
        $filters = [
            'status' => $request->status,
            'month' => $request->month,
            'year' => $request->year,
        ];

        $fileName = 'thong_ke_mua_hang_' . date('Ymd_His') . '.xlsx';
        
        return Excel::download(new PurchaseRequestsExport($filters), $fileName);
    }

    private function generateInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $w) {
            $initials .= mb_substr($w, 0, 1);
        }
        return mb_strtolower($initials, 'UTF-8');
    }
}
