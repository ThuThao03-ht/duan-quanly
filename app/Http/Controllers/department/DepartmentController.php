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
        
        // Lấy dữ liệu biểu đồ theo tháng
        $selectedYear = $request->input('year', date('Y'));
        
        // Thống kê tổng quan - chỉ của department này theo năm được chọn
        $totalRequests = PurchaseRequest::where('department_id', $departmentId)
            ->whereYear('created_at', $selectedYear)
            ->count();
        $pendingRequests = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Đang xử lý')
            ->whereYear('created_at', $selectedYear)
            ->count();
        $completedRequests = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Hoàn thành')
            ->whereYear('created_at', $selectedYear)
            ->count();
        $rejectedRequests = PurchaseRequest::where('department_id', $departmentId)
            ->where('status', 'Từ chối')
            ->whereYear('created_at', $selectedYear)
            ->count();
        
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
        
        // Lấy dữ liệu phân bổ trạng thái cho biểu đồ tròn theo năm được chọn
        $statusDistribution = PurchaseRequest::where('department_id', $departmentId)
            ->whereYear('created_at', $selectedYear)
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
    public function guide()
    {
        return view('department.guide');
    }

    public function changePassword()
    {
        return view('department.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $user = Auth::user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->password = \Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
