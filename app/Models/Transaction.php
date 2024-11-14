<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model  // Changed class name from Transaksi to Transaction
{
    use HasFactory;

    protected $table = 'transactions'; // Table name remains the same, unless you change it in your database
    protected $fillable = [
        'service_id',  // 'layanan_id' -> 'service_id'
        'item_id',     // 'barang_id' -> 'item_id'
        'total_payment', // 'total_bayar' -> 'total_payment'
        'status',
        'received_date', // 'tanggal_diterima' -> 'received_date'
        'pickup_date'    // 'tanggal_diambil' -> 'pickup_date'
    ];

    public function service()  // 'layanan' -> 'service'
    {
        return $this->belongsTo(Service::class);  // Assuming 'Layanan' becomes 'Service'
    }

    public function item()  // 'barang' -> 'item'
    {
        return $this->belongsTo(Item::class);  // Assuming 'Barang' becomes 'Item'
    }
}
