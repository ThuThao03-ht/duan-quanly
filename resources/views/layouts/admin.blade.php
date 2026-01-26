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

        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-4 mb-3">Main Navigation</p>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="font-semibold">Bảng điều khiển</span>
            </a>

            <a href="{{ route('admin.tracking') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.tracking') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.tracking') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold">Theo dõi Mua hàng</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="bg-slate-50 rounded-2xl p-4 flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-tight">Quản trị viên</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-white border border-slate-200 text-slate-600 py-2.5 rounded-xl font-bold hover:bg-red-50 hover:text-red-500 hover:border-red-100 transition-all duration-200 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    <span>Đăng xuất</span>
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
