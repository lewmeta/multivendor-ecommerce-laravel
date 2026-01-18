<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $permissions = [
            ['name' => 'KYC Management', 'group' => 'KYC Management'],
            ['name' => 'Role Management', 'group' => 'Access Management'],
            ['name' => 'Role User Management', 'group' => 'Access Management'],
            ['name' => 'Category Management', 'group' => 'Product Categories'],
            ['name' => 'Tags Management', 'group' => 'Product Tags'],
            ['name' => 'Brand Management', 'group' => 'Product Brands'],
            ['name' => 'Product Management', 'group' => 'Products'],
            ['name' => 'Order Management', 'group' => 'Order'],
            ['name' => 'Ecommerce Management', 'group' => 'Ecommerce'],
            ['name' => 'Section Management', 'group' => 'Home Sections'],
            ['name' => 'Subscriber Management', 'group' => 'Subscribers'],
            ['name' => 'Withdraw Management', 'group' => 'Withdraw'],
            ['name' => 'Page Management', 'group' => 'Page Builder'],
            ['name' => 'Advertisement Management', 'group' => 'Advertisement'],
            ['name' => 'Contact Management', 'group' => 'Contact'],
            ['name' => 'Payment Setting', 'group' => 'Payment Setting'],
            ['name' => 'Settings Management', 'group' => 'Site Settings'],
        ];

         foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [
                    'name' => $permission['name'],
                    'guard_name' => 'admin'
                ],
                [
                    'group' => $permission['group']
                ]
            );
        }
    }
}
