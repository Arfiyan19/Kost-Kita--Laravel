<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AddRoleAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  User::create([
            'name'  => 'Admin',
            'email' => 'admin@gmail.com',
            'role'  => 'Admin',
            'password' => Hash::make(12345678),
        ]);

        $role = Role::create([
            'name'  => 'Admin'
        ]);

        $user->assignRole($role);
    }
}
