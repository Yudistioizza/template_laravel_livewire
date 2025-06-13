<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'code' => 'VIEW_USER',
                'name' => 'View User',
                'description' => 'Melihat data user.',
            ],
            [
                'code' => 'EDIT_USER',
                'name' => 'Edit User',
                'description' => 'Mengedit data user.',
            ],
            [
                'code' => 'DELETE_USER',
                'name' => 'Delete User',
                'description' => 'Menghapus data user.',
            ],
            [
                'code' => 'VIEW_ROLE',
                'name' => 'View Role',
                'description' => 'Melihat data role.',
            ],
            [
                'code' => 'EDIT_ROLE',
                'name' => 'Edit Role',
                'description' => 'Mengedit data role.',
            ],
            [
                'code' => 'APPROVE_REQUEST',
                'name' => 'Approve Request',
                'description' => 'Melakukan approval permintaan.',
            ],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'code' => $permission['code'],
                'name' => $permission['name'],
                'description' => $permission['description'],
                'is_active' => true,
                'created_by' => 'Seeder',
                'created_at' => Carbon::now(),
                'modified_by' => 'Seeder',
                'modified_at' => Carbon::now(),
            ]);
        }
    }
}
