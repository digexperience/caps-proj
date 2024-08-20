<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;
use Spatie\Permission\Traits\HasRoles;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user= User::create([
            'fname' => 'Admin',
            'lname' => 'Admin',
            'mi' => 'A',
            'phone' => '09123456789',
            'fingerprint' => 0,
            'status' => 1,
            'image' => 'p1.png',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12341234'),
        ]);
        $role = Role::create([
            'role' => '1',
            'name' => 'Admin',
        ]);
        $user->roles()->sync($role->id);
        $user= User::create([
            'fname' => 'User',
            'lname' => 'User',
            'mi' => 'U',
            'phone' => '09234567891',
            'fingerprint' => 1,
            'status' => 1,
            'image' => 'p2.jpg',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $role = Role::create([
            'role' => '0',
            'name' => 'user',
        ]);
        $user->roles()->sync($role->id);
        $user= User::create([
            'fname' => 'User',
            'lname' => 'User',
            'mi' => 'U',
            'phone' => '09345678912',
            'fingerprint' => 0,
            'status' => 0,
            'image' => '',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $role = Role::create([
            'role' => '0',
            'name' => 'user',
        ]);
        $user->roles()->sync($role->id);
    }
}
