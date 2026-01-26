<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrTimeline extends Model
{
    protected $fillable = [
        'purchase_request_id',
        'pr_received_date',
        'pr_approved_date',
        'quotation_date',
        'po_created_date',
        'po_approved_date',
        'contract_signed_date',
        'goods_received_date',
    ];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }
}
