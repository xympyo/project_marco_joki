<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin; // Import your Admin model
use Illuminate\Support\Facades\Hash; // For hashing the password

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if an admin with this email already exists to prevent duplicates
        if (!Admin::where('email', 'admin@example.com')->exists()) {
            Admin::create([
                'email' => 'admin@example.com', // The admin's login email
                'password' => Hash::make('password'), // The admin's password (change in production!)
                // If your 'admins' table has a 'name' column, you can add it here:
                // 'name' => 'Super Admin',
            ]);

            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists!');
        }
    }
}
