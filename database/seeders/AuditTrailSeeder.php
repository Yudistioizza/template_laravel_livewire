<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuditTrailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auditableTypes = ['User', 'Role', 'Permission'];
        $events = ['created', 'updated', 'deleted'];
        $users = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $auditableType = $auditableTypes[array_rand($auditableTypes)];
            $auditableId = rand(1, 10); // contoh ID random
            $event = $events[array_rand($events)];
            $userId = rand(0, 1) ? (count($users) ? $users[array_rand($users)] : null) : null;

            $oldValues = json_encode([
                'field1' => 'old_value_' . rand(1, 100),
                'field2' => 'old_value_' . rand(1, 100),
            ]);

            $newValues = json_encode([
                'field1' => 'new_value_' . rand(1, 100),
                'field2' => 'new_value_' . rand(1, 100),
            ]);

            DB::table('audit_trails')->insert([
                'auditable_type' => $auditableType,
                'auditable_id' => $auditableId,
                'user_id' => $userId,
                'event' => $event,
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'ip_address' => '192.168.1.' . rand(1, 254),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::now()->subDays(rand(0, 60)),
            ]);
        }
    }
}
