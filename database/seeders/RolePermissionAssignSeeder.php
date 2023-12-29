<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::whereName('superadmin')->first();
        $admin->syncPermissions(['create-customer','edit-customer','delete-customer','list-customer']);

        $superadmin = Role::whereName('admin')->first();
        $superadmin->syncPermissions(['create-customer','edit-customer','delete-customer','list-customer']);
    }
}
