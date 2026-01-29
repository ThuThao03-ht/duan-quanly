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
            Chào mừng Admin! Đây là trang hỗ trợ giúp bạn nắm vững các thao tác quản lý PR, cài đặt hệ thống và theo dõi tiến độ mua sắm hiệu quả nhất.
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
                <i class="fas fa-list-check me-2"></i>Quy trình PR & Tiến độ
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-settings" type="button" role="tab">
                <i class="fas fa-cogs me-2"></i>Cài đặt & Dữ liệu
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
                        <h5 class="fw-bold mb-3">Thao tác Thông minh</h5>
                        <p class="text-slate-600 small">
                            Hỗ trợ sửa nhanh trực tiếp (Inline Edit), Double-click để xóa nhanh, và tự động tính ngày giao hàng dựa trên ngôn ngữ tự nhiên (ví dụ: "1 tuần").
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="instruction-card p-4">
                        <div class="icon-box bg-amber-light">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Tự động hóa Tiến độ</h5>
                        <p class="text-slate-600 small">
                            Thanh tiến độ (Progress Bar) và trạng thái được hệ thống tự động cập nhật dựa trên số lượng cột ngày tháng đã được lấp đầy.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="instruction-card p-4">
                        <div class="icon-box bg-emerald-light">
                            <i class="fas fa-file-export"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Quản lý Dữ liệu</h5>
                        <p class="text-slate-600 small">
                            Hỗ trợ Sao lưu dữ liệu an toàn về máy, Nhập liệu hàng loạt từ Excel và Xuất báo cáo chi tiết chỉ với một cú click chuột.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="section-title">Các phím tắt & Thao tác nhanh</h4>
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="bg-white p-4 rounded-4 border">
                            <h6 class="fw-bold text-slate-800 mb-3"><i class="fas fa-keyboard me-2 text-primary"></i>Phím tắt Bàn phím</h6>
                            <ul class="feature-list mb-0">
                                <li class="mb-2 p-0 border-0">
                                    <span class="badge bg-light text-dark border me-2">Double Click</span> 
                                    <span class="text-sm">Chọn một dòng để thao tác</span>
                                </li>
                                <li class="mb-2 p-0 border-0">
                                    <span class="badge bg-light text-dark border me-2">Delete / Backspace</span> 
                                    <span class="text-sm">Xóa dòng đã chọn (Có xác nhận)</span>
                                </li>
                                <li class="mb-0 p-0 border-0">
                                    <span class="badge bg-light text-dark border me-2">Click ra ngoài</span> 
                                    <span class="text-sm">Hủy chọn dòng hiện tại</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="bg-white p-4 rounded-4 border">
                            <h6 class="fw-bold text-slate-800 mb-3"><i class="fas fa-magic me-2 text-warning"></i>Nhập liệu Thông minh</h6>
                            <ul class="feature-list mb-0">
                                <li class="mb-2 p-0 border-0">
                                    <span class="text-sm">Nhập <strong>"1 tuần"</strong>, <strong>"15 ngày"</strong> vào cột Ngày giao hàng → Tự cộng ngày.</span>
                                </li>
                                <li class="mb-2 p-0 border-0">
                                    <span class="text-sm">Nhập tên Khoa/Phòng mới → Hệ thống tự tạo Khoa & Tài khoản.</span>
                                </li>
                                <li class="mb-0 p-0 border-0">
                                    <span class="text-sm">Lọc theo <strong>Tháng/Năm</strong> → STT tự động đánh lại từ 1.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tracking & Progress Tab -->
        <div class="tab-pane fade" id="pills-tracking" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="instruction-card p-4">
                        <h5 class="fw-bold mb-4">Chi tiết Quy trình Mua sắm (PR)</h5>
                        <ul class="feature-list">
                            <li>
                                <div class="step-number">1</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Thêm mới PR</h6>
                                    <p class="text-slate-600 small mb-0">Nhập ở dòng đầu tiên (màu xanh). Chọn khoa, nhập nội dung và nhấn "Lưu nhanh".</p>
                                </div>
                            </li>
                            <li>
                                <div class="step-number">2</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Cập nhật các mốc thời gian</h6>
                                    <p class="text-slate-600 small mb-0">Lần lượt điền các ngày: Nhận PR, Duyệt PR, Báo giá, Làm PO, Duyệt PO, Ký HĐ, Nhận hàng.</p>
                                </div>
                            </li>
                            <li>
                                <div class="step-number">3</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Hoàn thành</h6>
                                    <p class="text-slate-600 small mb-0">Khi hoàn tất quy trình, đổi trạng thái sang "Hoàn thành" hoặc điền đủ các ngày để hệ thống tự cập nhật.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="instruction-card p-4 bg-light shadow-none border" style="height: auto !important;">
                        <h6 class="fw-bold mb-3 text-primary"><i class="fas fa-calculator me-2"></i>Cách tính Tiến độ (%)</h6>
                        <p class="text-slate-500 x-small mb-3">
                            Tiến độ được tính dựa trên số bước đã hoàn thành (đã có ngày) trên tổng số bước (6 hoặc 7 bước nếu có Hợp đồng).
                        </p>
                        
                        <div class="progress mb-3" style="height: 12px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%">30%</div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 40%">70%</div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%">100%</div>
                        </div>

                        <ul class="list-unstyled text-sm text-slate-600 space-y-2">
                            <li class="d-flex justify-content-between border-bottom pb-2">
                                <span>1. Nhận PR</span>
                                <span class="fw-bold">~16%</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom pb-2">
                                <span>2. Duyệt PR (chờ báo giá)</span>
                                <span class="fw-bold">~33%</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom pb-2">
                                <span>3. Có Báo giá (Chờ/Làm PO)</span>
                                <span class="fw-bold">~50%</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom pb-2">
                                <span>4. PO được tạo</span>
                                <span class="fw-bold">~66%</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom pb-2">
                                <span>5. PO được duyệt</span>
                                <span class="fw-bold">~83%</span>
                            </li>
                            <li class="d-flex justify-content-between pb-2">
                                <span>6. Nhận hàng / Ký HĐ</span>
                                <span class="fw-bold text-success">100%</span>
                            </li>
                        </ul>
                        <div class="mt-3 p-2 bg-white rounded border border-dashed text-xs text-slate-500">
                            <strong>Lưu ý:</strong> Nếu có bước "Ký Hợp đồng", quy trình sẽ tự động mở rộng thành 7 bước và tỷ lệ % sẽ được chia lại tương ứng.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings & Data Tab -->
        <div class="tab-pane fade" id="pills-settings" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="instruction-card p-4 h-100">
                        <h5 class="fw-bold mb-4">Cài đặt Hệ thống Mới</h5>
                        <p class="text-slate-600 mb-4">
                            Truy cập menu <strong>Cài đặt hệ thống</strong> để sử dụng các công cụ quản trị dữ liệu nâng cao.
                        </p>

                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start gap-3 p-3 bg-secondary bg-opacity-10 rounded-3">
                                <div class="fs-4 text-primary"><i class="fas fa-cloud-download-alt"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Sao lưu Dữ liệu (Backup)</h6>
                                    <p class="text-sm text-muted mb-0">Tải xuống toàn bộ cơ sở dữ liệu dưới dạng file .SQL. Dùng để dự phòng khi hệ thống gặp sự cố.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3 p-3 bg-success bg-opacity-10 rounded-3">
                                <div class="fs-4 text-success"><i class="fas fa-file-excel"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Nhập liệu từ Excel (Import)</h6>
                                    <p class="text-sm text-muted mb-0">
                                        Upload file Excel theo mẫu để thêm hàng loạt PR. Hệ thống tự động:
                                        <ul class="mb-0 ps-3 mt-1" style="font-size: 0.85rem;">
                                            <li>Tạo mới Khoa/Phòng nếu chưa có.</li>
                                            <li>Tạo tài khoản đăng nhập cho Khoa mới.</li>
                                            <li>Chuẩn hóa định dạng ngày tháng.</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="instruction-card p-5 text-center d-flex flex-column justify-content-center">
                        <div class="icon-box bg-rose-light mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">An toàn Dữ liệu</h4>
                        <p class="text-slate-600 mb-4 px-lg-4">
                            Khuyến nghị Admin thực hiện <strong>Sao lưu dữ liệu định kỳ hàng tuần</strong> và thay đổi mật khẩu quản trị ít nhất 90 ngày một lần để đảm bảo an toàn tuyệt đối.
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('admin.settings') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold" style="background: var(--primary-gradient); border: none;">
                                <i class="fas fa-cog me-2"></i>Đi tới Cài đặt
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Help -->
    <div class="text-center mt-5 pt-4 border-top">
        <p class="text-slate-400 small">
            &copy; {{ date('Y') }} <strong>Bệnh Viện Đa Khoa Tâm Trí Cao Lãnh</strong> - Hệ thống quản lý Mua sắm.
        </p>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@endsection
