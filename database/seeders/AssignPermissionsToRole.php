<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignPermissionsToRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_permissions = Permission::get();
        if ($all_permissions) {

            $super_admin = Role::whereName('superadmin')->first();
            if ($super_admin) {
                $super_admin->syncPermissions($all_permissions);
            }
            // Assign Permission To Admin Role
            //TO DO : For now adding customer related permission. Will be updated
            $admin = Role::whereName('admin')->first();
            if ($admin) {
                $admin->syncPermissions($all_permissions);
            }

            $customer = Role::whereName('customer')->first();
            if ($customer) {
                $customer->syncPermissions($all_permissions);
            }
        }
    }
}
