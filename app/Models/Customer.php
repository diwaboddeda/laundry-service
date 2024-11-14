<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';  // You can keep this as is or change it to 'customers' if needed
    protected $fillable = ['user_id', 'phone', 'address'];  // 'hp' -> 'phone', 'alamat' -> 'address'

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
