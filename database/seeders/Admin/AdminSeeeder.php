<?php

namespace Database\Seeders\Admin;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin();
        $admin->name = 'Super Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('password');
        $admin->save();

        /**
         * Create Super Admin Role
         */
        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'admin',
        ]);

        /**
         * Assign Role to Super Admin
         */
        $admin->assignRole('Super Admin');
    }
}
