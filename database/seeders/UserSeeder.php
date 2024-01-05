<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate([
            'name'=>'Super Admin',
            'email'=>'admin@superadmin.com',
            'password'=>Hash::make('Pa$$w0rd!')
        ]);
        $user->addRole('superadmin');

        $user = User::updateOrCreate([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('Pa$$w0rd!')
        ]);
        $user->addRole('admin');

        $user = User::updateOrCreate([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'password' => Hash::make('Pa$$w0rd!')
        ]);
        $user->addRole('customer');
    }
}
