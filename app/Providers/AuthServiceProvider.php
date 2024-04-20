<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage_jabatan',function($user){
            return $user->hasAnyPermission([
                'jabatan_show',
                'jabatan_create',
                'jabatan_update',
                'jabatan_delete'
            ]);
        });

        Gate::define('manage_golongan_gaji',function($user){
            return $user->hasAnyPermission([
                'golongan_gaji_show',
                'golongan_gaji_create',
                'golongan_gaji_update',
                'golongan_gaji_delete'
            ]);
        });

        Gate::define('manage_pegawai',function($user){
            return $user->hasAnyPermission([
                'pegawai_show',
                'pegawai_create',
                'pegawai_update',
                'pegawai_detail',
                'pegawai_delete'
            ]);
        });

        Gate::define('manage_gaji_pokok_pegawai',function($user){
            return $user->hasAnyPermission([
                'gaji_pokok_pegawai_show',
                'gaji_pokok_pegawai_create',
                'gaji_pokok_pegawai_update',
                'gaji_pokok_pegawai_detail',
                'gaji_pokok_pegawai_delete',
                'gaji_pokok_pegawai_cetak'
            ]);
        });

        Gate::define('manage_gaji_ttp_pegawai',function($user){
            return $user->hasAnyPermission([
                'gaji_ttp_pegawai_show',
                'gaji_ttp_pegawai_create',
                'gaji_ttp_pegawai_update',
                'gaji_ttp_pegawai_detail',
                'gaji_ttp_pegawai_delete',
                'gaji_ttp_pegawai_cetak'
            ]);
        });

        Gate::define('manage_edit_profil',function($user){
            return $user->hasAnyPermission([
                'edit_profil_update'
            ]);
        });

        Gate::define('manage_users',function($user){
            return $user->hasAnyPermission([
                'user_show',
                'user_create',
                'user_update',
                'user_delete'
            ]);
        });

        Gate::define('manage_roles',function($user){
            return $user->hasAnyPermission([
                'role_show',
                'role_create',
                'role_update',
                'role_detail',
                'role_delete'
            ]);
        });
    }
}
