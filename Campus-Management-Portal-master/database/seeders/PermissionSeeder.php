<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create_faculties']);
        Permission::create(['name' => 'update_faculties']);
        Permission::create(['name' => 'delete_faculties']);
        Permission::create(['name' => 'manage_applications']);
        Permission::create(['name' => 'manage_enrollments']);
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'update_users']);
        Permission::create(['name' => 'delete_users']);
    }
}
