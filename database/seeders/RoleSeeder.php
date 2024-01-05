<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'superadmin',
                'display_name' => 'Super Admin', // optional
                'description' => 'Supeadmin is the owner of project', // optional
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin', // optional
                'description' => 'Admin is the manager of project', // optional
            ],
            [
                    'name' => 'customer',
                    'display_name' => 'Customer', // optional
                    'description' => 'Customer is the end-user of project', // optional
            ]
        ];

        foreach ($roles as $role) {
            $role = Role::updateOrCreate(['name' => $role['name']],$role);
        }
    }
}
