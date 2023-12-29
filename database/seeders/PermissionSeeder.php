<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'create-customer',
                'display_name' => 'Create Customer/Company', // optional
                'description' => 'create new Customer/Company', // optional
            ],
            [
                'name' => 'edit-customer',
                'display_name' => 'Edit Customer', // optional
                'description' => 'edit existing Customer/Company', // optional
            ],
            [
                'name' => 'delete-customer',
                'display_name' => 'Delete Customer/Company', // optional
                'description' => 'delete new Customer/Company', // optional
            ],
            [
                'name' => 'list-customer',
                'display_name' => 'List Customer', // optional
                'description' => 'List the Customers/Companies', // optional
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']],$permission);
        }
    }
}
