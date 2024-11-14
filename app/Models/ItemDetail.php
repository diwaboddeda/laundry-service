<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;

    protected $table = 'item_details'; // Ensure this matches your table name
    protected $fillable = ['item_id', 'name']; // Add columns that can be mass-assigned

    // If there's a relationship with Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
