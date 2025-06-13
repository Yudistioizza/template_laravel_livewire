<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data 5 user
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => "User {$i}",
                'email' => "user{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // password default
                'remember_token' => Str::random(10),
                'current_team_id' => null, // pastikan aman
                'profile_photo_path' => null,
                'username' => "username{$i}",
                'other_email' => "other{$i}@example.com",
                'auth_provider' => 'LOCAL',
                'external_id' => null,
                'is_active' => true,
                'is_email_verified' => true,
                'company' => "Company {$i}",
                'jabatan' => "Jabatan {$i}",
                'role' => "Role {$i}",
                'region' => "Region {$i}",
                'failed_login_attempt' => 0,
                'lockout_until' => null,
                'last_password_change' => now(),
                'last_login_date' => now(),
                'token_login' => Str::random(30),
                'created_by' => 'Seeder',
                'created_date' => now(),
                'modified_by' => 'Seeder',
                'modified_date' => now(),
                'ip_address' => '127.0.0.1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
