  <nav class="navbar navbar-expand-md fixed-top scrolling-navbar bg-white">
    <div class="container">          
        <a class="navbar-brand" href="/">WEBISTE DESA PAKEMITAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 justify-content-end" id="navbarNav">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="/" data-target="beranda">Beranda</a>
                </li> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="profil">Profil Desa</a>
                    <div class="dropdown-menu" aria-labelledby="profilDropdown">
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
                    <a class="dropdown-item" href="{{ route('homepage.pengumuman-desa') }}">Pengumuman</a>
                    <a class="dropdown-item" href="{{ route('homepage.agenda-kegiatan-desa') }}">Agenda Kegiatan Desa</a>
                    <a class="dropdown-item" href="{{ route('homepage.galeri') }}">Galeri</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link page-scroll" href="{{ route('homepage.pengaduan-masyarakat') }}">Pengaduan Masyarakat</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link page-scroll" href="{{ route('homepage.kontak') }}">Kontak</a>
                </li>
            </ul>              
        </div>
    </div>
</nav>

@push('javascript-internal')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentUrl = window.location.href;
        let navItems = document.querySelectorAll('.navbar-nav .nav-item');

        navItems.forEach(function(item) {
            let navLink = item.querySelector('.nav-link');
            if (currentUrl.includes(navLink.getAttribute('href'))) {
                item.classList.add('active');
            }
        });
    });
</script>
@endpush


