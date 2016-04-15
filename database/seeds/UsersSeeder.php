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
            'username'          => 'SuperAdmin',
            "uid"               => Uuid::generate(4),
            "email"             => 'anthonyumpad+blogsuperadmin@gmail.com',
            "password"          => "password",
            "first_name"        => 'Super',
            "last_name"         => 'Admin',
        ]);

        $admin = Sentinel::registerAndActivate([
            'username'          => 'anthonyBlogAdmin',
            "uid"               => Uuid::generate(4),
            "email"             => 'anthonyumpad+blogAdmin@gmail.com',
            "password"          => "password",
            "first_name"        => 'Anthony',
            "last_name"         => 'Blogger',
        ]);

        $superAdmin->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
    }
}
