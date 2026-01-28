<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal') - Quản lý PR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('styles')
    <style>
        body { 
            font-family: 'Outfit', sans-serif;
            height: 100vh;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-72 bg-white border-r border-slate-200 h-screen flex flex-col z-50 shrink-0">
        <div class="p-6 border-b border-slate-100 flex flex-col items-center justify-center space-y-3">
            <img src="{{ asset('images/logo.jpg') }}" alt="Tâm Trí Cao Lãnh" class="h-16 w-auto object-contain rounded-xl shadow-sm">
            <div class="text-center flex flex-col items-center">
                <span class="text-[11px] font-black bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 uppercase tracking-[0.1em] leading-tight">Bệnh Viện Đa Khoa</span>
                <span class="text-[15px] font-[900] bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 uppercase tracking-tight leading-none mt-0.5">Tâm Trí Cao Lãnh</span>
            </div>
        </div>

        <nav class="flex-1 p-3 space-y-1.5 overflow-y-auto custom-scrollbar min-h-0">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-4 mb-2">Menu Chính</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-600 shadow-xl shadow-blue-100/50 border-[1.5px] border-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 border-[1.5px] border-transparent' }}">
                        <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 13h6a1 1 0 001-1V4a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1zm0 8h6a1 1 0 001-1v-4a1 1 0 00-1-1H4a1 1 0 00-1 1v4a1 1 0 001 1zm10 0h6a1 1 0 001-1v-8a1 1 0 00-1-1h-6a1 1 0 00-1 1v8a1 1 0 001 1zm0-18v4a1 1 0 001 1h6a1 1 0 001-1V4a1 1 0 00-1-1h-6a1 1 0 00-1 1z"/>
                            </svg>
                        </div>
                        <span class="font-bold text-[14px]">Tổng quan</span>
                    </a>

                    <a href="{{ route('admin.tracking') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.tracking') ? 'bg-white text-blue-600 shadow-xl shadow-blue-100/50 border-[1.5px] border-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 border-[1.5px] border-transparent' }}">
                        <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('admin.tracking') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-bold text-[14px]">Theo dõi mua hàng</span>
                    </a>
                </div>
            </div>

            <div class="pt-2">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-4 mb-2">Cài đặt</p>
                <div class="space-y-1">
                    <a href="#" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 group text-slate-500 hover:bg-slate-50 hover:text-blue-600 border-[1.5px] border-transparent">
                        <div class="flex items-center justify-center w-8 h-8 text-slate-400 group-hover:text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="font-bold text-[14px]">Cài đặt hệ thống</span>
                    </a>

                    <a href="{{ route('admin.change-password') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.change-password') ? 'bg-white text-blue-600 shadow-xl shadow-blue-100/50 border-[1.5px] border-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 border-[1.5px] border-transparent' }}">
                        <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('admin.change-password') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <span class="font-bold text-[14px]">Đổi mật khẩu</span>
                    </a>

                    <a href="{{ route('admin.instructions') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.instructions') ? 'bg-white text-blue-600 shadow-xl shadow-blue-100/50 border-[1.5px] border-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 border-[1.5px] border-transparent' }}">
                        <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('admin.instructions') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="font-bold text-[14px]">Hướng dẫn sử dụng</span>
                    </a>
                </div>
            </div>
        </nav>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="bg-slate-50 rounded-2xl p-4 flex items-center space-x-3">
                <div class="bg-blue-600 rounded-full flex-none flex items-center justify-center text-white font-bold uppercase" style="width: 40px; height: 40px; min-width: 40px; min-height: 40px;">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div class="flex-1 min-w-0 flex flex-col justify-center">
                    <p class="text-[14px] font-bold text-slate-800 truncate leading-tight mb-0.5">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest leading-none">QUẢN TRỊ VIÊN</p>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" class="mt-4 px-1">
                @csrf
                <button type="submit" class="w-full h-11 flex items-center justify-center space-x-2 font-bold transition-all duration-300 text-sm border-none shadow-lg shadow-red-100/50 hover:bg-red-700 hover:shadow-red-200" style="background-color: #dc2626 !important; color: #ffffff !important; border-radius: 1rem !important;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="font-bold">Đăng xuất</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 min-w-0 h-screen overflow-y-auto overflow-x-hidden bg-slate-50/50 p-8">
        @yield('content')
    </main>

    @yield('scripts')

    @yield('scripts')

    <!-- Global Toast Notification -->
    @if(session('success'))
    <style>
        @keyframes toast-slide-in {
            0% { transform: translateX(calc(100% + 2rem)); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        @keyframes toast-slide-out {
            0% { transform: translateX(0); opacity: 1; }
            100% { transform: translateX(calc(100% + 2rem)); opacity: 0; }
        }
        .toast-show { animation: toast-slide-in 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .toast-hide { animation: toast-slide-out 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
    </style>

    <div id="toast-container" class="fixed top-8 right-8 z-[10000] pointer-events-none">
        <div id="toast-success" class="toast-show pointer-events-auto flex items-center p-1.5 pr-8 rounded-full shadow-[10px_15px_30px_-5px_rgba(16,185,129,0.3)]" 
             style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); min-width: 280px; border: none !important;">
            <div class="flex-none flex items-center justify-center w-9 h-9 bg-white rounded-full shadow-sm" style="color: #10b981;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-[14px] font-extrabold text-white tracking-tight" style="margin: 0; text-shadow: 0 1px 2px rgba(0,0,0,0.1);">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>

    <script>
        function closeToast() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.classList.remove('toast-show');
                toast.classList.add('toast-hide');
                setTimeout(() => toast.remove(), 500);
            }
        }
        setTimeout(closeToast, 3000);
    </script>
    @endif
</body>
</html>
