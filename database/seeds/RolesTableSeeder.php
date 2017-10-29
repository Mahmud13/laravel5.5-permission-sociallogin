<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'admin'
            ],

        ];

        $permissions = Permission::get();
        $num_of_perms = count($permissions);
        foreach ($roles as $key => $value) {
            $role = Role::create($value);
            $permissions = $permissions->shuffle();
            for ($i=0; $i<$num_of_perms; $i++) {
                $role->givePermissionTo($permissions->get($i)->name);
            }
        }
    }
}
