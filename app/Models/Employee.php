<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';  // You can keep this as is or change it to 'employees' if needed
    protected $fillable = ['user_id', 'phone', 'address'];  // 'hp' -> 'phone', 'alamat' -> 'address'

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
