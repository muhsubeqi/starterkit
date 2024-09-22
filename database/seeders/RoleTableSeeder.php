<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web',
        ]);
        $role->givePermissionTo('role.active');
        $role->givePermissionTo('role.create');
        $role->givePermissionTo('role.edit');
        $role->givePermissionTo('role.delete');
        $role->givePermissionTo('role.permission');

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'member',
        ]);
    }
}