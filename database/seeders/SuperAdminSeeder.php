<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Superadmin::create([
            'name'=>'Superadmin',
            'email'=>'admin@superadmin.com',
            'password'=>Hash::make('Pa$$w0rd!')
        ]);
    }
}
