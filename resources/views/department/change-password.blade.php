@extends('layouts.department')

@section('title', 'Đổi mật khẩu - Department Portal')

@section('content')
<style>
    /* Custom styles for this page */
    .password-card {
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
        border: none;
    }
    
    .icon-wrapper {
        width: 64px;
        height: 64px;
        background: #F0F5FF;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .page-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    .page-subtitle {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        font-size: 0.9rem;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        background-color: #fff;
    }
    
    .input-group-text {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-left: none;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        color: #94a3b8;
    }
    
    .form-control.has-toggle {
        border-right: none;
        border-radius: 8px 0 0 8px;
    }

    .input-group:focus-within .input-group-text {
        border-color: #3b82f6;
        background-color: #fff;
    }
    
    .helper-text {
        font-size: 0.8rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        margin-top: 0.5rem;
    }
    
    .helper-dot {
        width: 6px;
        height: 6px;
        background-color: #cbd5e1;
        border-radius: 50%;
        margin-right: 8px;
        display: inline-block;
    }
    
    .btn-submit {
        background-color: #3b82f6;
        border: none;
        padding: 0.875rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.2s;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
    }
    
    .btn-submit:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 6px 8px -1px rgba(59, 130, 246, 0.3);
    }
</style>

<div class="row justify-content-center py-5">
    <div class="col-md-10 col-lg-8">
        <div class="card password-card">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-5">
                    <div class="icon-wrapper">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.5 2v6h6M2.66 15.57a10 10 0 1 0 .57-8.38"/>
                            <rect x="9" y="11" width="6" height="8" rx="1"/>
                            <path d="M12 11V7a1 1 0 0 1 1-1h0a1 1 0 0 1 1 1v4"/>
                        </svg>
                    </div>
                    <h1 class="page-title" style="font-size: 1.75rem;">Đổi mật khẩu</h1>
                    <p class="page-subtitle" style="font-size: 1rem; max-width: 450px;">Cập nhật mật khẩu định kỳ để bảo vệ an toàn cho tài khoản và dữ liệu hệ thống bệnh viện của bạn.</p>
                </div>

                @if(session('success'))
                    <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9998; backdrop-filter: blur(2px);"></div>
                    <div class="alert alert-success border-0 bg-white" role="alert" 
                         style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; padding: 2.5rem; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); min-width: 400px; display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid #f0f0f0;">
                        <div style="width: 80px; height: 80px; background: #ecfdf5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                            <svg class="text-success" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: #1e293b; font-size: 1.5rem;">Thành công!</h4>
                        <div class="mb-4" style="color: #64748b; font-size: 1rem;">{{ session('success') }}</div>
                        <button type="button" class="btn btn-primary w-100 fw-bold" onclick="this.parentElement.previousElementSibling.remove(); this.parentElement.remove()" style="padding: 0.8rem; border-radius: 12px; font-size: 1rem; background-color: #3b82f6; border: none;">
                            Hoàn tất
                        </button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center mb-4 border-0 bg-danger-subtle text-danger" role="alert" style="padding: 1rem;">
                        <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <div class="fs-6">Vui lòng kiểm tra lại thông tin nhập vào.</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('department.password.update') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="current_password" class="form-label" style="font-size: 0.95rem;">Mật khẩu hiện tại</label>
                        <div class="input-group">
                            <input type="password" class="form-control has-toggle @error('current_password') is-invalid @enderror" 
                                id="current_password" name="current_password" placeholder="........." style="padding: 1rem;">
                            <span class="input-group-text" onclick="togglePassword('current_password', this)" style="padding: 0 1.25rem;">
                                <!-- Eye Icon -->
                                <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <!-- Eye Slash Icon (hidden by default) -->
                                <svg class="eye-slash-icon d-none" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </span>
                            @error('current_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="current-password-error" class="text-danger mt-1 fs-6 d-none">Mật khẩu không được để trống</div>
                    </div>

                    <div class="mb-2">
                        <label for="new_password" class="form-label" style="font-size: 0.95rem;">Mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" class="form-control has-toggle @error('new_password') is-invalid @enderror" 
                                id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" style="padding: 1rem;">
                            <span class="input-group-text" onclick="togglePassword('new_password', this)" style="padding: 0 1.25rem;">
                                <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="eye-slash-icon d-none" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </span>
                        </div>
                        @error('new_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div id="new-password-error" class="text-danger mt-1 fs-6 d-none"></div>
                    </div>
                    
                    <div class="mb-4 helper-text" style="font-size: 0.85rem;">
                        <span class="helper-dot"></span>
                        Mật khẩu phải có độ dài từ 6 đến 8 ký tự
                    </div>

                    <div class="mb-5">
                        <label for="new_password_confirmation" class="form-label" style="font-size: 0.95rem;">Xác nhận mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" class="form-control has-toggle" 
                                id="new_password_confirmation" name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới" style="padding: 1rem;">
                            <span class="input-group-text" onclick="togglePassword('new_password_confirmation', this)" style="padding: 0 1.25rem;">
                                <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="eye-slash-icon d-none" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </span>
                        </div>
                        <div id="password-match-error" class="text-danger mt-1 fs-6 d-none">Mật khẩu xác nhận không khớp</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-submit text-white" style="padding: 1rem; font-size: 1rem;">
                            Cập nhật mật khẩu mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, toggle) {
        const input = document.getElementById(inputId);
        const eyeIcon = toggle.querySelector('.eye-icon');
        const eyeSlashIcon = toggle.querySelector('.eye-slash-icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.classList.add('d-none');
            eyeSlashIcon.classList.remove('d-none');
        } else {
            input.type = 'password';
            eyeIcon.classList.remove('d-none');
            eyeSlashIcon.classList.add('d-none');
        }
    }

    // Password matching validation
    document.addEventListener('DOMContentLoaded', function() {
        const currentPassword = document.getElementById('current_password');
        const password = document.getElementById('new_password');
        const confirmPassword = document.getElementById('new_password_confirmation');
        
        const currentPasswordError = document.getElementById('current-password-error');
        const newPasswordError = document.getElementById('new-password-error');
        const matchError = document.getElementById('password-match-error');

        function validateCurrentPassword() {
            if (currentPassword.value.trim() === '') {
                currentPasswordError.classList.remove('d-none');
                currentPassword.classList.add('is-invalid');
                return false;
            } else {
                currentPasswordError.classList.add('d-none');
                currentPassword.classList.remove('is-invalid');
                return true;
            }
        }

        function validateNewPassword() {
            const val = password.value;
            if (val.trim() === '') {
                newPasswordError.textContent = 'Mật khẩu không được để trống';
                newPasswordError.classList.remove('d-none');
                password.classList.add('is-invalid');
                return false;
            } else if (val.length < 6 || val.length > 8) {
                newPasswordError.textContent = 'Mật khẩu phải có độ dài từ 6 đến 8 ký tự';
                newPasswordError.classList.remove('d-none');
                password.classList.add('is-invalid');
                return false;
            } else {
                newPasswordError.classList.add('d-none');
                password.classList.remove('is-invalid');
                return true;
            }
        }

        function validateMatch() {
            if (confirmPassword.value.trim() === '') {
                // If checking on submit, we might want to show required error
                // But generally users will type, so check mismatch primarily
                matchError.textContent = 'Vui lòng xác nhận mật khẩu';
                // Only show if user has interacted? For now show if not empty or on blur
            }
            
            if (confirmPassword.value && password.value !== confirmPassword.value) {
                matchError.textContent = 'Mật khẩu xác nhận không khớp';
                matchError.classList.remove('d-none');
                confirmPassword.classList.add('is-invalid');
                return false;
            } else if (confirmPassword.value) {
                matchError.classList.add('d-none');
                confirmPassword.classList.remove('is-invalid');
                return true;
            }
            return true; // Empty case handled differently usually, but let's clear error
        }

        currentPassword.addEventListener('input', validateCurrentPassword);
        password.addEventListener('input', () => {
            validateNewPassword();
            if (confirmPassword.value) validateMatch();
        });
        confirmPassword.addEventListener('input', validateMatch);
        
        // Optional: Block submit if invalid?
        // form.addEventListener('submit', ...)
    });
</script>
@endsection
