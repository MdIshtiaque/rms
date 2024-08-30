<?php

namespace Database\Seeders;

use App\Enums\RoleEnums;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create an super admin user
        User::create([
            'name' => 'Super Admin User',
            'email' => 'emon@gmail.com',
            'password' => Hash::make('Emon1234'),
            'email_verified_at' => now(),
        ])->assignRole(RoleEnums::SUPER_ADMIN->value);
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Emon1234'),
            'email_verified_at' => now(),
        ])->assignRole(RoleEnums::ADMIN->value);

        // Create a manager user
        User::create([
            'name' => 'Bachelor User',
            'email' => 'bachelor@gmail.com',
            'password' => Hash::make('Emon1234'),
            'email_verified_at' => now(),
        ])->assignRole(RoleEnums::BACHELOR->value);

        // Create a regular user
        User::create([
            'name' => 'Flat Owner User',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('Emon1234'),
            'email_verified_at' => now(),
        ])->assignRole(RoleEnums::FLAT_OWNER->value);

        // Create additional users with random roles
        User::factory(10)->create()->each(function ($user) {
            $role = RoleEnums::cases()[array_rand(RoleEnums::cases())]->value;
            $user->assignRole($role);
        });
    }
}
