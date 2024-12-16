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
     */
    public function run(): void
    {
         // Create permissions
         Permission::create(['name' => 'manage students']);
         Permission::create(['name' => 'manage teachers']);
         Permission::create(['name' => 'manage classes']);

          // Create roles and assign existing permissions
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('manage students');
        $role->givePermissionTo('manage classes');

        Role::create(['name' => 'student']);
        Role::create(['name' => 'parent']);
         
    }
}
