<?php

namespace App\Exports;

use App\Models\PurchaseRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PurchaseRequestsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithCustomStartCell, WithEvents, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = PurchaseRequest::with(['department', 'timeline']);

        if (!empty($this->filters['status']) && $this->filters['status'] !== 'all') {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['month']) && $this->filters['month'] !== 'all') {
            $query->whereHas('timeline', function($q) {
                $q->whereMonth('pr_received_date', $this->filters['month']);
            });
        }

        if (!empty($this->filters['year']) && $this->filters['year'] !== 'all') {
            $query->whereHas('timeline', function($q) {
                $q->whereYear('pr_received_date', $this->filters['year']);
            });
        }

        return $query->orderBy('id', 'desc')->get();
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function headings(): array
    {
        return [
            'STT',
            'Khoa/Phòng',
            'Nội dung mua sắm',
            'Nhận PR',
            'Duyệt PR',
            'Ngày báo giá',
            'Ngày làm PO',
            'Duyệt PO',
            'Kí HĐ',
            'Tiến độ',
            'Trạng thái',
            'Ngày giao hàng',
            'Ghi chú (Giao hàng)',
            'Lý do',
            'Ghi chú Khoa/Phòng'
        ];
    }

    public function map($request): array
    {
        $t = $request->timeline;
        $prog = $request->progress_info;

        return [
            $request->id,
            $request->department->name ?? 'N/A',
            $request->content,
            $t && $t->pr_received_date ? date('d/m/Y', strtotime($t->pr_received_date)) : '',
            $t && $t->pr_approved_date ? date('d/m/Y', strtotime($t->pr_approved_date)) : '',
            $t && $t->quotation_date ? date('d/m/Y', strtotime($t->quotation_date)) : '',
            $t && $t->po_created_date ? date('d/m/Y', strtotime($t->po_created_date)) : '',
            $t && $t->po_approved_date ? date('d/m/Y', strtotime($t->po_approved_date)) : '',
            $t && $t->contract_signed_date ? date('d/m/Y', strtotime($t->contract_signed_date)) : '',
            $prog['percent'] . '% - ' . $prog['label'],
            $request->status,
            $t && $t->goods_received_date ? date('d/m/Y', strtotime($t->goods_received_date)) : '',
            $request->delivery_note,
            $request->reason,
            $request->department_note
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the header row (row 7 because we start at A7)
            7 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1e40af']
                ],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                
                // 1. Company Information
                $sheet->mergeCells('A1:C1');
                $sheet->setCellValue('A1', 'BỆNH VIỆN ĐA KHOA TÂM TRÍ CAO LÃNH');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
                
                // 2. Report Title
                $sheet->mergeCells('A3:O3');
                $sheet->setCellValue('A3', 'BÁO CÁO CHI TIẾT THEO DÕI MUA HÀNG (PR)');
                $style = $sheet->getStyle('A3');
                $style->getFont()->setBold(true)->setSize(16)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('1e40af'));
                $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // 3. Filter info
                $monthStr = $this->filters['month'] !== 'all' ? 'Tháng ' . $this->filters['month'] : 'Tất cả tháng';
                $yearStr = $this->filters['year'] !== 'all' ? 'Năm ' . $this->filters['year'] : 'Tất cả năm';
                $sheet->mergeCells('A4:O4');
                $sheet->setCellValue('A4', "Dữ liệu xuất theo: $monthStr / $yearStr | Trạng thái: " . ($this->filters['status'] === 'all' ? 'Tất cả' : $this->filters['status']));
                $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // 4. Export Time (Under filters)
                $sheet->mergeCells('A5:O5');
                $sheet->setCellValue('A5', 'Ngày giờ xuất báo cáo: ' . date('d/m/Y H:i'));
                $sheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A5')->getFont()->setItalic(true)->setSize(10);

                // 5. Data Borders
                $lastRow = $sheet->getHighestRow();
                $lastCol = 'O';
                $sheet->getStyle("A7:$lastCol$lastRow")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                
                // 6. Signature Area
                $signatureRow = $lastRow + 2;
                $sheet->mergeCells("M$signatureRow:O$signatureRow");
                $sheet->setCellValue("M$signatureRow", 'Người xuất báo cáo: ' . (auth()->user()->name ?? 'Administrator'));
                $sheet->getStyle("M$signatureRow")->getFont()->setBold(true);
                $sheet->getStyle("M$signatureRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

                // Auto row height for content
                for ($i = 8; $i <= $lastRow; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(-1);
                }
            },
        ];
    }
}
