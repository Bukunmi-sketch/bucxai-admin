<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeBulkPin extends Model
{
    use HasFactory;


    protected $fillable = [
        'bulk_recharge_card_id',
        'reference',
        'pin',
        'serial_number',
        'amount',
        'instruction',
    ];

    public function bulkRechargeCard()
    {
        return $this->belongsTo(BulkRechargeCard::class);
    }
}
