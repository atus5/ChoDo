<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin accounts
        User::create([
            'name' => 'Admin Chính',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // Password: admin123
        ]);

        User::create([
            'name' => 'Admin Quản Lý',
            'email' => 'admin.manager@admin.com',
            'password' => Hash::make('123456'), // Password: 123456
        ]);

        User::create([
            'name' => 'Tester Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('test123'), // Password: test123
        ]);
    }
}
