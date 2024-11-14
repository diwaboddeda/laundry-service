<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';  // You can keep this as is or change it to 'product_details' if needed
    protected $fillable = ['name', 'item_id'];  // 'nama' -> 'name', 'barang_id' -> 'product_id'

    public function product()
    {
        return $this->belongsTo(Product::class);  // Changed 'barang' to 'product'
    }
}
