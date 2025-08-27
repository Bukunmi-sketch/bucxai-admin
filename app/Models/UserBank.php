<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    use HasFactory;

    protected $table = 'user_banks'; // Ensure the correct table name
    protected $fillable = ['user_id', 'bank_name', 'account_name', 'account_number'];

    public function userBanks()
{
    return $this->hasMany(UserBank::class, 'user_id');
}

}
