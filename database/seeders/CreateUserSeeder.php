<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::create([
        	'name' => 'Super Admin',
        	'email' => 'admin@gmail.com',
        	'user_name' => 'admin',
        	'contact' => '03221212123',
        	'password' => bcrypt('123456')
        ]);

        $adminRole = Role::where('name', 'Super Admin')->first();

        $permissions = Permission::pluck('id', 'id')->all();

        $adminRole->syncPermissions($permissions);

        $adminUser->assignRole([$adminRole->id]);


        // Client
        // $clientUser = User::create([
        // 	'name' => 'client user',
        // 	'email' => 'client@gmail.com',
        // 	'user_name' => 'client',
        // 	'contact' => '03221212123',
        // 	'password' => bcrypt('123456')
        // ]);

        // $clientRole = Role::where('name', 'Client')->first();

        // // $permissions = Permission::pluck('id', 'id')->all();

        // $clientRole->syncPermissions($permissions);

        // $clientUser->assignRole([$clientRole->id]);
    }
}
