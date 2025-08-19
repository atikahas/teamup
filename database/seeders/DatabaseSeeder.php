<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RoleAndPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles and permissions
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);

        // Create or update the main admin user
        $admin = User::updateOrCreate(
            ['email' => 'atikahsubari@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        
        // Sync roles (this will remove any existing roles and add only Admin)
        $admin->syncRoles(['Admin']);

        // Create a test regular user (optional)
        if (!User::where('email', 'user@example.com')->exists()) {
            $user = User::factory()->create([
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('User');
        }
    }
}
