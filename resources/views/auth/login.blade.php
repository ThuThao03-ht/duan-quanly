<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Quản lý PR</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('/images/nen.jpg');
            background-size: 130%;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .login-wrapper {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center; /* Default center for mobile */
        }

        /* Large screens: Align left */
        @media (min-width: 992px) {
            .login-wrapper {
                justify-content: flex-start;
                padding-left: 8%; /* Leave space on left */
            }
        }

        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 60px;
            width: 100%;
            max-width: 760px;
            position: relative;
            z-index: 10;
        }

        /* Brand Header */
        .brand-header {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 20;
        }

        .brand-logo {
            width: 50px; /* Slightly larger since no border */
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-text h1 {
            color: rgba(0, 47, 255, 0.73);
            font-size: 30px;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            /* text-shadow: 0 2px 8px rgba(0,0,0,0.9); */
        }
        
        .brand-text p {
            color: rgba(0, 47, 255, 0.73);
            font-size: 15px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Language Button */
        .language-btn {
            position: absolute;
            top: 30px;
            right: 30px;
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            backdrop-filter: blur(5px);
            transition: all 0.2s;
            z-index: 20;
        }
        
        .language-btn:hover {
            background: rgba(0,0,0,0.3);
            color: white;
        }

        /* Card Titles */
        .card-title-welcome {
            font-size: 20px;
            font-weight: 700;
            color: rgba(0, 47, 255, 0.73);
            margin-bottom: 5px;
        }
        .card-title-portal {
            font-size: 28px;
            font-weight: 800;
            color: rgba(0, 47, 255, 0.73);
            margin-bottom: 5px;
        }
        .card-subtitle {
            font-size: 14px;
            color: rgba(0, 47, 255, 0.73);
            margin-bottom: 30px;
            font-weight: 500;
        }

        /* Info Box */
        .info-box {
            background-color: #f0f7ff;
            border: 1px solid #dbeafe;
            border-radius: 20px;
            padding: 20px 25px;
            margin-bottom: 35px;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            position: relative;
            padding-left: 20px;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.5;
            font-weight: 500;
        }

        .info-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            top: 0px;
            color: #2563eb; 
            font-size: 18px;
            line-height: 1;
        }

        /* Input Styles */
        .form-group-custom {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control-custom {
            width: 100%;
            height: 54px; /* Fixed height for pill */
            border: none;
            background-color: #f1f5f9; /* Light gray/blue bg */
            border-radius: 50px;       /* Pill shape */
            padding: 0 20px 0 55px;    /* Left padding for icon */
            font-size: 15px;
            color: #0563faff;
            transition: all 0.3s;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.03);
        }

        .form-control-custom:focus {
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            z-index: 5;
            display: flex;
            align-items: center;
        }
        
        .form-control-custom:focus + .input-icon,
        .form-control-custom:focus ~ .input-icon {
            color: #2563eb;
        }

        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            border: none;
            background: none;
            z-index: 5;
            padding: 0;
            display: flex;
            align-items: center;
        }
        
        .password-toggle:hover {
            color: #2563eb;
        }

        /* Form Options */
        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
        }
        .form-check-label {
            color: #64748b;
            font-size: 14px;
            cursor: pointer;
            user-select: none;
        }
        .forgot-link {
            font-weight: 600;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Login Button */
        .btn-login {
            background-color: #2563eb; /* Bright Blue */
            color: white;
            border: none;
            border-radius: 50px; /* Pill shape */
            padding: 15px;
            font-weight: 700;
            width: 100%;
            text-transform: uppercase;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background-color: #1d4ed8;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(37, 99, 235, 0.3);
        }

        /* Footer Guidance */
        .footer-guidance {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }

        .footer-guidance a {
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 5px;
            text-transform: uppercase;
        }
        
        .footer-guidance a.register {
            color: #2563eb;
        }
        
        .footer-guidance a:hover {
            color: #2563eb;
        }

        .copyright-text {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            color: rgba(255, 255, 255, 1);
            font-size: 15px;
            z-index: 20;
        }
    </style>
</head>
<body>

    <!-- Brand Header -->
    <div class="brand-header">
        <div class="brand-logo">
            <img src="/images/logo_login.png" alt="Logo" style="width: 250%; height: 250%; object-fit: contain;">
        </div>
        <div class="brand-text">
            <h1>BỆNH VIỆN ĐA KHOA </h1>
            <p>TÂM TRÍ CAO LÃNH</p>
        </div>
    </div>

    <!-- Language Button -->
    <!-- <a href="#" class="language-btn">
        Tiếng Việt
    </a> -->

    <!-- Main Wrapper -->
    <div class="container-fluid p-0">
        <div class="login-wrapper">
            
            <!-- Login Card -->
            <div class="login-card animate-up">
                <div class="text-center mb-4">
                    <h2 class="card-title-welcome">CHÀO MỪNG ĐẾN VỚI</h2>
                    <h1 class="card-title-portal">PORTAL QUẢN LÝ PR</h1>
                    <p class="card-subtitle">HỆ THỐNG QUẢN LÝ THÔNG TIN BỆNH VIỆN</p>
                </div>

                <!-- Info Box -->
                <div class="info-box">
                    <ul class="info-list">
                        <li>Sử dụng mã nhân viên để đăng nhập.</li>
                        <li>Liên hệ phòng IT nếu bạn quên mật khẩu.</li>
                    </ul>
                </div>

                <!-- Form -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <!-- Username -->
                    <div class="form-group-custom">
                        <span class="input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </span>
                        <input type="text" class="form-control-custom" name="name" placeholder="Tên đăng nhập" value="{{ old('name') }}" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group-custom">
                        <span class="input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                        </span>
                        <input type="password" class="form-control-custom" name="password" placeholder="Mật khẩu" required>
                        <button type="button" class="password-toggle">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                        </button>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 px-3 small border-0 bg-danger-subtle text-danger mb-4 rounded-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Ghi nhớ
                            </label>
                        </div>
                        <a href="#" class="forgot-link">Quên mật khẩu?</a>
                    </div> -->

                    <button type="submit" class="btn-login">
                        ĐĂNG NHẬP
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>

                    <!-- <div class="footer-guidance">
                        <a href="#">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/>
                            </svg>
                            HƯỚNG DẪN
                        </a>
                        <a href="#" class="register">ĐĂNG KÝ MỚI</a>
                    </div> -->
                </form>
            </div>

        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright-text">
        © 2026 Bệnh Viện Đa Khoa Tâm Trí Cao Lãnh.
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.password-toggle');
            const passwordInput = document.querySelector('input[name="password"]');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    // Toggle type
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle icon opacity/color or switch icon to indicate state if desired
                    // For now simple toggle is enough as per request
                    this.style.color = type === 'text' ? '#2563eb' : '#94a3b8';
                });
            }
        });
    </script>
</body>
</html>
