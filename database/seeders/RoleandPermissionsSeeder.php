<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleandPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-events']);
        Permission::create(['name' => 'create-venues']);
        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'create-comments']);

        Permission::create(['name' => 'destroy-events']);
        Permission::create(['name' => 'destroy-venues']);
        Permission::create(['name' => 'destroy-categories']);
        Permission::create(['name' => 'destroy-comments']);

        Permission::create(['name' => 'update-events']);
        Permission::create(['name' => 'update-venues']);
        Permission::create(['name' => 'update-categories']);
        Permission::create(['name' => 'update-comments']);

        //base role which every user will have
        $visitorRole = Role::create(['name' => 'Visitor']);
        $visitorRole->givePermissionTo([
            'create-events',
            'create-comments',
            'destroy-events',
            'destroy-comments',
            'update-events',
            'update-comments'
        ]);

        //for venue's to be able to create a page for their venue. Only added permission is create-venues. Other venue operations not permitted unless it is owned by the user
        $verifiedVenueRole = Role::create(['name' => 'Verified Venue']);
        $verifiedVenueRole->givePermissionTo([
            'create-events',
            'create-venues',
            'create-comments',
            'destroy-events',
            'destroy-comments',
            'update-events',
            'update-comments'
        ]);

        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo([
            'create-events',
            'create-venues',
            'create-categories',
            'create-comments',
            'destroy-events',
            'destroy-venues',
            'destroy-categories',
            'destroy-comments',
            'update-events',
            'update-venues',
            'update-categories',
            'update-comments'
        ]);

    }
}