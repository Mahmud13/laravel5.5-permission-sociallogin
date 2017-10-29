<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
use App\Client;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin')
            ]
        ];

        $roles = Role::get();
        foreach ($users as $key => $value) {
            $user = User::create($value);
            if ($user->email == 'admin@admin.com') {
                foreach ($roles as $role) {
                    $user->assignRole($role->name);
                }
            }
        }
    }
}
