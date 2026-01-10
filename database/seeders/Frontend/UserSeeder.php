<?php

namespace Database\Seeders\Frontend;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Test user",
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Vendor User',
            'email' => 'vendor@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'vendor'
        ]);
    }
}
