<?php

namespace App\Imports;

use App\Models\PurchaseRequest;
use App\Models\Department;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PurchaseRequestsImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Assume Row 1 is header
    }

    public function model(array $row)
    {
        // Columns mapping based on user request:
        // 0: STT (Ignored)
        // 1: Khoa/phòng (Department Name) -> Required
        // 2: Nội dung (Content)
        // 3: PR Received Date
        // 4: PR Approved Date
        // 5: Quotation Date
        // 6: PO Created Date
        // 7: PO Approved Date
        // 8: Contract Signed / Goods Received (Contract Date)
        // 9: Status
        // 10: Goods Received Date (Delivery Date)
        // 11: Delivery Note (Ghi chú giao hàng)
        // 12: Reason
        // 13: Dept Note
        
        $deptName = trim($row[1] ?? '');
        if (!$deptName) return null; // Skip if no department name

        // Find or Create Department
        $department = Department::firstOrCreate(
            ['name' => $deptName],
            ['code' => $this->generateInitials($deptName)]
        );

        // Ensure User exists for this department (Logic copied from TrackingController)
        $username = strtolower($department->code);
        if (!User::where('name', $username)->exists()) {
             // Unique check simple
             $original = $username;
             $count = 1;
             while(User::where('name', $username)->exists()) {
                 $username = $original . $count++;
             }

             User::create([
                 'name' => $username,
                 'password' => '123456',
                 'role' => 'department',
                 'department_id' => $department->id
             ]);
        }
        
        // Parse Dates
        $prReceived = $this->transformDate($row[3]);
        $prApproved = $this->transformDate($row[4]);
        $quotation = $this->transformDate($row[5]);
        $poCreated = $this->transformDate($row[6]);
        $poApproved = $this->transformDate($row[7]);
        $contractSigned = $this->transformDate($row[8]);
        
        $status = $row[9] ?? 'Đang xử lý';
        $goodsReceived = $this->transformDate($row[10]);
        $deliveryNote = $row[11] ?? null;
        $reason = $row[12] ?? null;
        $deptNote = $row[13] ?? null;

        // Create PR
        $pr = PurchaseRequest::create([
            'department_id' => $department->id,
            'content' => $row[2] ?? 'Không có nội dung',
            'status' => $status,
            'delivery_note' => $deliveryNote,
            'reason' => $reason,
            'department_note' => $deptNote,
            'is_contract_required' => !empty($contractSigned),
            'created_by' => auth()->id(), // Admin imports it
        ]);

        // Create Timeline
        $pr->timeline()->create([
            'pr_received_date' => $prReceived,
            'pr_approved_date' => $prApproved,
            'quotation_date' => $quotation,
            'po_created_date' => $poCreated,
            'po_approved_date' => $poApproved,
            'contract_signed_date' => $contractSigned,
            'goods_received_date' => $goodsReceived,
        ]);

        return $pr;
    }

    private function transformDate($value)
    {
        if (!$value) return null;
        try {
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            // Try carbon parse for string dates like "20/01/2026"
            return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            // Try standard format if d/m/Y failed
            try {
                return Carbon::parse($value)->format('Y-m-d');
            } catch (\Exception $ex) {
                return null;
            }
        }
    }

    private function generateInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $w) {
            $initials .= mb_substr($w, 0, 1);
        }
        return mb_strtolower($initials, 'UTF-8');
    }
}
