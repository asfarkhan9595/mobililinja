<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Customer Permissions
            [
                'name' => 'create-customer',
                'display_name' => 'Create Customer/Company',
                'description' => 'Create new Customer/Company',
            ],
            [
                'name' => 'edit-customer',
                'display_name' => 'Edit Customer',
                'description' => 'Edit existing Customer/Company',
            ],
            [
                'name' => 'delete-customer',
                'display_name' => 'Delete Customer/Company',
                'description' => 'Delete Customer/Company',
            ],
            [
                'name' => 'list-customer',
                'display_name' => 'List Customer',
                'description' => 'List the Customers/Companies',
            ],
            // PSTN Permission
            [
                'name' => 'create-pstn',
                'display_name' => 'Create PSTN', // optional
                'description' => 'create new PSTN', // optional
            ],
            [
                'name' => 'edit-pstn',
                'display_name' => 'Edit PSTN', // optional
                'description' => 'edit existing PSTN', // optional
            ],
            [
                'name' => 'delete-pstn',
                'display_name' => 'Delete PSTN', // optional
                'description' => 'delete new PSTN', // optional
            ],
            [
                'name' => 'list-pstn',
                'display_name' => 'List PSTN', // optional
                'description' => 'List the PSTN', // optional
            ],

            // Trunk Permissions
            [
                'name' => 'create-trunk',
                'display_name' => 'Create Trunk',
                'description' => 'Create new Trunk',
            ],
            [
                'name' => 'edit-trunk',
                'display_name' => 'Edit Trunk',
                'description' => 'Edit existing Trunk',
            ],
            [
                'name' => 'delete-trunk',
                'display_name' => 'Delete Trunk',
                'description' => 'Delete Trunk',
            ],
            [
                'name' => 'list-trunk',
                'display_name' => 'List Trunk',
                'description' => 'List the Trunks',
            ],
            // Invoice Permissions
            [
                'name' => 'create-invoice',
                'display_name' => 'Create Invoice',
                'description' => 'Create new Invoice',
            ],
            [
                'name' => 'edit-invoice',
                'display_name' => 'Edit Invoice',
                'description' => 'Edit existing Invoice',
            ],
            [
                'name' => 'delete-invoice',
                'display_name' => 'Delete Invoice',
                'description' => 'Delete Invoice',
            ],
            [
                'name' => 'list-invoice',
                'display_name' => 'List Invoices',
                'description' => 'List the Invoices',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
