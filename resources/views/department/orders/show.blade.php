@extends('layouts.department')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' - Department Portal')

@section('content')
<style>
    .breadcrumb-link {
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.875rem;
        transition: color 0.2s;
    }
    
    .breadcrumb-link:hover {
        color: #4f46e5;
    }
    
    .info-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 1.5rem;
    }
    
    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    
    .info-value {
        font-size: 0.9375rem;
        font-weight: 600;
        color: #1e293b;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    
    .status-processing {
        background: #fff7ed;
        color: #ea580c;
    }
    
    .status-completed {
        background: #dcfce7;
        color: #15803d;
    }
    
    .help-card {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 16px;
        padding: 1.5rem;
        color: white;
    }
    
    .btn-help {
        background: white;
        color: #6366f1;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    
    .btn-help:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    }
    
    .content-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 1.5rem;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
        background: #f1f5f9;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .note-textarea {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.875rem;
        font-size: 0.875rem;
        resize: vertical;
        transition: all 0.2s;
    }
    
    .note-textarea:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .btn-submit-note {
        background: #4f46e5;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-submit-note:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    
    .btn-export {
        background: #4f46e5;
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-export:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
</style>

<div class="container-fluid">
    <!-- Header with Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="{{ route('department.dashboard') }}" class="breadcrumb-link">Tổng quan</a>
                <svg width="16" height="16" fill="none" stroke="#94a3b8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('department.orders.index') }}" class="breadcrumb-link">Đơn hàng</a>
            </div>
            <h1 class="mb-0" style="font-size: 1.75rem; font-weight: 700; color: #1e293b;">Chi tiết đơn hàng #{{ $order->id }}</h1>
        </div>
        
    </div>

    <div class="row g-4">
        <!-- Left Sidebar -->
        <div class="col-12 col-lg-3">
            <!-- Info Card -->
            <div class="info-card mb-4">
                <h6 style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem;">THÔNG TIN CHUNG</h6>
                
                <div class="mb-3">
                    <div class="info-label">KHOA/PHÒNG</div>
                    <div class="info-value d-flex align-items-center gap-2">
                        <svg width="16" height="16" fill="#4f46e5" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                        {{ $order->department->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="info-label">NGƯỜI TẠO</div>
                    <div class="info-value d-flex align-items-center gap-2">
                        <div style="width: 24px; height: 24px; border-radius: 50%; background: #e0e7ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">
                            {{ strtoupper(substr($order->creator->name ?? 'A', 0, 2)) }}
                        </div>
                        {{ $order->creator->name ?? 'admin' }}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="info-label">TRẠNG THÁI</div>
                    @if($order->status == 'Đang xử lý')
                        <span class="status-badge status-processing">
                            <span style="width: 6px; height: 6px; background: #ea580c; border-radius: 50%;"></span>
                            Đang xử lý
                        </span>
                    @else
                        <span class="status-badge status-completed">
                            <span style="width: 6px; height: 6px; background: #15803d; border-radius: 50%;"></span>
                            Hoàn thành
                        </span>
                    @endif
                </div>

                <div class="mb-3">
                    <div class="info-label">YÊU CẦU HỢP ĐỒNG</div>
                    @if($order->is_contract_required)
                        <span class="status-badge" style="background: #f0fdf4; color: #15803d;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Có
                        </span>
                    @else
                        <span class="status-badge" style="background: #f1f5f9; color: #64748b;">Không</span>
                    @endif
                </div>

                <div>
                    <div class="info-label">NGÀY TẠO</div>
                    <div class="info-value d-flex align-items-center gap-2">
                        <svg width="16" height="16" fill="none" stroke="#64748b" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <div>{{ $order->created_at->format('d/m/Y') }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">{{ $order->created_at->format('H:i:s') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Card -->

        </div>

        <!-- Main Content -->
        <div class="col-12 col-lg-9">
            <!-- Content Card -->
            <div class="content-card mb-4">
                <div class="section-title">
                    <svg width="20" height="20" fill="none" stroke="#4f46e5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Nội dung yêu cầu
                </div>
                <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #e5e7eb;">
                    <p style="color: #475569; margin: 0; line-height: 1.6;">{{ $order->content }}</p>
                </div>
            </div>

            <!-- Notes & History Card -->
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="section-title mb-0">
                        <svg width="20" height="20" fill="none" stroke="#4f46e5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Ghi chú & Lịch sử
                    </div>
                    @if($order->notes->count() > 0)
                        <span style="font-size: 0.875rem; color: #94a3b8;">{{ $order->notes->count() }} ghi chú</span>
                    @endif
                </div>

                @if($order->notes->count() > 0)
                    <div class="mb-4" style="max-height: 400px; overflow-y: auto;">
                        @foreach($order->notes as $note)
                        <div class="mb-3 p-3" style="background: #f8fafc; border-radius: 12px; border: 1px solid #e5e7eb;">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #e0e7ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">
                                        {{ strtoupper(substr($note->user->name ?? 'U', 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #1e293b; font-size: 0.875rem;">
                                            @if($note->note_type == 'admin')
                                                {{ $note->user->name ?? 'Admin' }}
                                            @else
                                                {{ $note->user->department->name ?? $note->user->name ?? 'Unknown' }}
                                            @endif
                                        </div>
                                        <div style="font-size: 0.75rem; color: #94a3b8;">{{ $note->created_at->format('d/m/Y H:i:s') }}</div>
                                    </div>
                                </div>
                                @if($note->note_type == 'admin')
                                    <span class="badge" style="background: #fee2e2; color: #b91c1c; font-size: 0.75rem;">Admin</span>
                                @else
                                    <span class="badge" style="background: #dbeafe; color: #1d4ed8; font-size: 0.75rem;">{{ $note->user->department->name ?? 'Department' }}</span>
                                @endif
                            </div>
                            <p style="color: #475569; margin: 0; font-size: 0.875rem; line-height: 1.5;">{{ $note->content }}</p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg width="32" height="32" fill="none" stroke="#cbd5e1" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <h6 style="font-weight: 600; color: #1e293b; margin-bottom: 0.5rem;">Chưa có ghi chú nào</h6>
                        <p style="color: #94a3b8; font-size: 0.875rem; margin-bottom: 0;">Các ghi chú hoặc phản hồi về đơn hàng này sẽ được hiển thị tại đây.</p>
                    </div>
                @endif

                <!-- Add Note Form -->
                <div class="border-top pt-4 mt-4">
                    <div class="section-title mb-3">
                        <svg width="20" height="20" fill="none" stroke="#4f46e5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Thêm ghi chú mới
                    </div>
                    <form action="{{ route('department.orders.addNote', $order->id) }}" method="POST">
                        @csrf
                        <textarea 
                            name="content" 
                            rows="4" 
                            placeholder="Nhập ghi chú của bạn (ví dụ: lý do từ chối, yêu cầu bổ sung...)" 
                            class="note-textarea mb-3"
                            required
                        ></textarea>
                        @error('content')
                            <p class="text-danger" style="font-size: 0.875rem; margin-bottom: 0.75rem;">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn btn-submit-note">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Gửi ghi chú
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
