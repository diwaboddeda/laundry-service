<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model  // Changed model name from Barang to Product
{
    use HasFactory;

    protected $table = 'products';  // Changed table name from barang to products
    protected $fillable = ['user_id', 'weight'];  // Changed field 'berat' to 'weight'

    public function user()  // No change in relationship name
    {
        return $this->belongsTo(User::class);
    }

    public function productDetails()  // Changed relationship name from detail_barang to productDetails
    {
        return $this->hasMany(ProductDetail::class);  // Changed model name from DetailBarang to ProductDetail
    }

    public function transaction()  // Changed relationship name from transaksi to transaction
    {
        return $this->hasOne(Transaction::class);  // Changed model name from Transaksi to Transaction
    }
}
