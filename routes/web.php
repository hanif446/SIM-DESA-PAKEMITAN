<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false
]);

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('homepage.home');
Route::get('/visi_misi', [\App\Http\Controllers\HomeController::class, 'visi_misi'])->name('homepage.visi_misi');
Route::get('/sejarah', [\App\Http\Controllers\HomeController::class, 'sejarah'])->name('homepage.sejarah');
Route::get('/geografis', [\App\Http\Controllers\HomeController::class, 'geografis'])->name('homepage.geografis');
Route::get('/demografi', [\App\Http\Controllers\HomeController::class, 'demografi'])->name('homepage.demografi');
Route::get('/struktur-organisasi', [\App\Http\Controllers\HomeController::class, 'struktur_organisasi'])->name('homepage.struktur_organisasi');
Route::get('/perangkat-desa', [\App\Http\Controllers\HomeController::class, 'perangkat_desa'])->name('homepage.perangkat_desa');
Route::get('/kontak', [\App\Http\Controllers\HomeController::class, 'kontak'])->name('homepage.kontak');
Route::get('/galeri-desa', [\App\Http\Controllers\HomeController::class, 'galeri'])->name('homepage.galeri');
Route::get('/agenda-kegiatan-desa', [\App\Http\Controllers\HomeController::class, 'agenda'])->name('homepage.agenda-kegiatan-desa');
Route::get('/pengumuman-desa', [\App\Http\Controllers\HomeController::class, 'pengumuman'])->name('homepage.pengumuman-desa');
Route::get('/pengumuman-desa/detail/{id}', [\App\Http\Controllers\HomeController::class, 'pengumuman_detail'])->name('homepage.pengumuman-detail');
Route::get('/pengaduan-masyarakat', [\App\Http\Controllers\HomeController::class, 'pengaduan'])->name('homepage.pengaduan-masyarakat');
Route::post('/pengaduan-masyarakat/store', [\App\Http\Controllers\HomeController::class, 'store_pengaduan'])->name('homepage.pengaduan-store');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']],function(){
    //dashboard
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    // konten

    // visi misi
    Route::get('/konten/visi-misi', [\App\Http\Controllers\KontenController::class, 'visi_misi'])->name('visi_misi');
    Route::post('/konten/visi-misi/store', [\App\Http\Controllers\KontenController::class, 'store_visi_misi'])->name('visi_misi.store');

    // sejarah
    Route::get('/konten/sejarah', [\App\Http\Controllers\KontenController::class, 'sejarah'])->name('sejarah');
    Route::post('/konten/sejarah/store', [\App\Http\Controllers\KontenController::class, 'store_sejarah'])->name('sejarah.store');

    // geografis
    Route::get('/konten/geografis', [\App\Http\Controllers\KontenController::class, 'geografis'])->name('geografis');
    Route::post('/konten/geografis/store', [\App\Http\Controllers\KontenController::class, 'store_geografis'])->name('geografis.store');

    // demografi
    Route::get('/konten/demografi', [\App\Http\Controllers\KontenController::class, 'demografi'])->name('demografi');
    Route::post('/konten/demografi/store', [\App\Http\Controllers\KontenController::class, 'store_demografi'])->name('demografi.store');
    
    // struktur organisasi
    Route::get('/konten/struktur-organisasi', [\App\Http\Controllers\KontenController::class, 'struktur_organisasi'])->name('struktur_organisasi');
    Route::post('/konten/struktur-organisasi/store', [\App\Http\Controllers\KontenController::class, 'store_struktur_organisasi'])->name('struktur_organisasi.store');

    // kontak
    Route::get('/konten/kontak', [\App\Http\Controllers\KontenController::class, 'kontak'])->name('kontak');
    Route::post('/konten/kontak/store', [\App\Http\Controllers\KontenController::class, 'store_kontak'])->name('kontak.store');

    // galeri
    Route::get('/konten/galeri', [\App\Http\Controllers\KontenController::class, 'galeri'])->name('galeri');
    Route::get('/konten/galeri/create', [\App\Http\Controllers\KontenController::class, 'create_galeri'])->name('galeri.create');
    Route::get('/konten/galeri/edit/{galeri}', [\App\Http\Controllers\KontenController::class, 'edit_galeri'])->name('galeri.edit');
    Route::post('/konten/galeri/store', [\App\Http\Controllers\KontenController::class, 'store_galeri'])->name('galeri.store');
    Route::put('/konten/galeri/update/{galeri}', [\App\Http\Controllers\KontenController::class, 'update_galeri'])->name('galeri.update');
    Route::delete('/konten/galeri/delete/{galeri}', [\App\Http\Controllers\KontenController::class, 'delete_galeri'])->name('galeri.delete');


    //pegawai
    Route::get('/pegawai/select', [\App\Http\Controllers\PegawaiController::class, 'select'])->name('pegawai.select');
    Route::resource('/pegawai', \App\Http\Controllers\PegawaiController::class);

    //penduduk
    Route::get('/penduduk/select', [\App\Http\Controllers\PendudukController::class, 'select'])->name('penduduk.select');
    Route::resource('/penduduk', \App\Http\Controllers\PendudukController::class);

    //kk
    Route::get('/kk/select', [\App\Http\Controllers\KKController::class, 'select'])->name('kk.select');
    Route::resource('/kk', \App\Http\Controllers\KKController::class);
    Route::post('/kk/anggota-kk/store', [\App\Http\Controllers\KKController::class, 'store_anggota_kk'])->name('anggota_kk.store');
    Route::delete('/kk/anggota-kk/delete/{anggota_kk}', [\App\Http\Controllers\KKController::class, 'delete_anggota_kk'])->name('anggota_kk.delete');

    // pembayaran
    Route::resource('/pembayaran', \App\Http\Controllers\PembayaranController::class);

    // surat_masuk
    Route::resource('/surat_masuk', \App\Http\Controllers\SuratMasukController::class);

    // surat_keluar
    Route::resource('/surat_keluar', \App\Http\Controllers\SuratKeluarController::class);

    // pengumuman
    Route::resource('/pengumuman', \App\Http\Controllers\PengumumanController::class);

    // agenda
    Route::resource('/agenda', \App\Http\Controllers\AgendaController::class);

    // pengaduan
    Route::resource('/pengaduan', \App\Http\Controllers\PengaduanController::class);

    //roles
    Route::get('/roles/select', [\App\Http\Controllers\RoleController::class, 'select'])->name('roles.select');
    Route::resource('/roles', \App\Http\Controllers\RoleController::class);

    //user
    Route::get('/user/select', [\App\Http\Controllers\UserController::class, 'select'])->name('user.select');
    Route::get('/user/change-password', [\App\Http\Controllers\UserController::class, 'change_password'])->name('user.change_password');
    Route::post('/user/update-password', [\App\Http\Controllers\UserController::class, 'update_password'])->name('user.update_password');
    Route::get('/user/edit-profil/{user}', [\App\Http\Controllers\UserController::class, 'edit_profil'])->name('user.edit_profil');
    Route::put('/user/update-profil/{user}', [\App\Http\Controllers\UserController::class, 'update_profil'])->name('user.update_profil');
    Route::resource('/user', \App\Http\Controllers\UserController::class);

    //gaji_pokok
    Route::post('/gaji-pokok/cetak', [\App\Http\Controllers\GajiPokokController::class, 'cetak'])->name('gaji-pokok.cetak');
    Route::resource('/gaji-pokok', \App\Http\Controllers\GajiPokokController::class);
});
