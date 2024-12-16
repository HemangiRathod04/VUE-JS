<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles= ['super admin', 'admin', 'agent', 'user'];
        foreach($roles as $role){
            role::create(['name'=>$role]);
        }
    }
}
