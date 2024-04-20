<?php // routes/breadcrumbs.php
// Dashboard
Breadcrumbs::for('dashboard', function ( $trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Dashboard >  Home
Breadcrumbs::for('dashboard_home', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '#');
});

// Dashboard > Visi & Misi
Breadcrumbs::for('dashboard_visi_misi', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Visi & Misi', route('visi_misi'));
});

// Dashboard > Sejarah
Breadcrumbs::for('dashboard_sejarah', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Sejarah', route('sejarah'));
});

// Dashboard > Geografis
Breadcrumbs::for('dashboard_geografis', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Geografis', route('geografis'));
});

// Dashboard > Demografi
Breadcrumbs::for('dashboard_demografi', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Demografi', route('demografi'));
});

// Dashboard > Struktur Organisasi
Breadcrumbs::for('dashboard_struktur_organisasi', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Struktur Organisasi', route('struktur_organisasi'));
});

// Dashboard > Kontak
Breadcrumbs::for('dashboard_kontak', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Kontak', route('kontak'));
});

// Dashboard > Galeri
Breadcrumbs::for('dashboard_galeri', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Galeri', route('galeri'));
});

// Dashboard > Galeri > Tambah Galeri
Breadcrumbs::for('dashboard_galeri_create', function ( $trail) {
    $trail->parent('dashboard_galeri');
    $trail->push('Tambah Foto', route('galeri.create'));
});

// Dashboard > Galeri > Edit Galeri
Breadcrumbs::for('dashboard_galeri_edit', function ( $trail, $galeri) {
    $trail->parent('dashboard_galeri');
    $trail->push('Edit Foto', route('galeri.edit', ['galeri' => $galeri]));
});

// Dashboard > Pegawai
Breadcrumbs::for('dashboard_pegawai', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Pegawai', route('pegawai.index'));
});

// Dashboard > Pegawai > Tambah Pegawai
Breadcrumbs::for('dashboard_pegawai_create', function ( $trail) {
    $trail->parent('dashboard_pegawai');
    $trail->push('Tambah Pegawai', route('pegawai.create'));
});

// Dashboard > Pegawai > Edit Pegawai
Breadcrumbs::for('dashboard_pegawai_edit', function ( $trail, $pegawai) {
    $trail->parent('dashboard_pegawai');
    $trail->push('Edit', route('pegawai.edit', ['pegawai' => $pegawai]));
    $trail->push($pegawai->nama_pegawai, route('pegawai.edit',['pegawai' => $pegawai]));
});

// Dashboard > Pegawai > Detail Pegawai
Breadcrumbs::for('dashboard_pegawai_detail', function ( $trail, $pegawai) {
    $trail->parent('dashboard_pegawai');
    $trail->push('Detail', route('pegawai.show', ['pegawai' => $pegawai]));
    $trail->push($pegawai->nama_pegawai, route('pegawai.show',['pegawai' => $pegawai]));
});

// Dashboard > Penduduk
Breadcrumbs::for('dashboard_penduduk', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Penduduk', route('penduduk.index'));
});

// Dashboard > Penduduk > Tambah Penduduk
Breadcrumbs::for('dashboard_penduduk_create', function ( $trail) {
    $trail->parent('dashboard_penduduk');
    $trail->push('Tambah Penduduk', route('penduduk.create'));
});

// Dashboard > Penduduk > Edit Penduduk
Breadcrumbs::for('dashboard_penduduk_edit', function ( $trail, $penduduk) {
    $trail->parent('dashboard_penduduk');
    $trail->push('Edit', route('penduduk.edit', ['penduduk' => $penduduk]));
    $trail->push($penduduk->nama, route('penduduk.edit',['penduduk' => $penduduk]));
});

// Dashboard > Penduduk > Detail Penduduk
Breadcrumbs::for('dashboard_penduduk_detail', function ( $trail, $penduduk) {
    $trail->parent('dashboard_penduduk');
    $trail->push('Detail', route('penduduk.show', ['penduduk' => $penduduk]));
    $trail->push($penduduk->nama, route('penduduk.show',['penduduk' => $penduduk]));
});

// Dashboard > Kartu Keluarga
Breadcrumbs::for('dashboard_kk', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Kartu Keluarga', route('kk.index'));
});

// Dashboard > Kartu Keluarga > Tambah Kartu Keluarga
Breadcrumbs::for('dashboard_kk_create', function ( $trail) {
    $trail->parent('dashboard_kk');
    $trail->push('Tambah Kartu Keluarga', route('kk.create'));
});

// Dashboard > Kartu Keluarga > Edit Kartu Keluarga
Breadcrumbs::for('dashboard_kk_edit', function ( $trail, $kk) {
    $trail->parent('dashboard_kk');
    $trail->push('Edit', route('kk.edit', ['kk' => $kk]));
    $trail->push($kk->no_kk, route('kk.edit',['kk' => $kk]));
});

// Dashboard > Kartu Keluarga > Anggota Kartu Keluarga
Breadcrumbs::for('dashboard_kk_anggota', function ( $trail, $kk) {
    $trail->parent('dashboard_kk');
    $trail->push('Anggota KK', route('kk.show', ['kk' => $kk]));
    $trail->push($kk->no_kk, route('kk.show',['kk' => $kk]));
});

// Dashboard > Pembayaran
Breadcrumbs::for('dashboard_pembayaran', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Pembayaran', route('pembayaran.index'));
});

// Dashboard > Pembayaran > Tambah Pembayaran
Breadcrumbs::for('dashboard_pembayaran_create', function ( $trail) {
    $trail->parent('dashboard_pembayaran');
    $trail->push('Tambah Pembayaran', route('pembayaran.create'));
});

// Dashboard > Pembayaran > Edit Pembayaran
Breadcrumbs::for('dashboard_pembayaran_edit', function ( $trail, $pembayaran) {
    $trail->parent('dashboard_pembayaran');
    $trail->push('Edit Pembayaran', route('pembayaran.edit', ['pembayaran' => $pembayaran]));
});

// Dashboard > Surat Masuk
Breadcrumbs::for('dashboard_surat_masuk', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Pengarsipan Surat Masuk', route('surat_masuk.index'));
});

// Dashboard > Surat Masuk > Tambah Surat Masuk
Breadcrumbs::for('dashboard_surat_masuk_create', function ( $trail) {
    $trail->parent('dashboard_surat_masuk');
    $trail->push('Tambah Surat Masuk', route('surat_masuk.create'));
});

// Dashboard > Surat Masuk > Edit Surat Masuk
Breadcrumbs::for('dashboard_surat_masuk_edit', function ( $trail, $surat_masuk) {
    $trail->parent('dashboard_surat_masuk');
    $trail->push('Edit Surat Masuk', route('surat_masuk.edit', ['surat_masuk' => $surat_masuk]));
});

// Dashboard > Surat Masuk > Detail Surat Masuk
Breadcrumbs::for('dashboard_surat_masuk_detail', function ( $trail, $surat_masuk) {
    $trail->parent('dashboard_surat_masuk');
    $trail->push('Detail Surat Masuk', route('surat_masuk.show', ['surat_masuk' => $surat_masuk]));
});

// Dashboard > Surat Keluar
Breadcrumbs::for('dashboard_surat_keluar', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Pengarsipan Surat Keluar', route('surat_keluar.index'));
});

// Dashboard > Surat Keluar > Tambah Surat Keluar
Breadcrumbs::for('dashboard_surat_keluar_create', function ( $trail) {
    $trail->parent('dashboard_surat_keluar');
    $trail->push('Tambah Surat Keluar', route('surat_keluar.create'));
});

// Dashboard > Surat Keluar > Edit Surat Keluar
Breadcrumbs::for('dashboard_surat_keluar_edit', function ( $trail, $surat_keluar) {
    $trail->parent('dashboard_surat_keluar');
    $trail->push('Edit Surat Keluar', route('surat_keluar.edit', ['surat_keluar' => $surat_keluar]));
});

// Dashboard > Surat Keluar  > Detail Surat Keluar
Breadcrumbs::for('dashboard_surat_keluar_detail', function ( $trail, $surat_keluar) {
    $trail->parent('dashboard_surat_keluar');
    $trail->push('Detail Surat Keluar', route('surat_keluar.show', ['surat_keluar' => $surat_keluar]));
});


// Dashboard > Pengumuman
Breadcrumbs::for('dashboard_pengumuman', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Pengumuman', route('pengumuman.index'));
});

// Dashboard > Pengumuman > Tambah Pengumuman
Breadcrumbs::for('dashboard_pengumuman_create', function ( $trail) {
    $trail->parent('dashboard_pengumuman');
    $trail->push('Tambah Pengumuman', route('pengumuman.create'));
});

// Dashboard > Pengumuman > Edit Pengumuman
Breadcrumbs::for('dashboard_pengumuman_edit', function ( $trail, $pengumuman) {
    $trail->parent('dashboard_pengumuman');
    $trail->push('Edit Pengumuman', route('pengumuman.edit', ['pengumuman' => $pengumuman]));
});

// Dashboard > Agenda
Breadcrumbs::for('dashboard_agenda', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Agenda Kegiatan Desa', route('agenda.index'));
});

// Dashboard > Agenda > Tambah Agenda
Breadcrumbs::for('dashboard_agenda_create', function ( $trail) {
    $trail->parent('dashboard_agenda');
    $trail->push('Tambah Agenda', route('agenda.create'));
});

// Dashboard > Agenda > Edit Agenda
Breadcrumbs::for('dashboard_agenda_edit', function ( $trail, $agenda) {
    $trail->parent('dashboard_agenda');
    $trail->push('Edit Agenda', route('agenda.edit', ['agenda' => $agenda]));
});

// Dashboard > Pengaduan Masyarakat
Breadcrumbs::for('dashboard_pengaduan', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Pengaduan Masyarakat', route('pengaduan.index'));
});

// Dashboard > Roles
Breadcrumbs::for('dashboard_roles', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

// Dashboard > Add > Roles
Breadcrumbs::for('dashboard_roles_create', function ( $trail) {
    $trail->parent('dashboard_roles');
    $trail->push('Tambah Roles', route('roles.create'));
});

// Dashboard > Roles > Detail > [Title]
Breadcrumbs::for('dashboard_roles_detail', function ( $trail, $role) {
    $trail->parent('dashboard_roles');
    $trail->push('Detail', route('roles.show',['role' => $role]));
    $trail->push($role->name, route('roles.show',['role' => $role]));
});

// Dashboard > Roles > Edit > [Title]
Breadcrumbs::for('dashboard_roles_edit', function ( $trail, $role) {
    $trail->parent('dashboard_roles');
    $trail->push('Edit', route('roles.edit',['role' => $role]));
    $trail->push($role->name, route('roles.edit',['role' => $role]));
});

// Dashboard > Users
Breadcrumbs::for('dashboard_users', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('user.index'));
});

// Dashboard > Add > Users
Breadcrumbs::for('dashboard_users_create', function ( $trail) {
    $trail->parent('dashboard_users');
    $trail->push('Tambah Users', route('user.create'));
});

// Dashboard > Users > Edit > [Title]
Breadcrumbs::for('dashboard_users_edit', function ( $trail, $user) {
    $trail->parent('dashboard_users');
    $trail->push('Edit', route('user.edit',['user' => $user]));
    $trail->push($user->username, route('user.edit',['user' => $user]));
});

// Dashboard > Change Password
Breadcrumbs::for('dashboard_change_password', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Change Password', route('user.change_password'));
});

// Dashboard > Gaji Pokok
Breadcrumbs::for('dashboard_gaji_pokok', function ( $trail) {
    $trail->parent('dashboard');
    $trail->push('Gaji Pegawai', route('gaji-pokok.index'));
});

// Dashboard > Gaji Pokok > Tambah Gaji Pokok Pegawai
Breadcrumbs::for('dashboard_gaji_pokok_create', function ( $trail) {
    $trail->parent('dashboard_gaji_pokok');
    $trail->push('Tambah Gaji Pegawai', route('gaji-pokok.create'));
});

// Dashboard > Gaji Pokok > Edit Gaji Pokok Pegawai
Breadcrumbs::for('dashboard_gaji_pokok_edit', function ( $trail, $gaji_pokok) {
    $trail->parent('dashboard_gaji_pokok');
    $trail->push('Edit Gaji Pegawai', route('gaji-pokok.edit', ['gaji_pokok' => $gaji_pokok]));
});

// Dashboard > Gaji Pokok > Detail Gaji Pokok Pegawai
Breadcrumbs::for('dashboard_gaji_pokok_detail', function ( $trail, $gaji_pokok) {
    $trail->parent('dashboard_gaji_pokok');
    $trail->push('Detail Gaji Pegawai', route('gaji-pokok.show', ['gaji_pokok' => $gaji_pokok]));
});

// Dashboard > Edit Profil
Breadcrumbs::for('dashboard_edit_profil', function ( $trail, $user) {
    $trail->parent('dashboard');
    $trail->push('Edit Profil', route('user.edit_profil', ['user' => $user]));
});
