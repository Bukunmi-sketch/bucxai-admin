<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEntity extends Model
{
    use HasFactory;

     // Add the attributes you want to allow for mass assignment
     protected $fillable = [
        'id',
        'product_name',
        'product_icon',
        'product_description',
        'type',
        'service_id',
        'network',
        'instruct_1',
        'instruct_2',
        'max_amount',
        'min_amount',
        'user_percentage',
        'reseller_percentage',
        'phone',
        'per_charges',
        'auto_prod_id',
        'auto_type',
        'status',
    ];

    public function subProducts()
    {
        return $this->hasMany(SubProductEntity::class, 'product_entity_id');
    }

}
