<?php

namespace Database\Seeders;

use App\Models\Product; // Renamed Barang to Product
use App\Models\ProductDetail; // Renamed DetailBarang to ProductDetail
use App\Models\Customer; // Renamed Konsumen to Customer
use App\Models\Service; // Renamed Layanan to Service
use App\Models\Transaction; // Renamed Transaksi to Transaction
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = Service::find(2); // Renamed Layanan to Service

        // Creating a new user
        $user = User::create([
            'name' => 'bunga',
            'email' => 'bunga@gmail.com',
            'password' => bcrypt('123123123'),
            'role_id' => 3 // Assuming 'role_id' for customer
        ]);

        // Creating a customer related to the user
        Customer::create([
            'user_id' => $user->id,
            'phone' => '1123456963', // 'hp' refers to phone number
            'address' => 'jl seroja no 9' // Renamed alamat to address
        ]);

        // Creating a product related to the user
        $product = Product::create([ // Renamed Barang to Product
            'user_id' => $user->id,
            'weight' => 2 // Renamed berat to weight
        ]);

        // Creating product details
        ProductDetail::create([ // Renamed DetailBarang to ProductDetail
            'product_id' => $product->id, // Renamed barang_id to product_id
            'name' => 'uniform' // Renamed nama to name
        ]);

        ProductDetail::create([ // Renamed DetailBarang to ProductDetail
            'product_id' => $product->id, // Renamed barang_id to product_id
            'name' => 'black trousers' // Renamed nama to name
        ]);

        // Creating a transaction for the product and service
        Transaction::create([ // Renamed Transaksi to Transaction
            'service_id' => $service->id, // Renamed layanan_id to service_id
            'item_id' => $item->id, // Renamed barang_id to product_id
            'status' => 0, // Assuming '0' represents a status (e.g., pending)
            'total_payment' => $product->weight * $service->price, // Assuming harga is price
            'received_date' => now(), // Renamed tanggal_diterima to received_date
            'pickup_date' => now()->addHours($service->duration) // Renamed tanggal_diambil to pickup_date
        ]);
    }
}
