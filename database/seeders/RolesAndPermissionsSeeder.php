<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);

        // Create permissions
        Permission::create(['name' => 'manage admissions']);
        Permission::create(['name' => 'manage staff']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['manage admissions', 'manage staff']);
        $staffRole->givePermissionTo(['manage admissions']);
    }
}