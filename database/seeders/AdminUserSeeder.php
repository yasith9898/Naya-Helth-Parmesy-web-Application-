<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if user already exists
        $user = User::where('email', 'admin@baklavainn.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@baklavainn.com',
                'password' => Hash::make('password'), // change this password
                'email_verified_at' => now(),
            ]);
            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists!');
        }
    }
}
