<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

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
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'SuperAdmin',
            'slug' => 'superadmin',
            'permissions' => []
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => []
        ]);

        $superAdminRole = Sentinel::findRoleByName('SuperAdmin');
        if (empty($superAdminRole)) {
            echo "SuperAdmin role not found.";
            return;
        }

        $adminRole = Sentinel::findRoleByName('Admin');
        if (empty($adminRole)) {
            echo "admin role not found.";
            return;
        }

        $superAdmin = Sentinel::register([
            'username'          => 'SuperAdmin',
            "email"             => 'anthonyumpad+blogsuperadmin@gmail.com',
            "password"          => "blogsuperadmin",
        ]);

        $admin = Sentinel::register([
            'username'          => 'anthonyBlogAdmin',
            "email"             => 'anthonyumpad+blogAdmin@gmail.com',
            "password"          => "blogadmin",
        ]);

        $superAdmin->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
    }
}
