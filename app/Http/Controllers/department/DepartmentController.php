<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function dashboard(Request $request)
    {
        // Lấy department_id của user đang đăng nhập
        $departmentId = Auth::user()->department_id;
        
        // Thống kê tổng quan - chỉ của department này
        $totalRequests = PurchaseRequest::where('department_id', $departmentId)->count();
        $pendingRequests = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Đang xử lý')
            ->count();
        $completedRequests = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Hoàn thành')
            ->count();
        $rejectedRequests = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Từ chối')
            ->count();
        
        
        // Lấy dữ liệu biểu đồ theo tháng
        $selectedYear = $request->input('year', date('Y'));
        
        // Lấy danh sách các năm có dữ liệu
        $availableYears = \DB::table('purchase_requests')
            ->where('department_id', $departmentId)
            ->selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
        
        // Nếu không có năm nào, thêm năm hiện tại
        if (empty($availableYears)) {
            $availableYears = [date('Y')];
        }
        
        // Lấy dữ liệu theo tháng cho năm được chọn
        $monthlyData = \DB::table('purchase_requests')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('department_id', $departmentId)
            ->whereYear('created_at', $selectedYear)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Chuẩn bị dữ liệu cho 12 tháng (mặc định là 0 nếu không có dữ liệu)
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyData[$i] ?? 0;
        }
        
        
        
        
        // Lấy dữ liệu phân bổ trạng thái cho biểu đồ tròn
        $statusDistribution = PurchaseRequest::where('department_id', $departmentId)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
            
        // Đảm bảo đủ các trạng thái chính
        $statuses = ['Đang xử lý', 'Hoàn thành', 'Từ chối'];
        $pieChartData = [];
        foreach ($statuses as $status) {
            $pieChartData[] = $statusDistribution[$status] ?? 0;
        }

        // Lấy 5 yêu cầu mới nhất của department này
        $recentRequests = PurchaseRequest::with(['department', 'creator'])
            ->where('department_id', $departmentId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('department.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'completedRequests',
            'rejectedRequests',
            'recentRequests',
            'chartData',
            'selectedYear',
            'availableYears',
            'pieChartData'
        ));
    }
}
