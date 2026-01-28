@extends('layouts.department')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' - Department Portal')

@section('content')
<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Global Overrides */
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        color: #334155;
    }

    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-top: 1rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 0;
    }

    .page-title .hashtag {
        color: #3b82f6;
    }

    .status-badge {
        font-size: 0.75rem;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .status-badge.completed { background-color: #dcfce7; color: #166534; }
    .status-badge.processing { background-color: #fff7ed; color: #ea580c; }
    .status-badge.pending { background-color: #f1f5f9; color: #64748b; }
    
    .status-badge .dot {
        width: 6px;
        height: 6px;
        background-color: currentColor;
        border-radius: 50%;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
    }

    .btn-custom {
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-pdf {
        background: #f1f5f9;
        color: #334155;
    }

    .btn-update {
        background: #2563eb;
        color: white;
    }

    /* Top Info Cards */
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        height: 100%;
        border: 1px solid #f1f5f9;
    }

    .icon-circle {
        width: 56px;
        height: 56px;
        border-radius: 16px; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .icon-circle.blue { background: #eff6ff; color: #3b82f6; }
    .icon-circle.purple { background: #fdf4ff; color: #d946ef; }
    .icon-circle.orange { background: #fff7ed; color: #f97316; }

    .card-details {
        display: flex;
        flex-direction: column;
    }

    .card-label {
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
        letter-spacing: 0.5px;
    }

    .card-main-text {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }
    
    .card-sub-text {
        font-size: 0.9rem;
        color: #64748b;
        margin-top: 2px;
    }

    /* Content Section */
    .section-box {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
    }

    .box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .box-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .priority-tag {
        background: #f1f5f9;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 6px;
        text-transform: uppercase;
    }

    .content-quote {
        background: #fafafa;
        padding: 1.5rem 2rem;
        border-radius: 12px;
        font-style: italic;
        color: #475569;
        line-height: 1.6;
        position: relative;
    }

    .content-quote::before {
        content: "";
        position: absolute;
        left: 0;
        top: 15px;
        bottom: 15px;
        width: 4px;
        background: #3b82f6;
        border-radius: 0 4px 4px 0;
    }

    /* Progress Timeline */
    .progress-percent {
        text-align: right;
    }
    .progress-percent .label {
        display: block;
        font-size: 0.7rem;
        color: #94a3b8;
        font-weight: 700;
        text-transform: uppercase;
    }
    .progress-percent .value {
        font-size: 1.75rem;
        font-weight: 800;
        color: #10b981;
        line-height: 1;
    }
    
    .timeline-wrapper {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        position: relative;
        padding: 0 1rem;
    }

    .timeline-wrapper::before {
        content: "";
        position: absolute;
        top: 20px;
        left: 30px;
        right: 30px;
        height: 4px;
        background: #e2e8f0;
        z-index: 0;
        border-radius: 2px;
    }

    .timeline-progress-line {
        position: absolute;
        top: 20px;
        left: 30px;
        height: 4px;
        background: #10b981;
        z-index: 0;
        border-radius: 2px;
        transition: width 0.5s ease;
    }

    .step-item {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 100px;
    }

    .step-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: white;
        border: 4px solid #fff;
        box-shadow: 0 0 0 1px #e2e8f0;
        color: #94a3b8;
        font-size: 1rem;
        transition: all 0.2s;
        margin-bottom: 0.75rem;
    }

    .step-item.completed .step-icon {
        background: #10b981;
        color: white;
        border-color: white;
        box-shadow: none;
    }

    .step-item.active .step-icon {
        background: #3b82f6;
        color: white;
        width: 50px;
        height: 50px;
        margin-top: -3px;
        box-shadow: 0 0 0 5px rgba(59, 130, 246, 0.2);
    }

    .step-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
    }
    
    .step-item.active .step-label {
        color: #3b82f6;
    }

    .step-date {
        font-size: 0.75rem;
        color: #94a3b8;
        margin-top: 2px;
    }

    .step-status {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #3b82f6;
        margin-top: 2px;
    }

    /* Fixed Sidebar Chat */
    .sidebar-card {
        background: white;
        border-radius: 16px;
        max-height: 85vh; /* Max height instead of fixed */
        height: auto;     /* Shrink to fit content */
        min-height: 400px; /* Minimum reasonable height */
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        position: sticky;
        top: 20px;
        overflow: hidden;
    }

    .chat-header {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
        flex-shrink: 0; /* Header doesn't shrink */
    }

    .count-badge {
        background: #eff6ff;
        color: #3b82f6;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.8rem;
    }

    .chat-area {
        flex: 1; /* Takes available space */
        overflow-y: auto; /* Scrolls internally */
        padding: 1.5rem;
        background: white;
        min-height: 0; /* Required for Firefox flex scroll */
    }

    .message-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 1.5rem;
    }

    .sys-msg {
        align-items: flex-start;
    }

    .sys-msg .msg-bubble {
        background: #2563eb;
        color: white;
        padding: 1rem;
        border-radius: 12px;
        border-top-left-radius: 2px;
        font-size: 0.9rem;
        line-height: 1.5;
        max-width: 90%;
        box-shadow: 0 2px 5px rgba(37, 99, 235, 0.2);
    }

    .user-msg {
        align-items: flex-end;
    }

    .user-msg .msg-bubble {
        background: white;
        border: 1px solid #e2e8f0;
        color: #334155;
        padding: 1rem;
        border-radius: 12px;
        border-top-right-radius: 2px;
        font-size: 0.9rem;
        line-height: 1.5;
        max-width: 90%;
    }

    .msg-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .avatar-circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        color: white;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .avatar-sys { background: #2563eb; }
    
    .msg-name {
        font-weight: 700;
        font-size: 0.85rem;
        color: #1e293b;
    }

    .msg-time {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    .input-area {
        padding: 1rem;
        border-top: 1px solid #f1f5f9;
        background: white;
        flex-shrink: 0; /* Input doesn't shrink */
    }

    .chat-input-box {
        background: #f8fafc;
        border-radius: 16px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
    }

    .chat-textarea {
        border: none;
        background: transparent;
        resize: none;
        outline: none;
        width: 100%;
        min-height: 48px;
        color: #334155;
    }

    .chat-tools {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
    }

    .tool-icons {
        display: flex;
        gap: 1rem;
        color: #94a3b8;
        font-size: 1.1rem;
        cursor: pointer;
    }

    .btn-submit {
        background: #2563eb;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(37, 99, 235, 0.3);
    }
    
    .btn-submit:hover {
        background: #1d4ed8;
    }

    .badge-role {
        padding: 2px 6px;
        border-radius: 4px;
        background: #e2e8f0;
        color: #64748b;
        font-size: 0.65rem;
        font-weight: 700;
    }
</style>

@php
    // Logic for Timeline
    $timeline = $order->timeline;
    $steps = [
         ['key' => 'pr_received_date', 'label' => 'Nhận PR', 'icon' => 'fa-file-import'],
         ['key' => 'pr_approved_date', 'label' => 'Duyệt PR', 'icon' => 'fa-file-signature'],
         ['key' => 'quotation_date', 'label' => 'Báo giá', 'icon' => 'fa-file-invoice-dollar'],
         ['key' => 'po_created_date', 'label' => 'Làm PO', 'icon' => 'fa-file-invoice'],
         ['key' => 'po_approved_date', 'label' => 'Duyệt PO', 'icon' => 'fa-check-double'],
    ];

    if ($order->is_contract_required || ($timeline && $timeline->contract_signed_date)) {
        $steps[] = ['key' => 'contract_signed_date', 'label' => 'Ký Hợp đồng', 'icon' => 'fa-file-contract'];
    }

    $steps[] = ['key' => 'goods_received_date', 'label' => 'Giao hàng', 'icon' => 'fa-truck'];

    $totalSteps = count($steps);
    $completedCount = 0;
    $activeStepIndex = 0;

    foreach ($steps as $index => $step) {
        if ($timeline && !empty($timeline->{$step['key']})) {
            $completedCount++;
            $activeStepIndex = $index + 1; // Possible next active
        }
    }
    
    // Safety check if all done
    if ($activeStepIndex >= $totalSteps) {
         if ($order->status == 'Hoàn thành' || ($timeline && $timeline->goods_received_date)) {
             $activeStepIndex = 1000; // All done
         } else {
             $activeStepIndex = $totalSteps - 1; 
         }
    }
    
    // Percentage for Bar
    $percent = 0;
    if ($totalSteps > 1) {
        // If completedCount = 1 (step 0 done), percent should be distance to next node?
        // Let's use simple logic: N steps = N-1 segments. 
        $percent = round(($completedCount / ($totalSteps - 1)) * 100);
        if ($percent > 100) $percent = 100;
        // Adjust for partial? No, just stick to completed nodes.
    }
@endphp

<div class="container-fluid">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">
            Chi tiết đơn hàng <span class="hashtag">#{{ $order->id }}</span>
            @if($order->status == 'Hoàn thành')
                <div class="status-badge completed">
                    <span class="dot"></span> {{ $order->status }}
                </div>
            @elseif($order->status == 'Đang xử lý')
                <div class="status-badge processing">
                    <span class="dot"></span> {{ $order->status }}
                </div>
            @else
                <div class="status-badge pending">
                    <span class="dot"></span> {{ $order->status }}
                </div>
            @endif
        </h1>
        <!-- <div class="header-actions">
            <button class="btn-custom btn-pdf">
                <i class="fas fa-print"></i> In PDF
            </button>
            <button class="btn-custom btn-update">
                <i class="fas fa-pen"></i> Cập nhật
            </button>
        </div> -->
    </div>

    <!-- Top Info Cards: Real Data -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Department -->
        <div class="col-12 col-md-4">
            <div class="info-card">
                <div class="icon-circle blue">
                    <i class="far fa-building"></i>
                </div>
                <div class="card-details">
                    <div class="card-label">KHOA / PHÒNG</div>
                    <div class="card-main-text">{{ $order->department->name ?? 'N/A' }}</div>
                    <div class="card-sub-text">ID: {{ $order->department->id ?? '-' }}</div>
                </div>
            </div>
        </div>
        
        <!-- Card 2: Creator -->
        <div class="col-12 col-md-4">
            <div class="info-card">
                <div class="icon-circle purple">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-details">
                    <div class="card-label">NGƯỜI TẠO</div>
                    <div class="card-main-text">{{ $order->creator->name ?? 'N/A' }}</div>
                    <div class="card-sub-text">{{ $order->creator->role ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Date -->
        <div class="col-12 col-md-4">
            <div class="info-card">
                <div class="icon-circle orange">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <div class="card-details">
                    <div class="card-label">NGÀY TẠO</div>
                    <div class="card-main-text">{{ $order->created_at->format('d/m/Y') }}</div>
                    <div class="card-sub-text">{{ $order->created_at->format('H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content Column -->
        <div class="col-lg-8 col-12">
            <!-- Content & Delivery Note Row -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-7">
                    <div class="section-box h-100 mb-0">
                        <div class="box-header">
                            <div class="box-title">
                                <i class="fas fa-bars" style="color: #94a3b8;"></i>
                                Nội dung yêu cầu
                            </div>
                            <span class="priority-tag">MỨC ĐỘ: {{ $order->priority ?? 'THƯỜNG' }}</span>
                        </div>
                        <div class="content-quote">
                            "{{ $order->content }}"
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="section-box h-100 mb-0">
                        <div class="box-header">
                            <div class="box-title">
                                <i class="fas fa-truck-loading" style="color: #94a3b8;"></i>
                                GHI CHÚ (GIAO HÀNG)
                            </div>
                        </div>
                        <div style="background: #fff7ed; padding: 1.5rem; border-radius: 12px; color: #9a3412; font-size: 0.95rem; line-height: 1.6; border-left: 4px solid #f97316;">
                            {{ $order->delivery_note ?? 'Chưa có ghi chú giao hàng.' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Timeline Real Data -->
            <div class="section-box">
                <div class="box-header">
                    <div class="box-title">
                        <i class="fas fa-network-wired" style="color: #94a3b8;"></i>
                        Tiến độ mua sắm
                    </div>
                    <div class="progress-percent">
                        <span class="label">HOÀN THÀNH</span>
                        <span class="value">{{ $percent }}%</span>
                    </div>
                </div>

                <!-- Custom Stepper -->
                <div class="timeline-wrapper">
                    <!-- Progress Line -->
                    <div class="timeline-progress-line" style="width: {{ $percent }}%"></div>

                    @foreach($steps as $index => $step)
                        @php
                            $isCompleted = ($timeline && !empty($timeline->{$step['key']}));
                            $isActive = ($index == $activeStepIndex);
                            // If completed, check
                        @endphp

                        <div class="step-item {{ $isCompleted ? 'completed' : ($isActive ? 'active' : '') }}">
                            <div class="step-icon">
                                @if($isCompleted)
                                    <i class="fas fa-check"></i>
                                @elseif($isActive)
                                    <i class="fas fa-pen"></i>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </div>
                            <div class="step-label">{{ $step['label'] }}</div>
                            <div class="step-date">
                                @if($isCompleted)
                                    {{ \Carbon\Carbon::parse($timeline->{$step['key']})->format('d/m/y') }}
                                @elseif($isActive)
                                    &nbsp;
                                @else
                                    &nbsp;
                                @endif
                            </div>
                            @if($isActive)
                                <div class="step-status">ĐANG XỬ LÝ</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Detailed Status & Reason -->
            <div class="section-box">
                <div class="box-header">
                    <div class="box-title">
                        <i class="fas fa-info-circle" style="color: #94a3b8;"></i>
                        Lý do & Trạng thái chi tiết
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <div class="d-flex align-items-start gap-2">
                             <div style="width: 8px; height: 8px; background: #3b82f6; border-radius: 50%; margin-top: 6px;"></div>
                             <div>
                                 <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 4px;">GIAI ĐOẠN HIỆN TẠI</span>
                                 <span style="color: #334155; font-weight: 600;">{{ $order->status }}</span>
                                 <!-- Logic to show detailed status description based on step -->
                                 <div style="font-size: 0.875rem; color: #64748b; margin-top: 2px;">
                                     @php
                                        $statusDesc = 'Đang xử lý theo quy trình mua sắm.';
                                        if ($percent >= 100) $statusDesc = 'Quy trình mua sắm đã hoàn tất.';
                                        elseif ($activeStepIndex == 0) $statusDesc = 'Đang chờ tiếp nhận yêu cầu.';
                                        elseif ($activeStepIndex == 1) $statusDesc = 'Đang xem xét duyệt yêu cầu.';
                                        elseif ($activeStepIndex == 2) $statusDesc = 'Đang tìm nhà cung cấp và báo giá.';
                                        elseif ($activeStepIndex == 3) $statusDesc = 'Đang làm PO đặt hàng.';
                                        elseif ($activeStepIndex == 4) $statusDesc = 'Đang chờ duyệt PO.';
                                        elseif ($activeStepIndex == 5) $statusDesc = 'Ký kết hợp đồng kinh tế với nhà thầu cung ứng thiết bị.';
                                        elseif ($activeStepIndex == 6) $statusDesc = 'Đang chờ giao hàng đến kho.';
                                     @endphp
                                     {{ $statusDesc }}
                                 </div>
                             </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="d-flex align-items-start gap-2">
                             <div style="width: 8px; height: 8px; background: #f97316; border-radius: 50%; margin-top: 6px;"></div>
                             <div>
                                 <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 4px;">LÝ DO CHẬM TRỄ (NẾU CÓ)</span>
                                 <span style="color: #d97706; font-weight: 600;">
                                     {{ $order->reason ?? 'Không có lý do chậm trễ ghi nhận.' }}
                                 </span>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Chat: Fixed Layout -->
        <div class="col-lg-4 col-12">
            <div class="sidebar-card">
                <div class="chat-header">
                    <div class="box-title">
                        <i class="fas fa-comment-alt" style="color: #94a3b8;"></i>
                        Ghi chú & Lịch sử
                    </div>
                    <div class="count-badge">{{ $order->notes->count() }}</div>
                </div>

                <div class="chat-area">
                    <!-- Check if any notes exist -->
                    @if($order->notes->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="far fa-comment-dots fa-2x mb-2"></i>
                            <p>Chưa có ghi chú nào.</p>
                        </div>
                    @endif

                    @foreach($order->notes as $note)
                        @if($note->note_type == 'admin' || $note->user->role == 'admin')
                            <!-- Right / Admin -->
                            <div class="message-group user-msg">
                                <div class="msg-header" style="flex-direction: row-reverse;">
                                    <span class="badge-role">AD</span>
                                    <span class="msg-name">admin</span> <!-- Or $note->user->name -->
                                    <span class="msg-time">{{ $note->created_at->format('H:i') }}</span>
                                </div>
                                <div class="msg-bubble">
                                    {{ $note->content }}
                                </div>
                            </div>
                        @else
                            <!-- Left / System or Dept -->
                            <div class="message-group sys-msg">
                                <div class="msg-header">
                                    <div class="avatar-circle avatar-sys">SYS</div>
                                    <span class="msg-name">{{ $note->user->department->name ?? $note->user->name ?? 'Hệ thống' }}</span>
                                    <span class="msg-time">{{ $note->created_at->format('H:i') }}</span>
                                </div>
                                <div class="msg-bubble">
                                    {{ $note->content }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Input Fixed Bottom -->
                <div class="input-area">
                    <form action="{{ route('department.orders.addNote', $order->id) }}" method="POST">
                        @csrf
                        <div class="chat-input-box">
                            <textarea name="content" class="chat-textarea" placeholder="Nhập tin nhắn hoặc ghi chú..." required></textarea>
                            <div class="chat-tools">
                                <div class="tool-icons">
                                    <i class="fas fa-paperclip"></i>
                                    <i class="far fa-smile"></i>
                                </div>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
