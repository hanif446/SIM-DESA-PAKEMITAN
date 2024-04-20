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

        Gate::define('manage_konten',function($user){
            return $user->hasAnyPermission([
                'konten_visi_misi',
                'konten_sejarah',
                'konten_geografis',
                'konten_demografi',
                'konten_struktur_organisasi',
                'konten_kontak',
                'konten_galeri'
            ]);
        });

        Gate::define('manage_pengumuman',function($user){
            return $user->hasAnyPermission([
                'pengumuman_show'
            ]);
        });

        Gate::define('manage_agenda',function($user){
            return $user->hasAnyPermission([
                'agenda_show'
            ]);
        });

        Gate::define('manage_pegawai',function($user){
            return $user->hasAnyPermission([
                'pegawai_show'
            ]);
        });

        Gate::define('manage_gaji_pokok_pegawai',function($user){
            return $user->hasAnyPermission([
                'gaji_pokok_pegawai_show'
            ]);
        });

        Gate::define('manage_penduduk',function($user){
            return $user->hasAnyPermission([
                'penduduk_show'
            ]);
        });

        Gate::define('manage_kk',function($user){
            return $user->hasAnyPermission([
                'kk_show'
            ]);
        });

        Gate::define('manage_surat_masuk',function($user){
            return $user->hasAnyPermission([
                'surat_masuk_show'
            ]);
        });

        Gate::define('manage_surat_keluar',function($user){
            return $user->hasAnyPermission([
                'surat_keluar_show'
            ]);
        });

        Gate::define('manage_pembayaran',function($user){
            return $user->hasAnyPermission([
                'pembayaran_show'
            ]);
        });

        Gate::define('manage_pengaduan',function($user){
            return $user->hasAnyPermission([
                'pengaduan_show'
            ]);
        });

        Gate::define('manage_users',function($user){
            return $user->hasAnyPermission([
                'user_show'
            ]);
        });

        Gate::define('manage_roles',function($user){
            return $user->hasAnyPermission([
                'role_show'
            ]);
        });
    }
}
