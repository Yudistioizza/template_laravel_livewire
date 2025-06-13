<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeder yang sudah dibuat
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserRoleSeeder::class,
            UserPermissionSeeder::class,
            UserSessionSeeder::class,
            UserLogSeeder::class,
            AuditTrailSeeder::class,
        ]);
    }
}
