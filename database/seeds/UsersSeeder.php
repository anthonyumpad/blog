<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Webpatser\Uuid\Uuid;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create roles
        $superAdminRole = Sentinel::findRoleByName('SuperAdmin');
        if (empty($superAdminRole)) {
           $superAdminRole = Sentinel::getRoleRepository()->createModel()->create([
               'name' => 'SuperAdmin',
               'slug' => 'superadmin',
               'permissions' => []
           ]);
        }

        $adminRole = Sentinel::findRoleByName('Admin');
        if (empty($adminRole)) {
            $adminRole = Sentinel::getRoleRepository()->createModel()->create([
                'name' => 'Admin',
                'slug' => 'admin',
                'permissions' => []
            ]);

        }

        $superAdmin = Sentinel::registerAndActivate([
            "email"             => 'shinigamitonio@gmail.com',
            "password"          => "password",
        ]);

        $superAdmin->username   = 'SuperAdmin';
        $superAdmin->uid        = Uuid::generate(4);
        $superAdmin->first_name = 'Super';
        $superAdmin->last_name  = 'Admin';
        $superAdmin->save();


        $admin = Sentinel::registerAndActivate([
            "email"             => 'anthonyumpad+blogAdmin@gmail.com',
            "password"          => "password",
        ]);

        $admin->username   = 'anthonyBlogAdmin';
        $admin->uid        = Uuid::generate(4);
        $admin->first_name = 'Anthony';
        $admin->last_name  = 'Blogger';
        $admin->save();

        $superAdmin->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
    }
}
