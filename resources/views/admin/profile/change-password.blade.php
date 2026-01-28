@extends('layouts.admin')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Cài đặt bảo mật</h1>
        <p class="text-slate-500 mt-1">Quản lý và cập nhật mật khẩu đăng nhập của bạn.</p>
    </div>


    <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200/40 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.update-password') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label for="current_password" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] px-1">Mật khẩu hiện tại</label>
                    <div class="relative group">
                        <input type="password" name="current_password" id="current_password" required
                               class="block w-full px-5 py-3.5 bg-slate-50 border-0 focus:bg-white outline-none ring-0 focus:ring-0 rounded-2xl transition-all font-medium text-slate-800 placeholder:text-slate-300 pr-12 shadow-sm focus:shadow-md"
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword('current_password')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="text-red-600 text-[11px] font-bold mt-1.5 px-1 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="password" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] px-1">Mật khẩu mới</label>
                        <div class="relative group">
                            <input type="password" name="password" id="password" required
                                   class="block w-full px-5 py-3.5 bg-slate-50 border-0 focus:bg-white outline-none ring-0 focus:ring-0 rounded-2xl transition-all font-medium text-slate-800 placeholder:text-slate-300 pr-12 shadow-sm focus:shadow-md"
                                   placeholder="Tối thiểu 8 ký tự">
                            <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-[11px] font-bold mt-1.5 px-1 flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] px-1">Xác nhận mật khẩu</label>
                        <div class="relative group">
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="block w-full px-5 py-3.5 bg-slate-50 border-0 focus:bg-white outline-none ring-0 focus:ring-0 rounded-2xl transition-all font-medium text-slate-800 placeholder:text-slate-300 pr-12 shadow-sm focus:shadow-md"
                                   placeholder="Nhập lại mật khẩu">
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-600 text-[11px] font-bold mt-1.5 px-1 flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full sm:w-auto px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-xl shadow-blue-100 hover:shadow-blue-200 transition-all active:scale-95 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Cập nhật mật khẩu</span>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-indigo-50/50 p-6 flex items-start space-x-4">
            <div class="flex-none p-2.5 bg-white rounded-xl text-indigo-600 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[13px] font-bold text-indigo-900">Mẹo bảo mật</h4>
                <p class="text-xs text-indigo-500/80 mt-1 leading-relaxed">
                    Sử dụng mật khẩu mạnh bao gồm chữ cái thường, chữ hoa, số và ký tự đặc biệt để bảo vệ tài khoản tốt hơn.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const container = input.closest('.relative');
    const eyeOpen = container.querySelectorAll('.eye-open');
    const eyeClosed = container.querySelector('.eye-closed');

    if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.forEach(el => el.classList.add('hidden'));
        eyeClosed.classList.remove('hidden');
    } else {
        input.type = 'password';
        eyeOpen.forEach(el => el.classList.remove('hidden'));
        eyeClosed.classList.add('hidden');
    }
}
</script>
@endsection
