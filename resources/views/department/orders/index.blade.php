@extends('layouts.department')

@section('title', 'Danh sách đơn hàng - Department Portal')

@section('content')
<style>
    /* Tổng thể layout */
    .page-header-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }

    /* Tabs Toggle Style */
    .status-toggle {
        background: #f1f5f9;
        padding: 4px;
        border-radius: 8px;
        display: inline-flex;
        gap: 4px;
    }

    .toggle-item {
        padding: 6px 16px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .toggle-item:hover {
        color: #1e293b;
    }

    .toggle-item.active {
        background: white;
        color: #4f46e5;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        font-weight: 600;
    }

    .toggle-count {
        background: #e0e7ff;
        color: #4f46e5;
        font-size: 0.75rem;
        padding: 1px 6px;
        border-radius: 4px;
        min-width: 20px;
        text-align: center;
    }

    .toggle-item:not(.active) .toggle-count {
        background: #e2e8f0;
        color: #64748b;
    }

    /* Search & Filter Bar */
    .search-filter-container {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .search-wrapper {
        flex: 1;
        position: relative;
    }

    .search-input {
        width: 100%;
        background: #f8fafc;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1rem 0.75rem 3rem;
        font-size: 0.875rem;
        color: #1e293b;
    }

    .search-input:focus {
        background: white;
        box-shadow: 0 0 0 1px #e2e8f0;
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .btn-filter, .btn-search {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        white-space: nowrap;
    }

    .btn-filter {
        background: white;
        border: 1px solid #e2e8f0;
        color: #1e293b;
    }

    .btn-search {
        background: #2563eb; /* Primary Blue */
        color: white;
    }
    
    .btn-search:hover {
        background: #1d4ed8;
    }

    /* Table Styles */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th {
        text-align: left;
        padding: 1rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        border-bottom: 1px solid #f1f5f9;
        background: white;
    }

    .custom-table td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8fafc;
        background: white;
    }

    .order-id {
        font-weight: 700;
        color: #1e293b;
    }

    .dept-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dept-icon {
        width: 32px;
        height: 32px;
        background: #eff6ff;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
    }

    .dept-name {
        font-weight: 600;
        color: #1e293b;
    }

    .order-content {
        color: #475569;
        font-size: 0.875rem;
        max-width: 350px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-badge.processing {
        background: #fff7ed;
        color: #ea580c;
    }
    
    .status-badge.completed {
        background: #f0fdf4;
        color: #16a34a;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .contract-badge {
        background: #f1f5f9;
        color: #64748b;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .contract-badge.required {
        background: #eff6ff;
        color: #3b82f6;
    }

    .date-wrapper {
        display: flex;
        flex-direction: column;
    }
    
    .date-main {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.875rem;
    }
    
    .date-sub {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    .btn-detail {
        background: #eff6ff;
        color: #2563eb;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s;
    }

    .btn-detail:hover {
        background: #dbeafe;
    }

    .pagination-wrapper {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }
</style>

<div class="container-fluid">
    <!-- Header Area -->
    <div class="page-header-container">
        <div>
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 0.25rem;">Danh sách đơn hàng</h1>
            <p style="font-size: 0.875rem; color: #64748b; margin: 0;">Quản lý và theo dõi các yêu cầu vật tư y tế theo trạng thái thực tế</p>
        </div>
        
        <!-- Toggle Tabs -->
        <div class="status-toggle">
            <a href="{{ route('department.orders.index', ['status' => 'Đang xử lý']) }}" class="toggle-item {{ request('status') == 'Đang xử lý' || !request('status') ? 'active' : '' }}">
                Đang xử lý
                <span class="toggle-count">{{ $processingCount }}</span>
            </a>
            <a href="{{ route('department.orders.index', ['status' => 'Hoàn thành']) }}" class="toggle-item {{ request('status') == 'Hoàn thành' ? 'active' : '' }}">
                Đã hoàn thành
                <span class="toggle-count">{{ $completedCount }}</span>
            </a>
        </div>
    </div>

    <!-- Search & Filter Area -->
    <div class="card border-0 mb-3" style="border-radius: 12px; overflow: visible;">
        <div class="card-body p-0">
            <form action="{{ route('department.orders.index') }}" method="GET" class="search-filter-container mb-0">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                
                <div class="search-wrapper">
                    <svg class="search-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" class="search-input" placeholder="Tìm kiếm theo mã đơn, nội dung hoặc khoa/phòng...">
                </div>

                <!-- <button type="button" class="btn-filter">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Bộ lọc
                </button> -->

                <button type="submit" class="btn-search">
                    Tìm kiếm
                </button>
            </form>
        </div>
    </div>

    <!-- Table Area -->
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">MÃ ĐƠN</th>
                        <th style="width: 20%;">KHOA/PHÒNG</th>
                        <th style="width: 25%;">NỘI DUNG YÊU CẦU</th>
                        <th style="width: 15%;">TRẠNG THÁI</th>
                        <th style="width: 10%;">HỢP ĐỒNG</th>
                        <th style="width: 10%;">NGÀY TẠO</th>
                        <th style="width: 10%; text-align: right;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <span class="order-id">#ORD-{{ $order->id }}</span>
                            </td>
                            <td>
                                <div class="dept-wrapper">
                                    <div class="dept-icon">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <span class="dept-name">{{ $order->department->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="order-content">
                                    {{ $order->content }}
                                </div>
                            </td>
                            <td>
                                @if($order->status == 'Dang xử lý' || $order->status == 'Đang xử lý')
                                    <span class="status-badge processing">
                                        <span class="status-dot"></span>
                                        Đang xử lý
                                    </span>
                                @elseif($order->status == 'Hoàn thành')
                                    <span class="status-badge completed">
                                        <span class="status-dot"></span>
                                        Hoàn thành
                                    </span>
                                @else
                                    <span class="status-badge" style="background: #f1f5f9; color: #64748b;">
                                        {{ $order->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($order->is_contract_required)
                                    <span class="contract-badge required">CÓ</span>
                                @else
                                    <span class="contract-badge">KHÔNG</span>
                                @endif
                            </td>
                            <td>
                                <div class="date-wrapper">
                                    <span class="date-main">{{ $order->created_at->format('d/m/Y') }}</span>
                                    <span class="date-sub">{{ $order->created_at->format('h:i A') }}</span>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('department.orders.show', $order->id) }}" class="btn-detail">
                                    Xem chi tiết
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" alt="Empty" width="60" style="opacity: 0.5; margin-bottom: 1rem;">
                                    <h6 style="color: #64748b; font-weight: 600;">Không tìm thấy đơn hàng nào</h6>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="pagination-wrapper">
            <div style="font-size: 0.875rem; color: #64748b;">
                Đang hiển thị <span style="font-weight: 700; color: #1e293b;">{{ $orders->firstItem() ?? 0 }} - {{ $orders->lastItem() ?? 0 }}</span> của <span style="font-weight: 700; color: #1e293b;">{{ $orders->total() }}</span> đơn hàng {{ request('status') ? strtolower(request('status')) : '' }}
            </div>
            <div>
                {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
