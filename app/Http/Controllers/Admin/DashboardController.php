<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $selectedYear = $request->get('year', $now->year);
        $month = $now->month;

        // --- 1. THỐNG KÊ TỔNG QUAN THEO NĂM (CHO CÁC THẺ) ---
        // Tổng PR trong năm mục tiêu
        $totalYear = PurchaseRequest::whereHas('timeline', function($q) use ($selectedYear) {
            $q->whereYear('pr_received_date', $selectedYear);
        })->count();

        // Hoàn thành trong năm
        $completedYear = PurchaseRequest::whereHas('timeline', function($q) use ($selectedYear) {
            $q->whereYear('pr_received_date', $selectedYear);
        })->where('status', 'Hoàn thành')->count();

        // Đang xử lý trong năm (Mọi trạng thái khác Hoàn thành)
        $processingYear = $totalYear - $completedYear;


        // --- 2. DỮ LIỆU BIỂU ĐỒ XU HƯỚNG THEO THÁNG (LINE CHART) ---
        $monthlyProcessing = [];
        $monthlyCompleted = [];
        $monthlyTotal = [];
        
        for ($m = 1; $m <= 12; $m++) {
            // Đếm PR nhận được trong tháng m của năm được chọn
            $baseQuery = PurchaseRequest::whereHas('timeline', function($q) use ($m, $selectedYear) {
                $q->whereMonth('pr_received_date', $m)
                  ->whereYear('pr_received_date', $selectedYear);
            });

            $totalM = (clone $baseQuery)->count();
            $completedM = (clone $baseQuery)->where('status', 'Hoàn thành')->count();
            
            $monthlyTotal[] = $totalM;
            $monthlyCompleted[] = $completedM;
            $monthlyProcessing[] = $totalM - $completedM;
        }


        // --- 3. DỮ LIỆU BIỂU ĐỒ PHÂN BỔ (DONUT CHART) ---
        // Chúng ta lấy dữ liệu YTD (Year-to-Date) để khớp với các thẻ thống kê phía trên
        $totalChart = $totalYear;
        $completedChart = $completedYear;
        $processingChart = $processingYear;


        // --- 4. DANH SÁCH CÁC NĂM ĐỂ LỌC ---
        $years = \App\Models\PrTimeline::whereNotNull('pr_received_date')
            ->selectRaw('YEAR(pr_received_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        
        if ($years->isEmpty()) {
            $years = collect([$now->year]);
        }

        return view('admin.dashboard', compact(
            'totalYear', 
            'processingYear', 
            'completedYear',
            'totalChart',
            'completedChart',
            'processingChart',
            'monthlyProcessing',
            'monthlyCompleted',
            'monthlyTotal',
            'month',
            'selectedYear',
            'years'
        ));
    }
}
