@extends('layouts.admin')

@section('title', 'Hướng dẫn sử dụng')

@section('content')
<!-- Import Bootstrap & Modern Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --bs-font-sans-serif: 'Plus Jakarta Sans', sans-serif;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        --secondary-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    body {
        background-color: #f8fafc;
    }

    /* Remove underlines from all links and interactive elements */
    a, .nav-link {
        text-decoration: none !important;
    }

    .hero-section {
        background: var(--primary-gradient);
        border-radius: 2rem;
        padding: 4rem 2rem;
        color: white;
        margin-bottom: 3rem;
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
        position: relative;
        overflow: hidden;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .instruction-card {
        border-radius: 1.5rem;
        border: none;
        background: white;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .instruction-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .bg-indigo-light { background-color: #eef2ff; color: #4f46e5; }
    .bg-amber-light { background-color: #fffbeb; color: #d97706; }
    .bg-emerald-light { background-color: #ecfdf5; color: #10b981; }
    .bg-rose-light { background-color: #fff1f2; color: #e11d48; }

    .step-number {
        width: 32px;
        height: 32px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.875rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .feature-list {
        list-style: none;
        padding-left: 0;
    }

    .feature-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 1rem;
        transition: background 0.2s;
    }

    .feature-list li:hover {
        background: #f8fafc;
    }

    .badge-guide {
        font-size: 0.7rem;
        font-weight: 800;
        padding: 0.35rem 0.75rem;
        border-radius: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-processing { background-color: #fffbeb; color: #d97706; }
    .status-completed { background-color: #ecfdf5; color: #10b981; }

    .img-demo {
        border-radius: 1rem;
        border: 1px solid #e2e8f0;
        margin-top: 1rem;
        width: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title::after {
        content: '';
        flex-grow: 1;
        height: 2px;
        background: #f1f5f9;
    }

    .nav-pills-custom .nav-link {
        border-radius: 1rem;
        padding: 0.75rem 1.5rem;
        font-weight: 700;
        color: #64748b;
        transition: all 0.2s;
    }

    .nav-pills-custom .nav-link.active {
        background: var(--primary-gradient);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .tip-box {
        background: #fff9eb;
        border-left: 4px solid #f59e0b;
        padding: 1.5rem;
        border-radius: 0 1rem 1rem 0;
        margin: 2rem 0;
    }
</style>

<div class="container-fluid p-4">
    <!-- Hero Section -->
    <div class="hero-section text-center">
        <h1 class="fw-black mb-3">Hướng dẫn Quản trị Hệ thống</h1>
        <p class="lead opacity-75 mb-0 mx-auto" style="max-width: 700px;">
            Chào mừng Admin! Đây là trang hỗ trợ giúp bạn nắm vững các thao tác và quy trình quản lý PR trong hệ thống.
        </p>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-pills nav-pills-custom mb-5 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill" data-bs-target="#pills-overview" type="button" role="tab">
                <i class="fas fa-eye me-2"></i>Tổng quan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-tracking-tab" data-bs-toggle="pill" data-bs-target="#pills-tracking" type="button" role="tab">
                <i class="fas fa-list-check me-2"></i>Theo dõi PR
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab">
                <i class="fas fa-user-shield me-2"></i>Tài khoản
            </button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!-- Overview Tab -->
        <div class="tab-pane fade show active" id="pills-overview" role="tabpanel">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="instruction-card p-4">
                        <div class="icon-box bg-indigo-light">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Thống kê Real-time</h5>
                        <p class="text-slate-600 small">
                            Trang Dashboard cung cấp cái nhìn tổng thể về số lượng PR, tỷ lệ hoàn thành và xu hướng mua sắm theo từng tháng.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="instruction-card p-4">
                        <div class="icon-box bg-amber-light">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Thao tác Nhanh</h5>
                        <p class="text-slate-600 small">
                            Hệ thống tối ưu hóa việc nhập liệu với các ô chỉnh sửa trực tiếp (Inline Editing), giúp tiết kiệm 50% thời gian xử lý.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="instruction-card p-4">
                        <div class="icon-box bg-emerald-light">
                            <i class="fas fa-file-export"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Xuất Báo cáo</h5>
                        <p class="text-slate-600 small">
                            Dễ dàng kết xuất dữ liệu sang Excel với đầy đủ các mốc thời gian và ghi chú để phục vụ việc lưu trữ và báo cáo.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="section-title">Luồng quy trình xử lý</h4>
                <div class="row mt-4">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="step-number">01</div>
                            <div>
                                <h6 class="fw-bold mb-0">Tiếp nhận PR</h6>
                                <small class="text-muted">Nhập ngày nhận yêu cầu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="step-number">02</div>
                            <div>
                                <h6 class="fw-bold mb-0">Xử lý PO</h6>
                                <small class="text-muted">Báo giá & Duyệt PO</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="step-number">03</div>
                            <div>
                                <h6 class="fw-bold mb-0">Ký kết HĐ</h6>
                                <small class="text-muted">Hoàn thiện thủ tục</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="step-number">04</div>
                            <div>
                                <h6 class="fw-bold mb-0">Giao hàng</h6>
                                <small class="text-muted">Hoàn thành PR</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tracking Tab -->
        <div class="tab-pane fade" id="pills-tracking" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="instruction-card p-4">
                        <h5 class="fw-bold mb-4">Hướng dẫn chi tiết Trang Theo dõi</h5>
                        <ul class="feature-list">
                            <li>
                                <div class="step-number">A</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Thêm mới PR (Dòng NEW)</h6>
                                    <p class="text-slate-600 small mb-0">Sử dụng dòng trên cùng có màu xanh nhạt. Bạn chỉ cần nhập nội dung và chọn Khoa/Phòng (có gợi ý tự động) rồi nhấn "LƯU NHANH".</p>
                                </div>
                            </li>
                            <li>
                                <div class="step-number">B</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Chỉnh sửa trực tiếp (Inline Edit)</h6>
                                    <p class="text-slate-600 small mb-0">Click vào các ô như <strong>Nội dung</strong>, <strong>Ghi chú</strong> hoặc <strong>Lý do</strong> để sửa văn bản. Chọn trực tiếp ngày ở các cột thời gian.</p>
                                </div>
                            </li>
                            <li>
                                <div class="step-number">C</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Tự động tính ngày Giao hàng</h6>
                                    <p class="text-slate-600 small mb-0">Ở cột "Ngày giao hàng", bạn có thể nhập <strong>"1 tuần"</strong>, <strong>"15 ngày"</strong> hoặc <strong>"3 tháng"</strong>. Hệ thống sẽ tự động cộng thêm dựa vào <strong>"Ngày Ký HĐ"</strong>.</p>
                                </div>
                            </li>
                            <li>
                                <div class="step-number">D</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Quản lý Trạng thái</h6>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge-guide status-processing">ĐANG XỬ LÝ</span>
                                        <span class="text-slate-600 small">: Khi PR đang trong quá trình thực hiện.</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge-guide status-completed">HOÀN THÀNH</span>
                                        <span class="text-slate-600 small">: Khi đã giao hàng và xong hồ sơ.</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 d-flex flex-column">
                    <div class="tip-box mt-0">
                        <h6 class="fw-bold text-warning-emphasis mb-2"><i class="fas fa-lightbulb me-2"></i>Mẹo quản lý:</h6>
                        <p class="small text-slate-700 mb-0">
                            Hãy sử dụng bộ lọc <strong>Tháng</strong> và <strong>Năm</strong> ở thanh công cụ để tập trung xử lý các PR trong giai đoạn hiện tại, giúp dữ liệu hiển thị gọn gàng hơn.
                        </p>
                    </div>
                    
                    <div class="instruction-card p-4 mt-4 bg-light shadow-none border" style="height: auto !important;">
                        <h6 class="fw-bold mb-3">Tiến độ (%) được tính như thế nào?</h6>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                        </div>
                        <p class="text-slate-500 x-small mb-0">
                            Hệ thống chia tiến độ làm 6 mốc chính:<br>
                            - Nhận PR (10%)<br>
                            - Duyệt PR (25%)<br>
                            - Ngày báo giá (40%)<br>
                            - Ngày làm PO (60%)<br>
                            - Duyệt PO (80%)<br>
                            - Ký HĐ (100%)
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Tab -->
        <div class="tab-pane fade" id="pills-account" role="tabpanel">
            <div class="max-w-700 mx-auto">
                <div class="instruction-card p-5 text-center">
                    <div class="icon-box bg-rose-light mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">
                        <i class="fas fa-key"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Bảo mật & Tài khoản</h4>
                    <p class="text-slate-600 mb-4 px-lg-5">
                        Để đảm bảo tính an toàn cho hệ thống quản lý, Admin nên cập nhật mật khẩu ít nhất 3 tháng một lần và không chia sẻ tài khoản cho người không có thẩm quyền.
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('admin.change-password') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold" style="background: var(--primary-gradient); border: none;">
                            <i class="fas fa-lock me-2"></i>Đổi mật khẩu ngay
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-bold">
                            Về bảng điều khiển
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Help -->
    <div class="text-center mt-5 pt-4 border-top">
        <p class="text-slate-400 small">
            Nếu gặp khó khăn trong quá trình sử dụng, vui lòng liên hệ <strong>Phòng Công nghệ Thông tin</strong> để được hỗ trợ.<br>
            &copy; {{ date('Y') }} Bệnh Viện Đa Khoa Tâm Trí Cao Lãnh.
        </p>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@endsection
