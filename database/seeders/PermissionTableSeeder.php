<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'user.active', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.create', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.edit', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.delete', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.status', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'permission.active', 'guard_name' => 'web', 'group_name' => 'Permission'],
            ['name' => 'role.active', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.create', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.edit', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.delete', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.permission', 'guard_name' => 'web', 'group_name' => 'Role'],
        ];

        Permission::insert($permissions);
    }
}