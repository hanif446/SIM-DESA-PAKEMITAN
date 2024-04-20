<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(
                    ['name' => $permission, 'guard_name' => 'web'],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }

        // Insert roles
        $admin = Role::firstOrCreate(
            ['name' => "Admin", 'guard_name' => 'web'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        // Assign permissions to roles
        $admin->syncPermissions(Permission::pluck('id'));

        // Assign role to a user
        $userAdmin = User::find(1)->assignRole("Admin");
    }

}
