<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil permission id berdasarkan kode permission
        $permissions = DB::table('permissions')->pluck('id', 'code');

        // Ambil semua user
        $users = DB::table('users')->get();

        foreach ($users as $index => $user) {
            // Contoh: hanya user pertama diberi direct permission
            if ($index === 0) {
                DB::table('user_permissions')->insert([
                    'user_id' => $user->id,
                    'permission_id' => $permissions['APPROVE_REQUEST'],
                ]);
            }

            // Contoh: user kedua diberi permission tambahan juga
            if ($index === 1) {
                DB::table('user_permissions')->insert([
                    'user_id' => $user->id,
                    'permission_id' => $permissions['EDIT_USER'],
                ]);
            }
        }
    }
}
