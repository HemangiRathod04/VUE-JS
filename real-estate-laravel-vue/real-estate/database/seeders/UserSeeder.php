<?php

namespace Database\Seeders;

use App\Models\role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'superadmin@example.com')->first();
        if ($user) {
            $user->update([
                'role_id' => 1,
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(60), // Updating the remember token
            ]);
        } else {
        $user = User::create([
            'role_id' => 1,
            'name' => 'Super Admin',
            'email'=> 'superadmin@example.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
        ]);
    }

        $superAdminRole = role::where('name', 'super admin')->first();
        $user->roles()->sync([$superAdminRole->id]);
        // $user->roles()->attach($superAdminRole);
    }
}
