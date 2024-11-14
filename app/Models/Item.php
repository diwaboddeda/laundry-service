<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'duration', 'weight', // Add weight here
        'user_id',  // Ensure 'user_id' is fillable if you have it in your table
    ];

    /**
     * Define the relationship with the User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);  // Assumes 'user_id' is the foreign key in 'items' table
    }
}
