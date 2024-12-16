<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create users',
            'edit users',
            'delete users',
            'view users',
            'create roles',
            'edit roles',
            'delete roles',
            'view roles',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'view permissions'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
