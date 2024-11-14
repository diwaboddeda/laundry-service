<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = ['name'];  // 'nama' -> 'name'

    public function user()
    {
        return $this->hasOne(User::class);  // You can keep this as 'user' if referring to a relationship with the 'User' model
    }
}
