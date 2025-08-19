<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create global roles
        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'User', 'guard_name' => 'web']);

        // Create permissions (example permissions - adjust as needed)
        $permissions = [
            'manage_users',
            'manage_teams',
            'manage_team_settings',
            'invite_team_members',
            'remove_team_members',
            'edit_team',
            'delete_team',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assign all permissions to admin
        $adminRole->givePermissionTo(Permission::all());

        // Assign basic permissions to user role
        $userRole->givePermissionTo([
            'edit_team',
        ]);
    }
}
