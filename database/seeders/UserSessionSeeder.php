<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // Simulasi data session aktif
            DB::table('user_sessions')->insert([
                'user_id' => $user->id,
                'session_token' => Str::uuid()->toString(),
                'ip_address' => '192.168.1.' . rand(1, 254),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'login_at' => Carbon::now()->subDays(rand(0, 30)),
                'logout_at' => rand(0, 1) ? Carbon::now()->subDays(rand(0, 30)) : null,
                'is_active' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
