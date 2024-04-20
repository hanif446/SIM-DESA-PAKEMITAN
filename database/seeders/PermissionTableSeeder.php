<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $listPermission = [];
        $adminPermissions = [];
        $userPermissions = [];

        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' =>  date('Y-m-d H:i:s'),
                    'updated_at' =>  date('Y-m-d H:i:s'),
                ];

                //Admin
                $adminPermissions[] = $permission;

                //User
                if (in_array($label, ['manage_gaji_pokok_pegawai', 'manage_gaji_ttp_pegawai',  'manage_edit_profil'])) {
                    $userPermissions[] = $permission;
                }
            }
        }

        //Insert permission

        Permission::insert($listPermission);

        //Insert roles

        //Admin
        $admin = Role::create([
            'name' => "Admin",
            'guard_name' => 'web',
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s'),
        ]);

        //User
        $user = Role::create([
            'name' => "User",
            'guard_name' => 'web',
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s'),
        ]);

        //Role -> permission
        $admin->givePermissionTo($adminPermissions);
        $user->givePermissionTo($userPermissions);

        //
        $userAdmin = User::find(1)->assignRole("Admin");
    }
}
