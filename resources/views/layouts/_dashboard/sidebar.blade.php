<ul class="sidenav navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">


    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('homepage.home') }}">
        <div class="sidebar-brand-icon ">
            <img src="{{asset('template/img/logo-kab.png')}}" width="40">
        </div>
        <div class="sidebar-brand-text mx-3">
            <span>PAKEMITAN</span>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->


    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{set_active('dashboard.index')}}">
        <a class="nav-link" href="{{route('dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Heading -->
    <div class="sidebar-heading my-1">
        Master
    </div>

    <!-- Konten -->
    @can('manage_konten', 'manage_pengumuman', 'manage_agenda')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#konten"
            aria-expanded="true" aria-controls="konten">
            <i class="fas fa-fw fa-home"></i>
            <span>Konten</span>
        </a>
        <div id="konten" class="collapse @yield('main_konten')" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Konten:</h6>
                @can('manage_konten')
                    @can('konten_visi_misi')
                    <a class="collapse-item @yield('visi_misi')" href="{{route('visi_misi')}}">Visi & Misi</a>
                    @endcan
                    @can('konten_sejarah')
                    <a class="collapse-item @yield('sejarah')" href="{{route('sejarah')}}">Sejarah Desa</a>
                    @endcan
                    @can('konten_geografis')
                    <a class="collapse-item @yield('geografis')" href="{{route('geografis')}}">Geografis Desa</a>
                    @endcan
                    @can('konten_demografi')
                    <a class="collapse-item @yield('demografi')" href="{{route('demografi')}}">Demografi Desa</a>
                    @endcan
                    @can('konten_struktur_organisasi')
                    <a class="collapse-item @yield('struktur_organisasi')" href="{{route('struktur_organisasi')}}">Struktur Organisasi</a>
                    @endcan
                    @can('konten_galeri')
                    <a class="collapse-item @yield('galeri')" href="{{route('galeri')}}">Galeri</a>
                    @endcan
                    @can('konten_kontak')
                    <a class="collapse-item @yield('kontak')" href="{{route('kontak')}}">Kontak</a>
                    @endcan
                @endcan
                @can('manage_pengumuman')
                <a class="collapse-item @yield('pengumuman')" href="{{route('pengumuman.index')}}">Pengumuman</a>
                @endcan
                @can('manage_agenda')
                <a class="collapse-item @yield('agenda')" href="{{route('agenda.index')}}">Agenda Kegiatan Desa</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan
    
    <!-- Pegawai -->
    @can('manage_pegawai', 'manage_gaji_pokok_pegawai')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pegawai"
            aria-expanded="true" aria-controls="pegawai">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Pegawai</span>
        </a>
        <div id="pegawai" class="collapse @yield('main')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pegawai:</h6>
            @can('manage_pegawai')
                <a class="collapse-item @yield('pegawai')" href="{{route('pegawai.index')}}">Data Pegawai</a>
            @endcan
            @can('manage_gaji_pokok_pegawai')
            <a class="collapse-item @yield('gaji_pegawai')" href="{{route('gaji-pokok.index')}}">Data Gaji Pegawai</a>
            </div>
            @endcan
        </div>
    </li>
    @endcan

    <!-- Penduduk -->
    @can('manage_penduduk', 'manage_kk')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penduduk"
            aria-expanded="true" aria-controls="penduduk">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Penduduk</span>
        </a>
        <div id="penduduk" class="collapse @yield('main_penduduk')" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Penduduk:</h6>
                @can('manage_penduduk')
                <a class="collapse-item @yield('penduduk')" href="{{route('penduduk.index')}}">Data Penduduk</a>
                @endcan
                @can('manage_kk')
                <a class="collapse-item @yield('kk')" href="{{route('kk.index')}}">Data KK</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    <!-- Pengarsipan Surat-->
    @can('manage_surat_keluar', 'manage_surat_keluar')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengarsipanSurat"
            aria-expanded="true" aria-controls="pengarsipanSurat">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Pengarsipan Surat</span>
        </a>
        <div id="pengarsipanSurat" class="collapse @yield('main_surat')" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengarsipan Surat:</h6>
                @can('manage_surat_masuk')
                <a class="collapse-item @yield('surat_masuk')" href="{{route('surat_masuk.index')}}">Data Surat Masuk</a>
                @endcan
                @can('manage_surat_keluar')
                <a class="collapse-item @yield('surat_keluar')" href="{{route('surat_keluar.index')}}">Data Surat Keluar</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    <!-- Pembayaran -->
    <li class="nav-item {{set_active(['pembayaran.index', 'pembayaran.create', 'pembayaran.edit'])}}">
        @can('manage_pembayaran')
        <a class="nav-link" href="{{route('pembayaran.index')}}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Pembayaran</span>
        </a>
        @endcan
    </li>

    <!-- Pengaduan Masyarakat -->
    <li class="nav-item {{set_active('pengaduan.index')}}">
        @can('manage_pengaduan')
        <a class="nav-link" href="{{route('pengaduan.index')}}">
            <i class="fas fa-fw fa-comments"></i>
            <span>Pengaduan Masyarakat</span>
        </a>
        @endcan
    </li>

    <!-- User -->
    @if (Auth::user()->roles->first()->name == 'SuperAdmin')
    @can('manage_users', 'manage_roles')
        <div class="sidebar-heading my-1">
            User Permission
        </div>
    @endcan
    @elseif (Auth::user()->roles->first()->name == 'Admin')
        @can('manage_users')
        <div class="sidebar-heading my-1">
            User Permission
        </div>
    @endcan
    @endif

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Users -->
    <li class="nav-item {{set_active(['user.index', 'user.show', 'user.create', 'user.edit'])}}">
    @can('manage_users')
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
    @endcan
    </li>


    <!-- Nav Item - Roles -->
  
    <li class="nav-item {{set_active(['roles.index', 'roles.show', 'roles.create', 'roles.edit'])}}">
    @can('manage_roles')
        <a class="nav-link" href="{{route('roles.index')}}">
            <i class="fas fa-fw fa-user-shield"></i>
            <span>Roles</span>
        </a>
    @endcan
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
