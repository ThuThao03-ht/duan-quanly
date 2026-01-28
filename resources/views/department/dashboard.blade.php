@extends('layouts.department')

@section('title', 'Tổng quan - Department Portal')

@section('header-title', 'Tổng quan Phân tích')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
        transition: all 0.3s;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .progress-bar-container {
        height: 4px;
        width: 100%;
        background: #f1f5f9;
        border-radius: 2px;
        margin-top: 1rem;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 2px;
    }
    
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
    }

    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-action {
        border: 1px solid #e2e8f0;
        background: white;
        color: #4f46e5;
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-action:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
</style>

<div class="container-fluid">
    <!-- Stats Row -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Tổng đơn hàng -->
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: #e0e7ff; color: #4f46e5;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h6 class="text-muted mb-2" style="font-size: 0.875rem;">Tổng đơn hàng</h6>
                <h2 class="mb-0" style="font-size: 2rem; font-weight: 700; color: #1e293b;">{{ number_format($totalRequests) }}</h2>
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: 100%; background: #4f46e5;"></div>
                </div>
            </div>
        </div>

        <!-- Card 2: Đang xử lý -->
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: #ffedd5; color: #ea580c;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h6 class="text-muted mb-2" style="font-size: 0.875rem;">Đang xử lý</h6>
                <h2 class="mb-0" style="font-size: 2rem; font-weight: 700; color: #1e293b;">
                    {{ number_format($pendingRequests) }}/{{ number_format($totalRequests) }}
                </h2>
                <div class="progress-bar-container">
                    @php $pendingPercent = $totalRequests > 0 ? ($pendingRequests / $totalRequests) * 100 : 0; @endphp
                    <div class="progress-bar-fill" style="width: {{ $pendingPercent }}%; background: #ea580c;"></div>
                </div>
            </div>
        </div>

        <!-- Card 3: Hoàn thành -->
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: #dcfce7; color: #15803d;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h6 class="text-muted mb-2" style="font-size: 0.875rem;">Đã hoàn thành</h6>
                <h2 class="mb-0" style="font-size: 2rem; font-weight: 700; color: #1e293b;">
                    {{ number_format($completedRequests) }}/{{ number_format($totalRequests) }}
                </h2>
                <div class="progress-bar-container">
                    @php $completedPercent = $totalRequests > 0 ? ($completedRequests / $totalRequests) * 100 : 0; @endphp
                    <div class="progress-bar-fill" style="width: {{ $completedPercent }}%; background: #15803d;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <!-- Bar Chart -->
        <div class="col-12 col-md-8">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1" style="font-weight: 700; color: #1e293b;">Xu hướng đơn hàng năm {{ $selectedYear }}</h5>
                        <p class="text-muted mb-0" style="font-size: 0.75rem;">Thống kê dữ liệu hàng tháng</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form method="GET" action="{{ route('department.dashboard') }}">
                            <select name="year" class="form-select form-select-sm" style="border-color: #e2e8f0;" onchange="this.form.submit()">
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </form>
                        <!-- <button class="btn btn-sm btn-primary" style="background: #1e293b; border: none; font-size: 0.75rem;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 4px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Báo cáo
                        </button> -->
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <h5 class="mb-1" style="font-weight: 700; color: #1e293b;">Phân bổ trạng thái</h5>
                <p class="text-muted mb-4" style="font-size: 0.75rem;">Tình trạng đơn hàng hiện tại</p>
                <div style="height: 240px; position: relative; display: flex; align-items: center; justify-content: center;">
                    <canvas id="statusChart"></canvas>
                    <div style="position: absolute; text-align: center; pointer-events: none;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #1e293b;">100%</div>
                        <div style="font-size: 0.75rem; color: #94a3b8; text-transform: uppercase;">Tỷ lệ</div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span style="width: 8px; height: 8px; background: #ea580c; border-radius: 50%;"></span>
                            <span style="font-size: 0.875rem; color: #64748b;">Đang xử lý</span>
                        </div>
                        <span style="font-size: 0.875rem; font-weight: 600; color: #1e293b;">{{ $pieChartData[0] }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span style="width: 8px; height: 8px; background: #15803d; border-radius: 50%;"></span>
                            <span style="font-size: 0.875rem; color: #64748b;">Hoàn thành</span>
                        </div>
                        <span style="font-size: 0.875rem; font-weight: 600; color: #1e293b;">{{ $pieChartData[1] }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <!-- <span style="width: 8px; height: 8px; background: #ef4444; border-radius: 50%;"></span> -->
                            <!-- <span style="font-size: 0.875rem; color: #64748b;">Đã hủy/Từ chối</span> -->
                        </div>
                        <!-- <span style="font-size: 0.875rem; font-weight: 600; color: #1e293b;">{{ $pieChartData[2] }}</span> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="stat-card p-0">
        <div class="p-4 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="mb-0" style="font-weight: 700; color: #1e293b;">Danh sách khách hàng & Đơn hàng</h5>
            <div class="d-flex gap-2">
                <!-- <button class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2" style="border-radius: 6px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Tất cả trạng thái
                </button> -->
                <a href="{{ route('department.orders.index') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2" style="border-radius: 6px;">
                    Xem tất cả
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead style="background: #f8fafc;">
                    <tr>
                        <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; border: none;">Bộ phận / Đơn vị</th>
                        <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; border: none;">Người tạo</th>
                        <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; border: none;">Ngày tạo</th>
                        <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; border: none;">Trạng thái</th>
                        <th class="px-4 py-3 text-uppercase text-end" style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; border: none;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRequests as $request)
                    <tr>
                        <td class="px-4 py-3 align-middle border-bottom-0">
                            <div class="d-flex align-items-center gap-3">
                                @php
                                    $departmentName = $request->department->name ?? 'N/A';
                                    $initials = strtoupper(substr($departmentName, 0, 2));
                                    $colors = ['#3b82f6', '#f59e0b', '#64748b'];
                                    $color = $colors[$loop->index % 3];
                                @endphp
                                <div class="avatar-circle" style="background: {{ $color }}; opacity: 0.15; color: {{ $color }}; border: 1px solid {{ $color }};">
                                    {{ $initials }}
                                </div>
                                <div class="d-flex flex-column">
                                    <span style="font-weight: 600; color: #1e293b; font-size: 0.875rem;">{{ $departmentName }}</span>
                                    <span style="font-size: 0.75rem; color: #94a3b8;">{{ str_pad($request->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-middle border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 24px; height: 24px; background: #e0e7ff; color: #4f46e5; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">
                                    {{ strtoupper(substr($request->creator->name ?? 'U', 0, 1)) }}
                                </div>
                                <span style="font-size: 0.875rem; color: #475569;">{{ $request->creator->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-middle border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="16" height="16" fill="none" stroke="#94a3b8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span style="font-size: 0.875rem; color: #475569;">{{ $request->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-middle border-bottom-0">
                            @if($request->status == 'Hoàn thành')
                                <span class="status-badge" style="background: #dcfce7; color: #15803d;">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                    HOÀN THÀNH
                                </span>
                            @elseif($request->status == 'Đang xử lý')
                                <span class="status-badge" style="background: #ffedd5; color: #ea580c;">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    ĐANG XỬ LÝ
                                </span>
                            @else
                                <span class="status-badge" style="background: #f1f5f9; color: #64748b;">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    {{ strtoupper($request->status) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-middle text-end border-bottom-0">
                            <a href="{{ route('department.orders.show', $request->id) }}" class="btn-action text-decoration-none">
                                Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <svg width="48" height="48" fill="none" stroke="#cbd5e1" viewBox="0 0 24 24" class="mb-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span class="text-muted">Chưa có đơn hàng nào</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted" style="font-size: 0.875rem;">Hiển thị {{ $recentRequests->count() }} kết quả mới nhất</span>
                <div class="btn-group">
                    <!-- <button class="btn btn-sm btn-outline-secondary" disabled>Trước</button>
                    <button class="btn btn-sm btn-outline-secondary" disabled>Sau</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prepare Data
        const chartData = @json($chartData);
        const pieData = @json($pieChartData);
        
        // Bar Chart - Orders Trend
        const ctxOrder = document.getElementById('ordersChart').getContext('2d');
        new Chart(ctxOrder, {
            type: 'bar',
            data: {
                labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                datasets: [
                    {
                        type: 'line',
                        label: 'Xu hướng',
                        data: chartData,
                        borderColor: '#38bdf8', // Light Blue
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#38bdf8',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: false,
                        order: 0
                    },
                    {
                        type: 'bar',
                        label: 'Đơn hàng',
                        data: chartData,
                        backgroundColor: '#4f46e5',
                        borderRadius: 4,
                        barThickness: 20,
                        order: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { family: 'Inter', size: 13 },
                        bodyFont: { family: 'Inter', size: 13 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: '#f1f5f9',
                            drawBorder: false
                        },
                        ticks: {
                            font: { family: 'Inter', size: 11 },
                            color: '#64748b'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { family: 'Inter', size: 11 },
                            color: '#64748b'
                        }
                    }
                }
            }
        });

        // Doughnut Chart - Status Distribution
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Đang xử lý', 'Hoàn thành', 'Đã hủy'],
                datasets: [{
                    data: pieData,
                    backgroundColor: ['#ea580c', '#15803d', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                let value = context.raw;
                                let total = context.chart._metasets[context.datasetIndex].total;
                                let percentage = Math.round((value / total) * 100) + '%';
                                return label + value + ' (' + percentage + ')';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
