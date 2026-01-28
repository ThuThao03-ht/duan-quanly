<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Quản lý PR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Blue gradient background elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-400/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-400/20 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md z-10">
        <div class="glass p-8 rounded-3xl shadow-2xl space-y-8">
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Chào mừng quay lại</h1>
                <p class="text-slate-500 font-medium">Hệ thống Quản lý PR Bệnh viện</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-slate-700 ml-1">Tên đăng nhập</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="block w-full pl-10 pr-4 py-3 bg-white/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none"
                            placeholder="Nhập tên đăng nhập...">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-slate-700 ml-1">Mật khẩu</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="block w-full pl-10 pr-4 py-3 bg-white/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none"
                            placeholder="••••••••">
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm font-medium animate-pulse border border-red-100 italic">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <!-- <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 font-medium">Ghi nhớ</label>
                    </div>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">Quên mật khẩu?</a>
                </div> -->

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transition-all active:scale-[0.98] focus:ring-4 focus:ring-blue-500/20">
                    Đăng nhập ngay
                </button>
            </form>


        </div>
    </div>
</body>
</html>
