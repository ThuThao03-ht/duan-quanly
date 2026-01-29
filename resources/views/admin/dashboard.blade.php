@extends('layouts.admin')

@section('title', 'Bảng điều khiển')

@section('content')
<!-- Import Bootstrap & Modern Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --bs-font-sans-serif: 'Plus Jakarta Sans', sans-serif;
    }
    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    a {
        text-decoration: none !important;
    }
    .dashboard-card {
        border-radius: 1.5rem;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        background: #ffffff;
    }
    .stat-icon-box {
        width: 64px;
        height: 64px;
        border-radius: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        color: #1e293b;
    }
    .stat-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    .stat-desc {
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 500;
        margin-top: 0.5rem;
    }
    .year-toggle {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 1rem;
        padding: 0.5rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .year-icon-gradient {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        background: linear-gradient(135deg, #d4af37 0%, #a67c00 100%);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    .legend-text {
        font-size: 0.7rem;
        font-weight: 800;
        color: #94a3b8;
        letter-spacing: 0.05em;
    }
</style>

<div class="container-fluid p-4">
    <!-- Stat Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Tổng PR -->
        <div class="col-md-4">
            <div class="dashboard-card p-4 d-flex align-items-center">
                <div class="stat-icon-box bg-indigo-50 text-indigo-600 me-4" style="background-color: #eef2ff; color: #4f46e5;">
                    <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4H5c-1.11 0-2 .9-2 2v12c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.89-2-2-2zm-2 10H7v-2h10v2zm0-4H7V8h10v2z"/></svg>
                </div>
                <div>
                    <div class="stat-label">TỔNG PR (NĂM {{ $selectedYear }})</div>
                    <div class="stat-value text-slate-800">{{ $totalYear }}</div>
                    <!-- <div class="stat-desc">Tăng 12% so với năm ngoái</div> -->
                </div>
            </div>
        </div>
        <!-- ĐANG XỬ LÝ -->
        <div class="col-md-4">
            <div class="dashboard-card p-4 d-flex align-items-center">
                <div class="stat-icon-box bg-warning-subtle text-warning me-4" style="background-color: #fffbeb; color: #d97706;">
                    <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm.5 13H11v-6l5.25-3.15.75 1.23-4.5 2.67V15z"/></svg>
                </div>
                <div>
                    <div class="stat-label">ĐANG XỬ LÝ (YTD)</div>
                    <div class="stat-value" style="color: #d97706;">{{ $processingYear }}</div>
                    <!-- <div class="stat-desc">27% trong tiến trình</div> -->
                </div>
            </div>
        </div>
        <!-- HOÀN THÀNH -->
        <div class="col-md-4">
            <div class="dashboard-card p-4 d-flex align-items-center">
                <div class="stat-icon-box bg-success-subtle text-success me-4" style="background-color: #ecfdf5; color: #10b981;">
                    <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                </div>
                <div>
                    <div class="stat-label">HOÀN THÀNH (YTD)</div>
                    <div class="stat-value" style="color: #10b981;">{{ $completedYear }}</div>
                    <!-- <div class="stat-desc">73% hoàn thành</div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4">
        <!-- Xu hướng PR (Left 2/3) -->
        <div class="col-lg-8">
            <div class="dashboard-card h-100 p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h5 class="fw-bold text-slate-800 mb-1">Xu hướng PR theo tháng</h5>
                        <p class="text-slate-400 small mb-0">Thống kê PR nhận được trong từng tháng của năm {{ $selectedYear }}</p>
                    </div>
                    <div class="d-flex flex-column align-items-end gap-3">
                        <form action="{{ route('admin.dashboard') }}" method="GET" class="position-relative">
                            <div class="year-toggle">
                                <span class="fw-bold text-slate-700 small">Năm {{ $selectedYear }}</span>
                                <div class="year-icon-gradient"></div>
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <select name="year" onchange="this.form.submit()" class="position-absolute inset-0 opacity-0 cursor-pointer w-100 h-100">
                                @foreach($years as $y)
                                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endforeach
                            </select>
                        </form>
                        <div class="d-flex gap-4">
                            <div class="legend-item">
                                <span class="legend-dot" style="background-color: #fbbf24;"></span>
                                <span class="legend-text">ĐANG XỬ LÝ</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot" style="background-color: #34d399;"></span>
                                <span class="legend-text">HOÀN THÀNH</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height: 320px;">
                    <canvas id="monthlyChart"></canvas>
                </div>
                <div class="d-flex justify-content-between mt-4 px-2">
                    @foreach(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'] as $m)
                        <span style="font-size: 10px; font-weight: 700; color: #94a3b8;">{{ $m }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Phân bổ PR (Right 1/3) -->
        <div class="col-lg-4">
            <div class="dashboard-card h-100 p-4 d-flex flex-column align-items-center text-center">
                <div class="w-100 text-start mb-5">
                    <h5 class="fw-bold text-slate-800 mb-1">Phân bổ PR</h5>
                    <p class="text-slate-400 small mb-0 font-medium">Chi tiết Tổng hợp cả năm {{ $selectedYear }} (YTD)</p>
                </div>
                
                <div class="position-relative mb-5" style="width: 240px; height: 240px;">
                    <canvas id="distributionChart"></canvas>
                    <div class="position-absolute top-50 start-50 translate-middle text-center mt-2">
                        <div class="fw-black" style="font-size: 2.25rem; font-weight: 950; color: #1e293b; line-height: 1;">{{ $completedChart }}/{{ $totalChart }}</div>
                        <div class="small fw-bold text-slate-400 text-uppercase tracking-widest mt-1">HOÀN THÀNH</div>
                    </div>
                </div>

                <div class="w-100 mt-auto px-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="legend-dot" style="background-color: #3b82f6;"></span>
                            <span class="small fw-bold text-slate-500">Tổng PR (Cả năm)</span>
                        </div>
                        <span class="fw-bold text-slate-800">{{ $totalChart }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="legend-dot" style="background-color: #10b981;"></span>
                            <span class="small fw-bold text-slate-500">Hoàn thành</span>
                        </div>
                        <span class="fw-bold text-slate-800">{{ $completedChart }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <span class="legend-dot" style="background-color: #cbd5e1;"></span>
                            <span class="small fw-bold text-slate-500">Đang xử lý</span>
                        </div>
                        <span class="fw-bold text-slate-800">{{ $processingChart }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- Chart 1: Line Chart ---
    const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctxMonthly, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'ĐANG XỬ LÝ',
                    data: @json($monthlyProcessing),
                    borderColor: '#f59e0b',
                    borderWidth: 3,
                    fill: false,
                    tension: 0.45,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#fff',
                    pointBorderWidth: 2,
                },
                {
                    label: 'HOÀN THÀNH',
                    data: @json($monthlyCompleted),
                    borderColor: '#10b981',
                    borderWidth: 3,
                    fill: false,
                    tension: 0.45,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#fff',
                    pointBorderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 10,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 14, weight: '700' },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            let value = context.parsed.y;
                            let total = 0;
                            context.chart.data.datasets.forEach(dataset => {
                                total += dataset.data[context.dataIndex];
                            });
                            let percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { 
                        color: '#f1f5f9',
                        drawBorder: false
                    },
                    ticks: {
                        display: true,
                        stepSize: 5,
                        font: { size: 10, weight: 600 },
                        color: '#94a3b8'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { display: false }
                }
            }
        }
    });

    // --- Chart 2: Donut Chart ---
    const ctxDist = document.getElementById('distributionChart').getContext('2d');
    new Chart(ctxDist, {
        type: 'doughnut',
        data: {
            datasets: [
                {
                    // Outer thin ring (Blue)
                    data: [1],
                    backgroundColor: ['#3b82f6'],
                    borderWidth: 0,
                    cutout: '90%',
                    weight: 0.1
                },
                {
                    // Inner thick ring (Completed / Processing)
                    data: [{{ $completedChart }}, {{ $processingChart }}],
                    backgroundColor: ['#10b981', '#f1f5f9'],
                    borderWidth: 0,
                    cutout: '75%',
                    borderRadius: 30,
                    spacing: 10,
                    weight: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label: function(context) {
                            if (context.datasetIndex === 0) return null; // Hide for blue ring
                            let value = context.raw;
                            let total = {{ $totalChart }};
                            let percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            let label = context.dataIndex === 0 ? 'Hoàn thành' : 'Đang xử lý';
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
</script>
@endsection
@endsection
