<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PurchaseRequest;
use App\Models\PrTimeline;

class TrackingController extends Controller
{
    public function index()
    {
        $requests = PurchaseRequest::with(['department', 'timeline'])->orderBy('id', 'desc')->get();
        $departments = \App\Models\Department::all();
        return view('admin.tracking', compact('requests', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
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

        $pr = PurchaseRequest::create([
            'department_id' => $validated['department_id'] ?: null,
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
}
