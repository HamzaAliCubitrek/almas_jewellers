<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-show',
           'permission-delete',

           //role
           'role-list',
           'role-create',
           'role-edit',
           'role-show',
           'role-delete',

           //users
           'user-list',
           'user-create',
           'user-edit',
           'user-show',
           'user-delete',
        ];

        foreach ($permissions as $permission) {
            $exists = Permission::where('name', $permission)->first();
            if ($exists === null) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
