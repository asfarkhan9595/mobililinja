<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('Pa$$w0rd!')
        ]);
    }
}
