<?php

namespace Database\Seeders;

use App\Models\Employee; // Renaming Karyawan to Employee
use App\Models\Role;
use App\Models\User;
use App\Models\Customer; // Renaming Konsumen to Customer
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        $role = Role::create([
            'name' => 'admin' // Renamed 'nama' to 'name'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'role_id' => $role->id
        ]);

        // employee
        $role = Role::create([
            'name' => 'employee' // Renamed 'karyawan' to 'employee'
        ]);

        $user = User::create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('123123123'),
            'role_id' => $role->id
        ]);
        
        Employee::create([
            'user_id' => $user->id,
            'hp' => '085123456789',
            'address' => 'jl. gajah' // Renamed 'alamat' to 'address'
        ]);

        // customer
        $role = Role::create([
            'name' => 'customer' // Renamed 'konsumen' to 'customer'
        ]);
    }
}
