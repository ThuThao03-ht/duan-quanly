@extends('layout.department')

@section('title', 'Danh sách đơn hàng - Department Portal')

@section('content')
<style>
    .search-input {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.75rem 1rem 0.75rem 3rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    
    .filter-select {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.75rem 2.5rem 0.75rem 1rem;
        font-size: 0.875rem;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .btn-filter {
        background: #4f46e5;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
    }
    
    .btn-filter:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    
    .btn-reset {
        background: #f1f5f9;
        color: #475569;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-reset:hover {
        background: #e2e8f0;
        color: #475569;
    }
    
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .btn-clear-filter {
        background: white;
        color: #4f46e5;
        border: 2px solid #4f46e5;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-clear-filter:hover {
        background: #4f46e5;
        color: white;
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="mb-0" style="font-size: 1.75rem; font-weight: 700; color: #1e293b;">Danh sách đơn hàng</h1>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('department.orders.index') }}" class="row g-3 align-items-center">
                <!-- Search -->
                <div class="col-12 col-md-5">
                    <div class="position-relative">
                        <svg class="search-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Tìm kiếm theo nội dung hoặc khoa/phòng..." 
                            class="form-control search-input w-100"
                        >
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select filter-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="Đang xử lý" {{ request('status') == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="Hoàn thành" {{ request('status') == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="col-12 col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-filter">
                        Lọc
                    </button>
                    <a href="{{ route('department.orders.index') }}" class="btn btn-reset">
                        Đặt lại
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0 shadow-sm">
        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f8fafc; border-bottom: 1px solid #e5e7eb;">
                        <tr>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">ID</th>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">Khoa/Phòng</th>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">Nội dung</th>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">Trạng thái</th>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">Hợp đồng</th>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">Ngày tạo</th>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">Ghi chú</th>
                            <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="px-4 py-3" style="font-weight: 600; color: #1e293b; font-size: 0.875rem;">#{{ $order->id }}</td>
                            <td class="px-4 py-3" style="color: #475569; font-size: 0.875rem;">{{ $order->department->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3" style="color: #475569; font-size: 0.875rem; max-width: 300px;">{{ Str::limit($order->content, 60) }}</td>
                            <td class="px-4 py-3">
                                @if($order->status == 'Đang xử lý')
                                    <span class="badge" style="background: #ffedd5; color: #ea580c; font-weight: 600; padding: 0.375rem 0.75rem;">ĐANG XỬ LÝ</span>
                                @elseif($order->status == 'Hoàn thành')
                                    <span class="badge" style="background: #dcfce7; color: #15803d; font-weight: 600; padding: 0.375rem 0.75rem;">HOÀN THÀNH</span>
                                @else
                                    <span class="badge" style="background: #fee2e2; color: #b91c1c; font-weight: 600; padding: 0.375rem 0.75rem;">{{ strtoupper($order->status) }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($order->is_contract_required)
                                    <span class="badge" style="background: #e9d5ff; color: #7c3aed; font-weight: 600; padding: 0.375rem 0.75rem;">CÓ</span>
                                @else
                                    <span class="badge" style="background: #f1f5f9; color: #64748b; font-weight: 600; padding: 0.375rem 0.75rem;">KHÔNG</span>
                                @endif
                            </td>
                            <td class="px-4 py-3" style="color: #475569; font-size: 0.875rem;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                @if($order->notes->count() > 0)
                                    <span style="color: #475569; font-size: 0.875rem;">{{ Str::limit($order->notes->first()->content, 50) }}</span>
                                @else
                                    <span style="color: #cbd5e1;"> Chưa có ghi chú</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('department.orders.show', $order->id) }}" style="color: #4f46e5; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="card-footer bg-white border-top py-3">
                {{ $orders->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="40" height="40" fill="none" stroke="#cbd5e1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h5 class="mb-3" style="font-weight: 600; color: #1e293b;">Không tìm thấy đơn hàng nào</h5>
                <p class="text-muted mb-4" style="font-size: 0.875rem; max-width: 400px; margin-left: auto; margin-right: auto;">
                    Hiện tại chưa có dữ liệu đơn hàng nào phù hợp với bộ lọc của bạn. Thử thay đổi tiêu chí tìm kiếm để xem kết quả.
                </p>
                <a href="{{ route('department.orders.index') }}" class="btn btn-clear-filter">
                    Xóa bộ lọc
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
