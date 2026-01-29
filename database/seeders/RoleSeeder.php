<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin Role
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin'],
            ['label' => 'Super Administrator']
        );

        // Assign all permissions to Super Admin
        $allPermissions = Permission::all();
        $superAdminRole->permissions()->sync($allPermissions);

        // Create User Role
        $userRole = Role::firstOrCreate(
            ['name' => 'user'],
            ['label' => 'Regular User']
        );

        // Assign specific permissions to User (optional, just for example)
        $userPermissions = Permission::whereIn('name', [
            'access_dashboard',
        ])->get();
        $userRole->permissions()->sync($userPermissions);
    }
}
