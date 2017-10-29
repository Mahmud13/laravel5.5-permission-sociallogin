<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'name' => 'role-list',
                'category' => 'role',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'role-create',
                'category' => 'role',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'role-edit',
                'category' => 'role',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'role-delete',
                'category' => 'role',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-list',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-create',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-edit',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-delete',
                'category' => 'user',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'user-approve',
                'category' => 'user',
                'guard_name' => 'admin',
            ],

            [
                'name' => 'permission-list',
                'category' => 'permission',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'permission-create',
                'category' => 'permission',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'permission-edit',
                'category' => 'permission',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'permission-delete',
                'category' => 'permission',
                'guard_name' => 'admin',
            ],
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
