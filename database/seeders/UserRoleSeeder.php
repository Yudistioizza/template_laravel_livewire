<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil role id berdasarkan kode role
        $roles = DB::table('roles')->pluck('id', 'code');

        // Ambil semua user
        $users = DB::table('users')->get();

        foreach ($users as $index => $user) {
            $assignedRole = 'USER'; // Default semua user sebagai USER

            // Sebagai contoh: user pertama jadi ADMIN
            if ($index === 0) {
                $assignedRole = 'ADMIN';
            }
            // User kedua jadi MANAGER
            elseif ($index === 1) {
                $assignedRole = 'MANAGER';
            }
            // User ketiga jadi APPROVER
            elseif ($index === 2) {
                $assignedRole = 'APPROVER';
            }

            // Assign role ke user
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => $roles[$assignedRole],
            ]);
        }
    }
}
