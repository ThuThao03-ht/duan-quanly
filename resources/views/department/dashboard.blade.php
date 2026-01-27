@extends('layout.department')

@section('title', 'Tổng quan - Department Portal')

@section('content')
<style>
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .badge-success {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #d1fae5;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .badge-warning {
        background: #fff7ed;
        color: #ea580c;
        border: 1px solid #ffedd5;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .chart-bar {
        border-radius: 12px 12px 0 0;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .chart-bar:hover {
        transform: scaleY(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .btn-primary {
        background: #4f46e5;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
    }
    
    .btn-primary:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <p class="text-muted mb-0" style="font-size: 0.875rem;">Dữ liệu hiệu suất và quản lý đơn hàng theo thời gian thực của bộ phận.</p>
    </div>

    <!-- Main Grid: Left Stats (1/3) + Right Chart (2/3) -->
    <div class="row g-4 mb-4">
        <!-- Left Column: 3 Stats Cards Stacked -->
        <div class="col-12 col-md-4">
            <div class="d-flex flex-column gap-4 h-100">
                <!-- Card 1: Tổng đơn hàng -->
                <div class="stat-card flex-fill">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon" style="background-color: #e0e7ff;">
                            <svg width="32" height="32" style="color: #4f46e5;" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.4" d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z" fill="currentColor"/>
                                <path d="M15.5 12.5H12C11.59 12.5 11.25 12.16 11.25 11.75V8.25C11.25 7.84 11.59 7.5 12 7.5H15.5C15.91 7.5 16.25 7.84 16.25 8.25V11.75C16.25 12.16 15.91 12.5 15.5 12.5ZM12.75 11H14.75V9H12.75V11ZM8.5 12.5H8C7.59 12.5 7.25 12.16 7.25 11.75C7.25 11.34 7.59 11 8 11H8.5C8.91 11 9.25 11.34 9.25 11.75C9.25 12.16 8.91 12.5 8.5 12.5ZM11.5 16.5H8C7.59 16.5 7.25 16.16 7.25 15.75V15.25C7.25 14.84 7.59 14.5 8 14.5H11.5C11.91 14.5 12.25 14.84 12.25 15.25V15.75C12.25 16.16 11.91 16.5 11.5 16.5ZM16.5 16.5H14.5C14.09 16.5 13.75 16.16 13.75 15.75C13.75 15.34 14.09 15 14.5 15H16.5C16.91 15 17.25 15.34 17.25 15.75C17.25 16.16 16.91 16.5 16.5 16.5Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="text-muted mb-2" style="font-size: 0.875rem; font-weight: 600;">Tổng đơn hàng</h6>
                    <h2 class="mb-0" style="font-size: 2.25rem; font-weight: 800; color: #1e293b;">{{ number_format($totalRequests) }}</h2>
                </div>

                <!-- Card 2: Cần xử lý -->
                <div class="stat-card flex-fill">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon" style="background-color: #ffedd5;">
                            <svg width="32" height="32" style="color: #ea580c;" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.4" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"/>
                                <path d="M12.75 7.75C12.75 7.33579 12.4142 7 12 7C11.5858 7 11.25 7.33579 11.25 7.75V11.25H7.75C7.33579 11.25 7 11.5858 7 12C7 12.4142 7.33579 12.75 7.75 12.75H12.75V7.75Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="badge-warning">Đang xử lý</span>
                    </div>
                    <h6 class="text-muted mb-2" style="font-size: 0.875rem; font-weight: 600;">Đang xử lý</h6>
                    <h2 class="mb-0" style="font-size: 2.25rem; font-weight: 800; color: #1e293b;">
                        {{ number_format($pendingRequests) }}/{{ number_format($totalRequests) }}
                    </h2>
                </div>

                <!-- Card 3: Hoàn thành -->
                <div class="stat-card flex-fill">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon" style="background-color: #dcfce7;">
                            <svg width="32" height="32" style="color: #15803d;" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.4" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="currentColor"/>
                                <path d="M16.0303 8.96967C16.3232 9.26256 16.3232 9.73744 16.0303 10.0303L11.0303 15.0303C10.7374 15.3232 10.2626 15.3232 9.96967 15.0303L7.96967 13.0303C7.67678 12.7374 7.67678 12.2626 7.96967 11.9697C8.26256 11.6768 8.73744 11.6768 9.03033 11.9697L10.5 13.4393L14.9697 8.96967C15.2626 8.67678 15.7374 8.67678 16.0303 8.96967Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="badge-success">Hoàn thành</span>
                    </div>
                    <h6 class="text-muted mb-2" style="font-size: 0.875rem; font-weight: 600;">Đã hoàn thành</h6>
                    <h2 class="mb-0" style="font-size: 2.25rem; font-weight: 800; color: #1e293b;">
                        {{ number_format($completedRequests) }}/{{ number_format($totalRequests) }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Right Column: Large Trend Chart (2/3) -->
        <div class="col-12 col-md-8">
            <div class="stat-card d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1" style="font-weight: 700; color: #1e293b;">Xu hướng đơn hàng năm {{ $selectedYear }}</h5>
                        <p class="text-muted mb-0" style="font-size: 0.75rem;">Thống kê theo tháng</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form method="GET" action="{{ route('department.dashboard') }}" class="d-flex align-items-center gap-2">
                            <select name="year" class="form-select form-select-sm" style="width: auto; border-color: #e2e8f0; font-weight: 500;" onchange="this.form.submit()">
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </form>
                        <button class="btn btn-sm" style="background: #e0e7ff; color: #4f46e5; border: 1px solid #e0e7ff; font-weight: 600;">
                            Export
                        </button>
                    </div>
                </div>


                <!-- Bar Chart -->
                <div class="d-flex align-items-end justify-content-between gap-2 px-3" style="height: 300px; border-bottom: 1px solid #f1f5f9;">
                    @php
                        $months = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'];
                        $gradients = [
                            'linear-gradient(to top, #8b5cf6, #6366f1)',
                            'linear-gradient(to top, #60a5fa, #3b82f6)',
                            'linear-gradient(to top, #818cf8, #a855f7)',
                            'linear-gradient(to top, #38bdf8, #818cf8)',
                            'linear-gradient(to top, #a855f7, #d946ef)',
                            'linear-gradient(to top, #a78bfa, #c084fc)',
                            'linear-gradient(to top, #f472b6, #ec4899)',
                            'linear-gradient(to top, #fb923c, #f97316)',
                            'linear-gradient(to top, #fbbf24, #f59e0b)',
                            'linear-gradient(to top, #34d399, #10b981)',
                            'linear-gradient(to top, #60a5fa, #3b82f6)',
                            'linear-gradient(to top, #cbd5e1, #94a3b8)'
                        ];
                        $colors = ['#6366f1', '#3b82f6', '#a855f7', '#818cf8', '#d946ef', '#c084fc', '#ec4899', '#f97316', '#f59e0b', '#10b981', '#3b82f6', '#94a3b8'];
                        
                        // Tính chiều cao tương đối (max = 100%)
                        $maxCount = max($chartData) ?: 1;
                    @endphp
                    @foreach($months as $index => $month)
                        @php
                            $count = (int)$chartData[$index];
                            $heightPx = 0;
                            
                            if ($count > 0) {
                                // Tính chiều cao theo pixel (max = 180px)
                                $heightPx = ($count / $maxCount) * 180;
                                if ($heightPx < 40) {
                                    $heightPx = 40; // Minimum 40px để dễ nhìn thấy
                                }
                            }
                            
                            // Dùng màu xanh dương gradient cho tất cả
                            $barGradient = 'linear-gradient(to top, #3b82f6, #60a5fa)';
                        @endphp
                        <div class="flex-fill d-flex flex-column align-items-center gap-2">
                            @if($count > 0)
                                <div class="chart-bar" style="width: 100%; max-width: 40px; height: {{ $heightPx }}px; background: {{ $barGradient }};" title="{{ $count }} đơn"></div>
                            @else
                                <div style="width: 100%; max-width: 40px; height: 40px; background: transparent;" title="0 đơn"></div>
                            @endif
                            <span style="font-size: 0.7rem; font-weight: 700; color: #3b82f6;">{{ $month }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Legend -->
                <div class="d-flex justify-content-center gap-4 mt-3">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 12px; height: 12px; border-radius: 50%; background: #4f46e5;"></div>
                        <span style="font-size: 0.75rem; color: #64748b;">Đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer & Orders List -->
    <div class="stat-card">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h5 class="mb-0" style="font-weight: 700; color: #1e293b;">Danh sách khách hàng & Đơn hàng</h5>
            <div class="d-flex align-items-center gap-3">
                <select class="form-select form-select-sm" style="width: auto; border-color: #e2e8f0; font-weight: 500;">
                    <option>Lọc nhanh...</option>
                    <option>Hoàn thành</option>
                    <option>Đang xử lý</option>
                </select>
                <a href="{{ route('department.orders.index') }}" class="text-decoration-none d-flex align-items-center gap-1" style="color: #4f46e5; font-weight: 600; font-size: 0.875rem;">
                    Xem tất cả
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        @if($recentRequests->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f8fafc;">
                        <tr>
                            <th class="text-uppercase" style="font-size: 0.75rem; font-weight: 600; color: #64748b; letter-spacing: 0.05em;">Khách hàng</th>
                            <th class="text-uppercase" style="font-size: 0.75rem; font-weight: 600; color: #64748b; letter-spacing: 0.05em;">Ngày tạo</th>
                            <th class="text-uppercase" style="font-size: 0.75rem; font-weight: 600; color: #64748b; letter-spacing: 0.05em;">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentRequests as $request)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @php
                                        $bgColors = ['#3b82f6', '#f97316', '#a855f7', '#22c55e', '#ec4899', '#6366f1'];
                                        $randomBg = $bgColors[array_rand($bgColors)];
                                        $name = $request->department->name ?? 'N/A';
                                        $nameParts = explode(' ', $name);
                                        $initials = count($nameParts) >= 2 
                                            ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                                            : strtoupper(substr($name, 0, 2));
                                    @endphp
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px; background: {{ $randomBg }}; font-weight: 600; font-size: 0.875rem;">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #1e293b; font-size: 0.875rem;">{{ $name }}</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">ORD-{{ str_pad($request->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="color: #475569; font-size: 0.875rem;">{{ $request->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($request->status == 'Hoàn thành')
                                    <span class="badge" style="background: #dcfce7; color: #15803d; font-weight: 600; padding: 0.375rem 0.75rem;">HOÀN THÀNH</span>
                                @elseif($request->status == 'Đang xử lý')
                                    <span class="badge" style="background: #ffedd5; color: #ea580c; font-weight: 600; padding: 0.375rem 0.75rem;">ĐANG XỬ LÝ</span>
                                @elseif($request->status == 'Từ chối')
                                    <span class="badge" style="background: #fee2e2; color: #b91c1c; font-weight: 600; padding: 0.375rem 0.75rem;">ĐÃ HỦY</span>
                                @else
                                    <span class="badge" style="background: #dbeafe; color: #1d4ed8; font-weight: 600; padding: 0.375rem 0.75rem;">ĐÃ GỬI HÀNG</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <div class="empty-state-icon">
                    <svg width="40" height="40" fill="none" stroke="#cbd5e1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h6 class="mb-3" style="color: #64748b; font-weight: 500;">Chưa có đơn hàng nào</h6>
                <p class="text-muted mb-4" style="font-size: 0.875rem;">Hiện tại chưa có dữ liệu giao dịch nào được ghi nhận cho bộ phận này.</p>
                <a href="{{ route('department.orders.index') }}" class="btn btn-primary">
                    Tạo đơn hàng mới
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
