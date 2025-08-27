<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];


    public function subProduct()
    {
        return $this->belongsTo(SubProductEntity::class, 'sub_prod_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
