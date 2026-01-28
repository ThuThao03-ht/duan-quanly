<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = [
        'department_id',
        'content',
        'status',
        'is_contract_required',
        'created_by',
        'delivery_note',
        'reason',
        'department_note',
        'created_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function timeline()
    {
        return $this->hasOne(PrTimeline::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get progress information for the PR
     */
    public function getProgressInfoAttribute()
    {
        $timeline = $this->timeline;
        if (!$timeline) {
            return ['percent' => 0, 'label' => 'Chờ xử lý', 'color' => 'bg-slate-400', 'steps' => 6];
        }

        // Determine if contract is required either by flag or by filled date
        $isContract = $this->is_contract_required || !empty($timeline->contract_signed_date);
        $totalSteps = $isContract ? 7 : 6;
        
        $steps = [
            'pr_received_date', 
            'pr_approved_date', 
            'quotation_date', 
            'po_created_date', 
            'po_approved_date', 
            'goods_received_date'
        ];
        
        if ($isContract) {
            // Insert contract step before goods received
            array_splice($steps, 5, 0, 'contract_signed_date');
        }
        
        $completedCount = 0;
        foreach ($steps as $step) {
            if (!empty($timeline->$step)) {
                $completedCount++;
            }
        }

        if ($this->status == 'Hoàn thành' || $completedCount == $totalSteps) {
            return ['percent' => 100, 'label' => 'Hoàn thành', 'color' => 'bg-green-500', 'steps' => $totalSteps];
        }

        $percent = round(($completedCount / $totalSteps) * 100);
        
        // Label logic based on user examples and image
        $label = 'Đang xử lý';
        if ($completedCount == 0) {
            $label = 'Chờ xử lý';
        } elseif ($this->status == 'Đang xử lý') {
            // Determine Label
            if ($completedCount === 1) $label = 'Đã nhận PR';
            else if ($completedCount === 2) $label = 'Đang chờ báo giá';
            else if ($completedCount === 3) $label = $isContract ? 'Đang xử lý – chờ PO' : 'Đang làm PO';
            else if ($completedCount === 4) $label = 'Đang ở bước PO';
            else if ($completedCount === 5) $label = 'Đã duyệt PO';
            else if ($isContract && $completedCount === 6) $label = 'Đã ký HĐ';
        }

        $color = $percent < 40 ? 'bg-amber-400' : ($percent < 80 ? 'bg-blue-500' : 'bg-green-500');
        
        return [
            'percent' => $percent,
            'label' => $label,
            'color' => $color,
            'steps' => $totalSteps
        ];
    }
}
