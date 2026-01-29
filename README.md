<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
## Cài đặt thư viện hỗ trợ

composer require maatwebsite/excel

php artisan make:export PurchaseRequestsExport --model=PurchaseRequest

php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config

dir vendor/maatwebsite/excel


## Cài đặt & chạy dự án

composer install

php artisan migrate

php artisan migrate:fresh --seed

php artisan db:seed --class=TrackingSeeder


npm install

npm run build


# Cập nhật tính năng tạo Khoa/Phòng và Tài khoản

# Các thay đổi chính
### 1. Cho phép nhập tên Khoa/Phòng mới
Tại giao diện "Theo dõi Mua hàng" (Admin Tracking), ô nhập liệu Khoa/Phòng (input kết hợp datalist) cho phép:

Chọn khoa cũ: Tìm và chọn từ danh sách có sẵn.

Nhập mới: Gõ tên khoa/phòng chưa có trong hệ thống (Ví dụ: Khoa Tim Mạch).

### 2. Tự động tạo dữ liệu (Backend)

Khi bạn nhập một tên khoa mới và nhấn lưu, hệ thống sẽ:

Tạo Khoa/Phòng mới: Lưu tên khoa vào bảng departments.

Tự động tạo tài khoản quản trị cho khoa đó:

Username: Được tạo tự động từ tên khoa bằng cách chuyển sang dạng không dấu, nối bằng gạch ngang (slug).

Ví dụ: Khoa Nhi -> khoa-nhi

Ví dụ: Xét nghiệm -> xet-nghiem

Password: Mặc định là 123456 (được mã hóa tự động khi lưu).

Phân quyền: Tài khoản này chỉ xem được dữ liệu của chính khoa đó.

Trường hợp 2: Tên Khoa mới nhưng trùng Username với khoa cũ

Ví dụ: Đã có Khoa Nhi (user: khoa-nhi). Bạn nhập thêm: Khoa Nhĩ (hoặc KHOA NHI, Khoa. Nhi).

Username dự kiến: khoa-nhi.

Hệ thống phát hiện user khoa-nhi ĐÃ TỒN TẠI.

Xử lý: Hệ thống sẽ KHÔNG tạo user mới (không có chuyện khoa-nhi1). Thay vào đó, nó sẽ tự động lấy thông tin Khoa Nhi cũ để gắn vào đơn hàng này.

Kết quả: Đơn hàng mới vẫn thuộc về khoa/user cũ. Đảm bảo MỖI KHOA CHỈ CÓ 1 TÀI KHOẢN DUY NHẤT.


### 3. File chỉnh sửa
app/Http/Controllers/Admin/TrackingController.php
:
Đã thêm thư viện Illuminate\Support\Str.
Cập nhật logic tạo user: sử dụng Str::slug($deptName) thay vì dùng mã viết tắt (code).
Kiểm tra
Bạn có thể thử nghiệm ngay trên giao diện:

Vào trang Tracking Admin.

Tại dòng NEW, ô Khoa/Phòng, gõ tên một khoa mới (ví dụ: Khoa Dinh Dưỡng).

Điền các thông tin khác và nhấn LƯU NHANH.

Kiểm tra Database hoặc thử đăng nhập với:

User: khoa-dinh-duong

Pass: 123456