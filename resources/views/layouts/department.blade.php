<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Department Portal')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-color: #3b82f6; /* Blue 500 */
            --primary-light: #eff6ff90; /* Blue 50 transparent */
            --sidebar-width: 260px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            overflow: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: white;
            border-right: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        
        .sidebar-logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem 1.5rem;
        }

        .logo-box {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            border-radius: 12px;
            /* background: #f8fafc; Optional: square bg like mockup */
        }
        
        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .brand-text {
            font-size: 0.65rem;
            font-weight: 700;
            color: #0011ffff;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-align: center;
        }
        
        /* Navigation */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 1.5rem;
        }
        
        .menu-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.75rem;
            margin-top: 1.5rem;
        }
        
        .menu-label:first-child {
            margin-top: 0;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            position: relative;
        }
        
        .nav-item:hover {
            background-color: #f8fafc;
            color: #1e293b;
        }
        
        .nav-item.active {
            background-color: #eff6ff; /* Light blue bg */
            color: #2563eb; /* Blue text */
        }
        
        .nav-item.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 24px;
            width: 4px;
            background: #2563eb;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        
        .nav-item svg {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            /* opacity: 0.7; */
        }
        
        .nav-item.active svg {
            opacity: 1;
        }

        .menu-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 1.5rem 0;
        }
        
        /* Sidebar Profile - Fixed at bottom */
        .sidebar-profile {
            padding: 1rem 1.5rem;
            border-top: 1px solid #f1f5f9;
            background: white;
        }
        
        .profile-info {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #0026ffff;
            margin-right: 12px;
        }
        
        .profile-name {
            font-size: 0.875rem;
            font-weight: 700;
            color: #002affff;
            margin-bottom: 2px;
        }
        
        .profile-role {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        .btn-logout {
            width: 100%;
            padding: 0.625rem;
            border: 1px solid #f0e2e2ff;
            background: white;
            color: #ff0000ff;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(245, 214, 214, 1);
        }
        
        .btn-logout:hover {
            background: #f8fafc;
        }
        
        .btn-logout svg {
            width: 16px;
            height: 16px;
        }
        
        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-header {
            height: 70px;
            background: white;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }
        
        .header-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .main-content {
            flex: 1;
            overflow-y: auto;
            background: #f8f9fa;
            padding: 2rem;
        }
        
        /* Scrollbar */
        .sidebar-nav::-webkit-scrollbar,
        .main-content::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar-nav::-webkit-scrollbar-track,
        .main-content::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar-nav::-webkit-scrollbar-thumb,
        .main-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .sidebar-nav::-webkit-scrollbar-thumb:hover,
        .main-content::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Logo -->
        <div class="sidebar-logo-container">
            <div class="logo-box">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-img">
            </div>
            <div class="brand-text">BỆNH VIỆN ĐK TÂM TRÍ CAO LÃNH</div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
            <div class="menu-label">QUẢN LÝ CHÍNH</div>
            
            <a href="{{ route('department.dashboard') }}" class="nav-item {{ request()->routeIs('department.dashboard') ? 'active' : '' }}">
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Tổng quan
            </a>

            <a href="{{ route('department.orders.index') }}" class="nav-item {{ request()->routeIs('department.orders.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Quản lý Đơn hàng
            </a>

            <div class="menu-divider"></div>

            <div class="menu-label">HỆ THỐNG</div>

            <a href="{{ route('department.guide') }}" class="nav-item {{ request()->routeIs('department.guide') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Cài đặt & Hướng dẫn
            </a>

            <a href="{{ route('department.password.change') }}" class="nav-item {{ request()->routeIs('department.password.change') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Đổi mật khẩu
            </a>
        </nav>

        <!-- User Profile - Fixed at bottom -->
        <div class="sidebar-profile">
            @php
                $user = auth()->user();
                $profileName = $user->department ? $user->department->name : $user->name;
                
                $initials = '';
                $words = explode(' ', $profileName);
                if (count($words) >= 2) {
                    $initials = mb_strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
                } else {
                    $initials = mb_strtoupper(mb_substr($profileName, 0, 2));
                }
            @endphp
            <div class="profile-info">
                <div class="profile-avatar">{{ $initials }}</div>
                <div>
                    <div class="profile-name">{{ $profileName }}</div>
                    <!-- <div class="profile-role">Portal Quản lý</div> -->
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Đăng xuất
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Top Header -->
        <header class="main-header">
            <h2 class="header-title">@yield('header-title')</h2>
            <div class="header-actions">
                <!-- <button class="btn-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="badge"></span>
                </button>
                <button class="btn-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button> -->
            </div>
        </header>

        <!-- Main Scrollable Content -->
        <main class="main-content">


            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
