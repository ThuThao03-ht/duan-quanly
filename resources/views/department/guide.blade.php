@extends('layouts.department')

@section('title', 'Hướng dẫn sử dụng - Department Portal')

@section('content')
<style>
    .guide-header {
        text-align: center;
        padding: 3rem 1rem;
        background: white;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .guide-title {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 1rem;
    }
    .guide-subtitle {
        color: #64748b;
        max-width: 600px;
        margin: 0 auto 2rem;
    }
    .search-input-wrapper {
        max-width: 500px;
        margin: 0 auto;
        position: relative;
    }
    .search-input-wrapper input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border-radius: 50px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        transition: all 0.2s;
    }
    .search-input-wrapper input:focus {
        background: white;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    .search-input-wrapper i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    /* Section Styles */
    .step-number {
        width: 40px;
        height: 40px;
        background: #e0e7ff;
        color: #4f46e5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.25rem;
        margin-right: 1rem;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .content-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid #f1f5f9;
        margin-bottom: 2rem;
    }

    /* Feature Cards for Section 1 */
    .feature-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.25rem;
        height: 100%;
        transition: all 0.2s;
    }
    .feature-card:hover {
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }
    .feature-icon-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        color: #3b82f6;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    /* Sticky Sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 2rem;
    }
    
    .toc-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .toc-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        color: #64748b;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.2s;
        font-weight: 500;
        font-size: 0.9rem;
    }
    .toc-link:hover, .toc-link.active {
        background: #f1f5f9;
        color: #1e293b;
    }
    
    .help-card {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-radius: 16px;
        padding: 1.5rem;
        color: white;
        text-align: center;
    }
    .btn-help {
        background: white;
        color: #2563eb;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        width: 100%;
        margin-top: 1rem;
        transition: all 0.2s;
    }
    .btn-help:hover {
        background: #f8fafc;
        transform: translateY(-1px);
    }
</style>

<div class="container-fluid pb-5">
    <!-- Hero Header -->
    <div class="guide-header">
        <h1 class="guide-title">Hướng dẫn sử dụng Portal</h1>
        <p class="guide-subtitle">Tài liệu hướng dẫn chi tiết các chức năng dành cho Khoa/Phòng giúp bạn quản lý quy trình mua sắm hiệu quả và minh bạch.</p>
        
        <!-- <div class="search-input-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Tìm kiếm hướng dẫn (ví dụ: Tạo đơn hàng, Theo dõi tiến độ...)">
        </div> -->
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9">
            
            <!-- Section 1: Dashboard -->
            <div id="section-1" class="mb-5">
                <div class="section-header">
                    <div class="step-number">1</div>
                    <h2 class="section-title">Trang Tổng Quan (Dashboard)</h2>
                </div>
                <div class="content-card">
                    <p class="text-muted mb-4">Trang <strong>Tổng quan</strong> giúp bạn nắm bắt nhanh tình hình mua sắm của khoa phòng mình ngay khi vừa đăng nhập.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="feature-card">
                                <div class="feature-icon-title">
                                    <i class="fas fa-th-large"></i> Thẻ thống kê
                                </div>
                                <p class="small text-secondary mb-0">Hiển thị số lượng đơn hàng <span class="text-dark fw-bold">Tổng cộng</span>, <span class="text-warning fw-bold">Đang xử lý</span>, và <span class="text-success fw-bold">Hoàn thành</span>.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <div class="feature-icon-title">
                                    <i class="fas fa-chart-line"></i> Biểu đồ xu hướng
                                </div>
                                <p class="small text-secondary mb-0">Theo dõi số lượng yêu cầu mua sắm theo từng tháng trong năm (có thể chọn năm để xem lịch sử).</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <div class="feature-icon-title">
                                    <i class="fas fa-chart-pie"></i> Biểu đồ trạng thái
                                </div>
                                <p class="small text-secondary mb-0">Xem tỷ lệ phần trăm các đơn hàng theo trạng thái cụ thể để đánh giá hiệu suất xử lý.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <div class="feature-icon-title">
                                    <i class="fas fa-list"></i> Danh sách mới nhất
                                </div>
                                <p class="small text-secondary mb-0">Bảng hiển thị nhanh 5 đơn hàng gần nhất để bạn tiện truy cập ngay lập tức.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Order Management -->
            <div id="section-2" class="mb-5">
                <div class="section-header">
                    <div class="step-number">2</div>
                    <h2 class="section-title">Quản lý Đơn hàng (Danh sách)</h2>
                </div>
                <div class="content-card">
                    <p class="text-muted mb-4">Trang <strong>Danh sách đơn hàng</strong> là nơi tập trung quản lý toàn bộ các yêu cầu từ khi khởi tạo đến khi kết thúc.</p>
                    
                    <div class="d-flex gap-3 mb-3">
                        <div style="min-width: 40px; text-align: center;"><i class="fas fa-filter text-primary"></i></div>
                        <div>
                            <h6 class="fw-bold text-dark">Lọc nhanh & Tìm kiếm</h6>
                            <p class="small text-muted">Sử dụng các tab <span class="badge bg-light text-primary border">Đang xử lý</span> và <span class="badge bg-light text-success border">Đã hoàn thành</span> hoặc ô tìm kiếm theo <strong>Mã đơn hàng (#ORD-...)</strong> hoặc nội dung yêu cầu.</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-3">
                        <div style="min-width: 40px; text-align: center;"><i class="fas fa-info-circle text-secondary"></i></div>
                        <div>
                            <h6 class="fw-bold text-dark">Thông tin cột quan trọng</h6>
                             <ul class="small text-muted ps-3 mb-0">
                                <li><strong>Mã đơn & Khoa phòng:</strong> Định danh duy nhất cho mỗi đơn hàng.</li>
                                <li><strong>Trạng thái:</strong> Hiển thị tiến trình hiện tại.</li>
                                <li><strong>Hợp đồng:</strong> Biểu thị đơn hàng có yêu cầu ký hợp đồng hay không (CÓ/KHÔNG).</li>
                             </ul>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div style="min-width: 40px; text-align: center;"><i class="fas fa-mouse-pointer text-primary"></i></div>
                        <div>
                            <h6 class="fw-bold text-dark">Thao tác</h6>
                            <p class="small text-muted mb-0">Nhấn nút <span class="text-primary fw-bold">"Xem chi tiết"</span> ở cột cuối cùng để vào xem tiến độ cụ thể của đơn hàng đó.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Order Detail -->
            <div id="section-3" class="mb-5">
                <div class="section-header">
                    <div class="step-number">3</div>
                    <h2 class="section-title">Chi tiết Đơn hàng (Order Detail)</h2>
                </div>
                <div class="content-card">
                   <div class="row g-4">
                       <div class="col-md-6">
                           <div class="feature-card bg-white border">
                                <div class="badge bg-light text-dark mb-2">A</div>
                                <h6 class="fw-bold">Thông tin & Nội dung</h6>
                                <ul class="small text-secondary ps-3 mb-0">
                                    <li class="mb-1"><strong>Thẻ thông tin:</strong> Hiển thị Khoa/Phòng yêu cầu, Người tạo, và Ngày giờ tạo đơn.</li>
                                    <li><strong>Nội dung & Ghi chú giao hàng:</strong> Hiển thị nội dung yêu cầu gốc và các ghi chú đặc biệt về việc giao hàng (khung màu cam).</li>
                                </ul>
                           </div>
                       </div>
                       
                       <div class="col-md-6">
                           <div class="feature-card bg-white border">
                                <div class="badge bg-light text-dark mb-2">B</div>
                                <h6 class="fw-bold">Tiến độ mua sắm</h6>
                                <p class="small text-secondary mb-2">Timeline ngang hiển thị quy trình từ <em>Nhận PR &rarr; Duyệt PR &rarr; Báo giá &rarr; PO &rarr; Hợp đồng &rarr; Giao hàng</em>.</p>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle"> <i class="fas fa-check"></i> Bước đã xong</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle"> <i class="fas fa-pen"></i> Đang xử lý</span>
                                </div>
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="feature-card bg-white border">
                                <div class="badge bg-light text-dark mb-2">C</div>
                                <h6 class="fw-bold">Lý do & Trạng thái chi tiết</h6>
                                <p class="small text-secondary mb-2">Nằm ngay dưới timeline, hiển thị mô tả chi tiết cho giai đoạn hiện tại (Ví dụ: "Đang tìm báo giá").</p>
                                <p class="small text-secondary mb-0"><strong>Lý do chậm trễ:</strong> Nếu có vấn đề phát sinh, lý do sẽ hiển thị tại đây để khoa phòng nắm thông tin kịp thời.</p>
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="feature-card bg-white border">
                                <div class="badge bg-light text-dark mb-2">D</div>
                                <h6 class="fw-bold">Ghi chú & Lịch sử (Chat)</h6>
                                <p class="small text-secondary mb-2">Khung chat bên phải (Sidebar) hiển thị toàn bộ lịch sử trao đổi.</p>
                                <div class="p-2 bg-light rounded text-center small text-muted mb-2">
                                    <span class="text-primary">Admin/Hệ thống</span> trao đổi với <span class="text-dark fw-bold">Bạn</span>
                                </div>
                                <p class="small text-secondary mb-0">Bạn có thể nhập phản hồi hoặc câu hỏi vào ô nhập liệu ở dưới cùng và nhấn <strong>Gửi</strong>.</p>
                           </div>
                       </div>
                   </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="sticky-sidebar">
                <div class="toc-card shadow-sm">
                    <h6 class="text-uppercase text-secondary fw-bold small mb-3">Mục lục hướng dẫn</h6>
                    <ul class="toc-list">
                        <li><a href="#section-1" class="toc-link"><i class="fas fa-columns w-25px"></i> 1. Trang Tổng Quan</a></li>
                        <li><a href="#section-2" class="toc-link"><i class="fas fa-list w-25px"></i> 2. Quản lý Đơn hàng</a></li>
                        <li><a href="#section-3" class="toc-link"><i class="fas fa-file-alt w-25px"></i> 3. Chi tiết Đơn hàng</a></li>
                    </ul>
                </div>

                <div class="help-card shadow-lg">
                    <div class="mb-3">
                        <i class="far fa-question-circle fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Cần trợ giúp thêm?</h5>
                    <p class="small opacity-75 mb-4">Liên hệ đội ngũ kỹ thuật nếu bạn gặp bất kỳ khó khăn nào trong quá trình vận hành.</p>
                    <button class="btn-help">Gửi ticket hỗ trợ</button>
                    <div class="mt-3 small opacity-75">
                        <i class="fas fa-phone-alt me-1"></i> Hotline: 1234.5678
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
