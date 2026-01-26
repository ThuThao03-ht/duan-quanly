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
}
