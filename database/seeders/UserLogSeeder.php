<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            'LOGIN',
            'LOGOUT',
            'UPDATE_PROFILE',
            'CHANGE_PASSWORD',
            'FAILED_LOGIN',
        ];

        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // Untuk simulasi, tiap user akan punya 3 log random
            for ($i = 0; $i < 3; $i++) {
                DB::table('user_logs')->insert([
                    'user_id' => $user->id,
                    'action' => $actions[array_rand($actions)],
                    'description' => 'Auto generated log entry.',
                    'ip_address' => '192.168.1.' . rand(1, 254),
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                    'logged_at' => Carbon::now()->subDays(rand(0, 60)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Tambahkan juga contoh log tanpa user (user_id null)
        for ($i = 0; $i < 5; $i++) {
            DB::table('user_logs')->insert([
                'user_id' => null,
                'action' => $actions[array_rand($actions)],
                'description' => 'System log without user.',
                'ip_address' => '10.0.0.' . rand(1, 254),
                'user_agent' => 'System/Daemon',
                'logged_at' => Carbon::now()->subDays(rand(0, 60)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
