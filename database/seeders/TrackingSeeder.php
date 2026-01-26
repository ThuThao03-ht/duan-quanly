<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Department;
use App\Models\PurchaseRequest;
use App\Models\PrTimeline;
use App\Models\User;

class TrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to truncate tables
        \Schema::disableForeignKeyConstraints();
        \App\Models\PrTimeline::truncate();
        \App\Models\PurchaseRequest::truncate();
        \App\Models\Department::truncate();
        \Schema::enableForeignKeyConstraints();

        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'admin',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]);
        }

        $data = [
            [55, 'PT-GMHS', 'Máy sưởi ấm bệnh nhân', '2026-01-20', '2026-01-24', null, null, null, null, 'Đang xử lý', null, null, null, null],
            [54, 'PT-GMHS', 'Nồi hấp nhiệt độ thấp', '2026-01-15', '2026-01-24', null, null, null, null, 'Đang xử lý', null, null, 'đang đợi Cấu hình', null],
            [53, 'ME-CSHT', 'Rèm trong suốt, cây treo màn, bát treo màn, đầu chụp cây treo màn, take 3cm', '2026-01-19', '2026-01-24', null, null, null, null, 'Đang xử lý', null, null, 'Đang tìm báo giá', null],
            [52, 'TTBYT', 'Bộ lưu lượng kế và bình làm ẩm loại gắn bình oxy', '2026-01-15', '2026-01-24', null, null, null, null, 'Đang xử lý', null, null, 'Đang tìm báo giá', null],
            [51, 'PT-GMHS', 'Đồ phẫu thuật viên', null, '2026-01-23', '2026-01-23', null, null, null, 'Đang xử lý', null, null, 'Đang ký po', null],
            [50, 'KD-CSKH', 'CLB Tim Mạch', '2026-01-14', '2026-01-20', '2026-01-22', '2026-01-22', null, null, 'Hoàn thành', null, null, null, null],
            [49, 'Xét nghiệm', 'Gia hạn hợp đồng đặt máy đông máu tự động', '2026-01-21', null, null, null, null, null, 'Đang xử lý', null, null, 'Đang ký pr', null],
            [48, 'Khoa nhi', 'Cân Đồng hồ', '2026-01-21', null, null, null, null, null, 'Đang xử lý', null, null, 'Đang ký pr', null],
            [47, 'Khoa nhi', 'Sữa chữa bơm tiêm điện', '2026-01-21', null, null, null, null, null, 'Đang xử lý', null, null, 'Đang ký pr', null],
            [46, 'CNTT', 'Điện Thoại Hornor X7d 8GB/256GB', '2026-01-20', '2026-01-20', '2026-01-21', '2026-01-21', null, null, 'Hoàn thành', null, null, 'Đang ký PO', null],
            [45, 'CNTT', 'Sim điện thoại (đuôi 115)', '2026-01-20', '2026-01-20', '2026-01-21', '2026-01-21', null, null, 'Đang xử lý', null, null, 'Đang ký PO', null],
            [44, 'Khoa Xét nghiệm', 'Mua máy li tâm', '2026-01-21', null, null, null, null, null, 'Đang xử lý', null, null, 'Đang trình ký pr', null],
            [43, 'CNTT', 'Bộ chuyển dây 1FO (Dây quang học chặc) sang rj45', '2026-01-19', null, '2026-01-21', '2026-01-21', null, null, 'Đang xử lý', null, null, 'Đang trình kí pr, PO', null],
            [42, 'ME-CSHT', 'Dây cadivid (1.5mm, 2.5mm), ống xoắn phi 20 nano, nẹp điện 2cm, ximili cách nhiệt ống đồng, băng keo điện nano, take nhựa 3cm, máy bơm xã thoát nước máy lạnh', '2026-01-20', null, '2026-01-22', '2026-01-22', '2026-01-23', null, 'Hoàn thành', '2026-01-23', 'nhận hàng ngày 23/01/2026', null, null],
            [41, 'Phòng TCKT', 'Gia hạn gói Enterprise 01 năm, gia hạn 01 người dùng gói', '2026-01-19', '2026-01-19', '2026-01-19', '2026-01-19', '2026-01-19', null, 'Hoàn thành', '2026-01-22', null, null, null],
            [40, 'ME-CSHT', 'Mua vật tư treo màng hội trường tầng 5 (rèm trong suốt, cây treo màng, bát treo, đầu chụp cây, take)', '2026-01-19', null, null, null, null, null, 'Đang xử lý', null, null, 'đang trình ký pr', null],
            [39, 'Nhân sự', 'Thanh toán chi phí chuyển giao kỹ thuật với Bệnh viện Thống Nhất theo bản thanh lý hợp đồng số 10/TLHĐ', '2026-01-19', '2026-01-19', '2026-01-19', '2026-01-19', '2026-01-20', null, 'Hoàn thành', '2026-01-20', null, null, null],
            [38, 'Khoa PTGMHS', 'Dây đo SPO2 máy monitor', '2026-01-09', '2026-01-19', null, null, null, null, 'Đang xử lý', null, null, 'đang lấy báo giá', null],
            [37, 'Khoa KSNK', 'Điện trở nồi hấp tiệc trùng', '2026-01-09', '2026-01-19', '2026-01-20', '2026-01-20', null, null, 'Đang xử lý', null, null, 'đang trình ký po', null],
            [36, 'Khoa KSNK', 'Nồi hấp tiệc trùng', '2026-01-14', '2026-01-19', null, null, null, null, 'Đang xử lý', null, null, 'đang đợi duyệt cấu hình từ bp TTB', null],
            [35, 'Phòng mổ', 'Nhíp đốt pipolar', '2026-01-10', '2026-01-15', '2026-01-19', '2026-01-19', '2026-01-19', null, 'Hoàn thành', null, 'đã đặt hàng', null, null],
            [34, 'KD-CSKH', 'Bàn cắt giấy', '2026-01-10', '2026-01-17', '2026-01-19', '2026-01-19', null, null, 'Hoàn thành', null, 'HT', null, null],
            [33, 'KD-CSKH', 'Standee CLB Tim mạch, CLB đái tháo đường', '2026-01-07', '2026-01-17', '2026-01-19', '2026-01-19', null, null, 'Đang xử lý', null, 'đang trình ký po', null, null],
            [32, 'HCNS', 'Hộp đựng giấy vệ sinh cuộn lớn', '2026-12-12', '2025-12-18', '2026-01-06', '2026-01-19', null, null, 'Đang xử lý', null, 'đang trình ký po', null, null],
            [31, 'ME-CSHT', 'Bộ đồ nghề cho bộ phận ME-CSHT', '2026-01-14', '2026-01-15', '2026-01-17', '2026-01-17', null, null, 'Đang xử lý', null, 'đang trình ký po', null, null],
            [30, 'Khoa khám bệnh', 'Giấy khám sức khỏe người lớn TT32', '2026-01-19', '2026-01-24', null, null, null, null, 'Đang xử lý', null, null, 'đang xin báo giá', null],
            [29, 'Khoa khám bệnh', 'sổ khám sức khỏe theo thông tư 32', '2026-01-19', '2026-01-24', null, null, null, null, 'Đang xử lý', null, null, 'đang xin báo giá', null],
            [28, 'KD-CSKH', 'sổ khám sức khỏe theo thông tư 32', '2026-01-19', '2026-01-24', null, null, null, null, 'Đang xử lý', null, null, 'đang xin báo giá', null],
            [27, 'HCNS', 'Chi phí tham dự tất niên 2025 tại BV ĐK Tâm Trí Nha Trang', '2026-01-15', '2026-01-24', null, null, null, null, 'Hoàn thành', null, 'đã đặt vé', null, null],
            [26, 'ME-CSHT', 'Gia hạn HĐ bảo trì thang máy T11A008, T11A009, T11A010, T11A011', '2026-01-15', '2026-01-19', null, null, '2026-01-14', null, 'Hoàn thành', null, 'đã ký hợp đồng', null, null],
            [25, 'KD-CSKH', 'USB Thiên thần nhỏ', '2026-01-15', '2026-01-19', null, null, null, null, 'Đang xử lý', null, 'đang trình ký po', null, null],
            [24, 'HCNS', 'Chi phí tham dự hội thảo chuyên môn Trường ĐH Phan Châu Trinh', '2026-01-15', '2026-01-19', null, null, null, null, 'Đang xử lý', null, null, null, null],
            [23, 'IT', 'Mua linh kiện và mực bơm cho tháng 1/2026', '2026-01-19', '2026-01-21', '2026-01-22', '2026-01-22', null, null, 'Đang xử lý', null, 'đang trình ký po', null, null],
            [22, 'ME-CSHT', 'Thi công cải tạo hội trường tầng 5', '2026-01-09', '2026-01-09', '2026-01-13', '2026-01-13', null, null, 'Đang xử lý', null, 'đã làm po đang đi trình ki', null, null],
            [21, 'Khoa Khám bệnh', 'Giấy KSK người lớn', '2025-09-10', '2025-09-15', '2025-09-15', '2025-09-17', '2025-09-20', null, 'Hoàn thành', '2026-01-05', null, null, null],
            [20, 'Khoa Cấp cứu', 'Cửa xếp lá nhôm kho tạm của cấp cứu và phòng rửa dạ dày', '2025-10-30', '2025-12-31', '2025-12-29', '2025-12-29', '2025-12-31', null, 'Hoàn thành', '2026-01-06', null, null, null],
            [19, 'ME-CSHT', 'Sửa tuyến ống cấp nước và sửa chữa máy bơm nước sinh hoạt', '2026-01-03', '2026-01-08', '2026-01-05', '2026-01-09', '2026-01-09', null, 'Hoàn thành', '2026-01-08', null, null, null],
            [18, 'Khoa dược', 'may 300 túi vãi', '2025-12-12', '2025-12-13', '2025-12-18', '2025-12-23', '2025-12-23', '2026-01-05', 'Hoàn thành', '2026-01-25', 'Ngày 25/01/2026 có hàng', null, null],
            [17, 'Khoa dược', 'may 50 túi vãi', '2025-12-29', '2025-12-31', '2026-01-03', '2026-01-06', null, null, 'Đang xử lý', null, 'đang đặt hàng', null, null],
            [16, 'Khoa Xét nghiệm', 'Chương trình ngoại kiểm huyết học, sinh hóa, đông máu 2026', '2025-12-26', '2025-12-30', '2025-12-30', '2025-12-30', '2025-12-31', null, 'Đang xử lý', null, 'đang đợi hđ gửi về', null, null],
            [15, 'kinh doanh', 'túi giấy trung, lớn, bìa trình ký', '2025-12-30', '2026-01-02', '2026-01-12', '2026-01-13', '2026-01-20', null, 'Đang xử lý', null, 'đã đặt hàng', null, null],
            [14, 'kinh doanh', 'Decal dán thang máy tầng 4, 5', '2025-12-30', '2026-01-02', null, null, null, null, 'Đang xử lý', null, 'đang thiết kế', null, null],
            [13, 'ME-CSHT', 'thi công cải tạo hạ tầng khối nhà thẩm mỹ (dời căn tin)', '2025-11-19', '2025-11-20', '2025-12-29', '2025-12-29', '2025-12-29', '2026-01-03', 'Hoàn thành', null, 'đang nghiệm thu', null, null],
            [12, 'Khoa Xét nghiệm', 'sửa máy elisa', '2025-12-05', '2025-12-06', '2025-12-12', '2025-12-12', '2025-12-15', null, 'Đang xử lý', null, 'đã sửa xong mang về nghiệm thu ko đạt nên đã trả sửa lại', null, null],
            [11, 'Khoa Xét nghiệm', 'sửa máy li tâm', '2025-09-13', '2025-09-26', '2024-12-04', '2024-12-04', '2024-12-06', null, 'Đang xử lý', null, 'đã sửa xong mang về nghiệm thu ko đạt nên đã trả sửa lại', null, null],
            [10, 'TTBYT', 'kiểm định phòng X Quang cao tần', '2025-12-08', '2025-12-15', '2025-12-16', '2025-12-16', '2025-12-16', null, 'Hoàn thành', null, 'công ty đã kiểm định', null, null],
            [9, 'HCNS', 'đồng phục điều dưỡng', '2025-09-20', '2025-09-22', '2025-11-20', '2025-11-08', '2025-11-10', null, 'Hoàn thành', null, 'đang đợi gửi hàng', null, null],
            [8, 'ME-CSHT', 'thi công cải tạo lầu 5', '2025-12-18', '2025-12-18', null, null, null, null, 'Hoàn thành', null, 'Tập đoàn trả hs do qua năm 2025', null, null],
            [7, 'kinh doanh', 'nước suối, bánh, nón CLB tim mạch 23/1/2026', '2025-11-24', '2025-11-26', null, null, null, null, 'Hoàn thành', null, 'đã đặt hàng', null, null],
            [6, 'HCNS', 'Ký hđ rác thải y tế 2026', '2025-12-22', '2025-12-23', '2025-12-30', null, '2025-12-01', null, 'Hoàn thành', '2025-12-01', null, null, null],
            [5, 'HCNS', 'Ký hđ rác thải rắn 2026', '2025-12-22', '2025-12-23', null, null, null, null, 'Hoàn thành', null, 'đã ký hợp đồng', null, null],
            [4, 'HCNS', 'ký hđ quan trắc mơi trường năm 2026', '2025-12-22', '2025-12-23', null, null, '2026-01-01', null, 'Hoàn thành', '2026-01-01', null, null, null],
            [3, 'Khoa PT GMHS', 'hệ thống phẩu thuật nội soi', '2025-07-08', '2025-07-08', '2025-12-10', '2025-12-22', '2026-01-06', null, 'Hoàn thành', null, 'đã ký hợp đồng', null, null],
            [2, 'Phòng Nội soi', 'van bơm rửa ống nội soi', '2025-11-14', '2025-12-19', '2025-12-19', '2025-12-19', '2025-12-20', '2026-01-02', 'Hoàn thành', '2026-01-05', null, null, null],
            [1, 'HTDV', 'Gia hạn camera cấp cứu', null, '2026-01-14', null, '2026-01-14', null, null, 'Hoàn thành', null, null, null, null],
        ];

        foreach ($data as $item) {
            $deptName = $item[1];
            // Normalize department names
            $dept = Department::firstOrCreate(['name' => $deptName], ['code' => strtoupper($deptName)]);

            $pr = PurchaseRequest::create([
                'id' => $item[0],
                'department_id' => $dept->id,
                'content' => $item[2],
                'status' => $item[9] ?? 'Đang xử lý',
                'created_by' => $admin->id,
                'delivery_note' => $item[11],
                'reason' => $item[12],
                'department_note' => $item[13],
            ]);

            PrTimeline::create([
                'purchase_request_id' => $pr->id,
                'pr_received_date' => $item[3],
                'pr_approved_date' => $item[4],
                'quotation_date' => $item[5],
                'po_created_date' => $item[6],
                'po_approved_date' => $item[7],
                'contract_signed_date' => $item[8],
                'goods_received_date' => $item[10],
            ]);
        }
    }
}
