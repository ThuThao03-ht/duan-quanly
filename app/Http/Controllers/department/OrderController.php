<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index(Request $request)
    {
        // Lấy department_id của user đang đăng nhập
        $departmentId = Auth::user()->department_id;
        
        // Chỉ lấy đơn hàng của department này
        $query = PurchaseRequest::with(['department', 'creator', 'notes'])
            ->where('department_id', $departmentId);

        // Lọc theo trạng thái
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('content', 'like', '%' . $request->search . '%')
                  ->orWhereHas('department', function($dept) use ($request) {
                      $dept->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // Đếm số lượng theo trạng thái để hiển thị trên tab
        $processingCount = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Đang xử lý')
            ->count();
            
        $completedCount = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Hoàn thành')
            ->count();

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('department.orders.index', compact('orders', 'processingCount', 'completedCount'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show($id)
    {
        // Lấy department_id của user đang đăng nhập
        $departmentId = Auth::user()->department_id;
        
        // Chỉ cho phép xem đơn hàng của department mình
        $order = PurchaseRequest::with(['department', 'creator', 'timeline', 'notes.user'])
            ->where('department_id', $departmentId)
            ->findOrFail($id);

        return view('department.orders.show', compact('order'));
    }

    // Thêm ghi chú vào đơn hàng
    public function addNote(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Lấy department_id của user đang đăng nhập
        $departmentId = Auth::user()->department_id;
        
        // Chỉ cho phép thêm ghi chú vào đơn hàng của department mình
        $order = PurchaseRequest::where('department_id', $departmentId)
            ->findOrFail($id);

        Note::create([
            'purchase_request_id' => $order->id,
            'user_id' => Auth::id(),
            'note_type' => 'department',
            'content' => $request->content,
        ]);

        return redirect()->route('department.orders.show', $id)
            ->with('success', 'Đã thêm ghi chú thành công!');
    }
}
