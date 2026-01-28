@extends('layouts.admin')

@section('title', 'Hướng dẫn sử dụng')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <!-- Header Section -->
    <div class="mb-12 text-center">
        <div class="inline-flex items-center justify-center p-3 bg-blue-50 rounded-2xl text-blue-600 mb-4 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <h1 class="text-4xl font-black text-slate-800 tracking-tight mb-3">Trung tâm Hướng dẫn Admin</h1>
        <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">Khám phá và nắm vững mọi công cụ quản trị để vận hành hệ thống mua sắm hiệu quả nhất.</p>
    </div>

    <!-- Quick Navigation -->
    <div class="grid md:grid-cols-3 gap-6 mb-16">
        <a href="#overview" class="p-6 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-50 hover:scale-[1.02] transition-all group">
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4 13h6a1 1 0 001-1V4a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1zm0 8h6a1 1 0 001-1v-4a1 1 0 00-1-1H4a1 1 0 00-1 1v4a1 1 0 001 1zm10 0h6a1 1 0 001-1v-8a1 1 0 00-1-1h-6a1 1 0 00-1 1v8a1 1 0 001 1zm0-18v4a1 1 0 001 1h6a1 1 0 001-1V4a1 1 0 00-1-1h-6a1 1 0 00-1 1z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Tổng quan</h3>
            <p class="text-sm text-slate-500">Theo dõi số liệu và biểu đồ tăng trưởng PR.</p>
        </a>
        <a href="#tracking" class="p-6 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-50 hover:scale-[1.02] transition-all group">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Theo dõi PR</h3>
            <p class="text-sm text-slate-500">Quản lý dòng thời gian và cập nhật trạng thái đơn hàng.</p>
        </a>
        <a href="#settings" class="p-6 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-50 hover:scale-[1.02] transition-all group">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Bảo mật</h3>
            <p class="text-sm text-slate-500">Cập nhật mật khẩu và thông tin quản trị viên.</p>
        </a>
    </div>

    <!-- Content Sections -->
    <div class="space-y-12">
        <!-- Section 1: Dashboard -->
        <section id="overview" class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-slate-200/40 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-12 opacity-[0.03] pointer-events-none">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M4 13h6a1 1 0 001-1V4a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1zm0 8h6a1 1 0 001-1v-4a1 1 0 00-1-1H4a1 1 0 00-1 1v4a1 1 0 001 1zm10 0h6a1 1 0 001-1v-8a1 1 0 00-1-1h-6a1 1 0 00-1 1v8a1 1 0 001 1zm0-18v4a1 1 0 001 1h6a1 1 0 001-1V4a1 1 0 00-1-1h-6a1 1 0 00-1 1z"/></svg>
            </div>
            <div class="relative">
                <div class="flex items-center space-x-3 mb-6">
                    <span class="px-4 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-black uppercase tracking-widest rounded-full">Tính năng</span>
                    <h2 class="text-2xl font-black text-slate-800">Trang Tổng Quan</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold text-slate-800 mb-2 flex items-center">
                                <span class="w-6 h-6 bg-indigo-600 text-white rounded-md flex items-center justify-center text-[10px] mr-2">01</span>
                                Thống kê YTD (Năm hiện tại)
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Xem tổng số PR, số lượng đang xử lý và các PR đã hoàn thành trong năm. Dữ liệu tự động cập nhật theo thời gian thực.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 mb-2 flex items-center">
                                <span class="w-6 h-6 bg-indigo-600 text-white rounded-md flex items-center justify-center text-[10px] mr-2">02</span>
                                Biểu đồ xu hướng
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Theo dõi biểu đồ đường để thấy sự biến động PR qua 12 tháng. Giúp dự báo khối lượng công việc trong tương lai.</p>
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 italic text-slate-500 text-sm leading-relaxed">
                        <svg class="w-8 h-8 text-indigo-400 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        "Sử dụng bộ lọc năm ở góc phải phía trên biểu đồ để xem lại lịch sử dữ liệu của các năm trước đó."
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Tracking -->
        <section id="tracking" class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-slate-200/40 relative overflow-hidden text-right">
            <div class="absolute top-0 left-0 p-12 opacity-[0.03] pointer-events-none">
                <svg class="w-64 h-64" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div class="relative">
                <div class="flex items-center justify-end space-x-3 mb-6 font-bold">
                    <h2 class="text-2xl font-black text-slate-800">Theo dõi Mua hàng</h2>
                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-black uppercase tracking-widest rounded-full">Trọng tâm</span>
                </div>
                <div class="grid md:grid-cols-2 gap-10">
                    <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 italic text-slate-500 text-sm leading-relaxed text-left">
                        <svg class="w-8 h-8 text-emerald-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        "Tất cả các mốc thời gian PR được trình bày dạng Timeline. Click vào nút 'Sửa' để cập nhật nhanh các mốc ngày quan trọng."
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold text-slate-800 mb-2 flex items-center justify-end">
                                Quản lý trạng thái
                                <span class="w-6 h-6 bg-emerald-600 text-white rounded-md flex items-center justify-center text-[10px] ml-2">03</span>
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Cập nhật trạng thái từ 'Chờ báo giá' đến 'Hoàn thành'. Màu sắc huy hiệu sẽ tự động thay đổi theo độ ưu tiên và tiến độ.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 mb-2 flex items-center justify-end">
                                Xuất báo cáo Excel
                                <span class="w-6 h-6 bg-emerald-600 text-white rounded-md flex items-center justify-center text-[10px] ml-2">04</span>
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Dễ dàng xuất toàn bộ dữ liệu theo dõi ra file Excel chuyên nghiệp chỉ với 1 click chuột để báo cáo lãnh đạo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: Security -->
        <section id="settings" class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[2.5rem] p-10 shadow-2xl shadow-blue-200 relative overflow-hidden text-white">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-8">
                    <span class="px-4 py-1.5 bg-white/20 backdrop-blur-md text-white text-xs font-black uppercase tracking-widest rounded-full border border-white/20">Bảo mật</span>
                    <h2 class="text-2xl font-black">Cài đặt & Bảo mật</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-all">
                            <h4 class="font-bold text-white mb-2 text-lg">Đổi mật khẩu định kỳ</h4>
                            <p class="text-blue-100 text-sm leading-relaxed">Luôn đảm bảo mật khẩu mới khác ít nhất 8 ký tự và khác hoàn toàn mật khẩu cũ. Hệ thống có cơ chế kiểm tra tính duy nhất để bảo vệ bạn.</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-all">
                            <h4 class="font-bold text-white mb-2 text-lg">Quản lý phiên đăng xuất</h4>
                            <p class="text-blue-100 text-sm leading-relaxed">Luôn nhớ đăng xuất khi sử dụng máy tính công cộng. Nút đăng xuất màu đỏ nổi bật ở cuối sidebar giúp bạn thoát nhanh chóng.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="inline-block p-8 bg-white/10 rounded-full border-4 border-white/5 mb-6 animate-bounce">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <p class="font-black text-xl">Dữ liệu của bạn luôn được mã hóa an toàn nhất!</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer Action -->
    <div class="mt-20 p-8 bg-white rounded-3xl border-2 border-dashed border-slate-200 text-center">
        <h4 class="text-xl font-bold text-slate-800 mb-2">Bạn vẫn cần trợ giúp?</h4>
        <p class="text-slate-500 mb-6">Đội ngũ kỹ thuật luôn sẵn sàng hỗ trợ bạn 24/7.</p>
        <a href="mailto:support@hospital.com" class="inline-flex items-center space-x-2 px-8 py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            <span>Liên hệ hỗ trợ kỹ thuật</span>
        </a>
    </div>
</div>
@endsection
