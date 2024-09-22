<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@laravel',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $superadmin->assignRole('superadmin');

        // Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@laravel',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
    }
}