<?php

namespace Database\Seeders;

use App\Models\User;
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

        // Define permissions
        $permissions = [
            // Team permissions
            'team.view_any',
            'team.view',
            'team.create',
            'team.update',
            'team.delete',
            'team.manage_members',
            'team.manage_settings',
            
            // Member permissions
            'member.invite',
            'member.remove',
            'member.update_role',
            
            // Content permissions
            'post.create',
            'post.update',
            'post.delete',
            'post.view',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create global roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'User', 'guard_name' => 'web']);

        // Define team roles and their permissions
        $teamRoles = [
            'owner' => [
                'team.view',
                'team.update',
                'team.delete',
                'team.manage_members',
                'team.manage_settings',
                'member.invite',
                'member.remove',
                'member.update_role',
                'post.create',
                'post.update',
                'post.delete',
                'post.view',
            ],
            'manager' => [
                'team.view',
                'team.update',
                'team.manage_members',
                'member.invite',
                'member.remove',
                'post.create',
                'post.update',
                'post.delete',
                'post.view',
            ],
            'player' => [
                'team.view',
                'post.create',
                'post.update',
                'post.view',
            ],
            'viewer' => [
                'team.view',
                'post.view',
            ],
        ];

        // Assign all permissions to admin
        $adminRole->givePermissionTo(Permission::all());

        // Assign basic permissions to user role
        $userRole->givePermissionTo([
            'team.view_any',
            'team.create',
            'post.view',
        ]);

        // Create team roles
        foreach ($teamRoles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
            $role->syncPermissions($permissions);
        }

        // Assign admin role to the default admin user
        $admin = User::where('email', 'atikahsubari@gmail.com')->first();
        if ($admin) {
            $admin->assignRole('Admin');
        }
    }
}
