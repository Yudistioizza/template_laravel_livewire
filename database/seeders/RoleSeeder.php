<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'code' => 'ADMIN',
                'name' => 'Administrator',
                'description' => 'Memiliki akses penuh ke seluruh sistem.',
            ],
            [
                'code' => 'APPROVER',
                'name' => 'Approver',
                'description' => 'Bertanggung jawab untuk melakukan approval.',
            ],
            [
                'code' => 'MANAGER',
                'name' => 'Manager',
                'description' => 'Pengelola data dan monitoring.',
            ],
            [
                'code' => 'USER',
                'name' => 'User',
                'description' => 'Pengguna biasa dengan akses terbatas.',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'code' => $role['code'],
                'name' => $role['name'],
                'description' => $role['description'],
                'is_active' => true,
                'created_by' => 'Seeder',
                'created_at' => Carbon::now(),
                'modified_by' => 'Seeder',
                'modified_at' => Carbon::now(),
            ]);
        }
    }
}
