<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal') - Quản lý PR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        <div class="p-6 border-b border-slate-100 flex items-center space-x-3">
            <div class="p-2 bg-blue-600 rounded-xl text-white shadow-lg shadow-blue-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Admin Portal</span>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] px-4 mb-4">Menu Chính</p>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-600 shadow-xl shadow-slate-200/60 border border-slate-50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <div class="p-1 px-1.5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 13h6a1 1 0 001-1V4a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1zm0 8h6a1 1 0 001-1v-4a1 1 0 00-1-1H4a1 1 0 00-1 1v4a1 1 0 001 1zm10 0h6a1 1 0 001-1v-8a1 1 0 00-1-1h-6a1 1 0 00-1 1v8a1 1 0 001 1zm0-18v4a1 1 0 001 1h6a1 1 0 001-1V4a1 1 0 00-1-1h-6a1 1 0 00-1 1z"/>
                    </svg>
                </div>
                <span class="font-bold text-[15px]">Tổng quan</span>
            </a>

            <a href="{{ route('admin.tracking') }}" 
               class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.tracking') ? 'bg-white text-blue-600 shadow-xl shadow-slate-200/60 border border-slate-50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.tracking') ? 'bg-blue-50 text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-bold text-[15px]">Theo dõi Mua hàng</span>
            </a>

            <div class="pt-4 mt-2">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] px-4 mb-4">Cài đặt</p>
                
                <a href="#" 
                   class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group text-slate-500 hover:bg-slate-50 hover:text-blue-600">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 group-hover:text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="font-bold text-[15px]">Cài đặt hệ thống</span>
                </a>

                <a href="#" 
                   class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl transition-all duration-300 group text-slate-500 hover:bg-slate-50 hover:text-blue-600">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 group-hover:text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <span class="font-bold text-[15px]">Đổi mật khẩu</span>
                </a>
            </div>
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
</body>
</html>
