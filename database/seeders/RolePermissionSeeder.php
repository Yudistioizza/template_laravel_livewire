<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil role ID
        $roles = DB::table('roles')->pluck('id', 'code');
        // Ambil permission ID
        $permissions = DB::table('permissions')->pluck('id', 'code');

        // Mapping role ke permissions
        $rolePermissions = [
            'ADMIN' => [
                'VIEW_USER',
                'EDIT_USER',
                'DELETE_USER',
                'VIEW_ROLE',
                'EDIT_ROLE',
                'APPROVE_REQUEST',
            ],
            'APPROVER' => [
                'VIEW_USER',
                'APPROVE_REQUEST',
            ],
            'MANAGER' => [
                'VIEW_USER',
                'VIEW_ROLE',
            ],
            'USER' => [
                'VIEW_USER',
            ],
        ];

        foreach ($rolePermissions as $roleCode => $permissionCodes) {
            $roleId = $roles[$roleCode];
            foreach ($permissionCodes as $permCode) {
                $permissionId = $permissions[$permCode];

                DB::table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                ]);
            }
        }
    }
}
