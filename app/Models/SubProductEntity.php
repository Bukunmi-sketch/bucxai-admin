<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProductEntity extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(ProductEntity::class, 'product_entity_id');
    }

      public function transactions()
      {
          return $this->hasMany(Transaction::class, 'sub_prod_id');
      }
}
