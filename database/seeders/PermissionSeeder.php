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
            // User Management
            ['name' => 'view_users', 'label' => 'View Users'],
            ['name' => 'create_users', 'label' => 'Create Users'],
            ['name' => 'edit_users', 'label' => 'Edit Users'],
            ['name' => 'delete_users', 'label' => 'Delete Users'],

            // Role Management
            ['name' => 'view_roles', 'label' => 'View Roles'],
            ['name' => 'create_roles', 'label' => 'Create Roles'],
            ['name' => 'edit_roles', 'label' => 'Edit Roles'],
            ['name' => 'delete_roles', 'label' => 'Delete Roles'],

            // Permission Management
            ['name' => 'view_permissions', 'label' => 'View Permissions'],

            // General
            ['name' => 'access_dashboard', 'label' => 'Access Dashboard'],
            ['name' => 'manage_settings', 'label' => 'Manage Settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                ['label' => $permission['label']]
            );
        }
    }
}
