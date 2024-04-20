<nav class="navbar navbar-expand-md fixed-top scrolling-navbar bg-white">
    <div class="container">          
      <a class="navbar-brand" href="/">WEBISTE DESA PAKEMITAN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="lni-menu"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto w-100 justify-content-end">
          <li class="nav-item">
            <a class="nav-link page-scroll" href="/">Beranda</a>
          </li> 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Profil Desa
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('homepage.visi_misi') }}">Visi & Misi</a>
              <a class="dropdown-item" href="{{ route('homepage.sejarah') }}">Sejarah Desa</a>
              <a class="dropdown-item" href="{{ route('homepage.geografis') }}">Geografis Desa</a>
              <a class="dropdown-item" href="{{ route('homepage.demografi') }}">Demografi Desa</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Pemerintahan
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('homepage.struktur_organisasi') }}">Struktur Organisasi</a>
              <a class="dropdown-item" href="{{ route('homepage.perangkat_desa') }}">Perangkat Desa</a>
            </div>
          </li>   
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Informasi Publik
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Pengumuman</a>
              <a class="dropdown-item" href="#">Agenda Kegiatan Desa</a>
              <a class="dropdown-item" href="{{ route('homepage.galeri') }}">Galeri</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="">Pengaduan Masyarakat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="{{ route('homepage.kontak') }}">Kontak</a>
          </li> 
        </ul>              
      </div>
    </div>
  </nav>