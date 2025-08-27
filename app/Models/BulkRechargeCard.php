<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkRechargeCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reference',
        'business_name',
        'network',
        'amount',
        'quantity',
    ];

    public function rechargeBulkPins()
    {
        return $this->hasMany(RechargeBulkPin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
