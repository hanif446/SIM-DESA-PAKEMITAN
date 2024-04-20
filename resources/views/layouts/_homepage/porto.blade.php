@php
    use App\Models\Galeri;
    // Mengambil semua data galeri
    $galeri = Galeri::orderBy('created_at', 'desc')->limit(6)->get(); 
    // Mengambil data galeri dengan jenis Wisata
    $galeri_wisata = Galeri::where('jenis_foto', 'Wisata')->orderBy('created_at', 'desc')->limit(6)->get(); 
    // Mengambil data galeri dengan jenis Kegiatan
    $galeri_kegiatan = Galeri::where('jenis_foto', 'Kegiatan')->orderBy('created_at', 'desc')->limit(6)->get(); 
    // Menggabungkan ketiga data menjadi satu
    $galeri_combined = $galeri->merge($galeri_wisata)->merge($galeri_kegiatan);
@endphp

<section id="portfolios" class="section">
    <!-- Container Starts -->
    <div class="container">
        <div class="section-header">          
            <h2 class="section-title">Gallery Kami</h2>
            <span>Gallery</span>
        </div>
        <div class="row">          
            <div class="col-md-12">
                <!-- Portfolio Controller/Buttons -->
                <div class="controls text-center">
                    <a class="filter active btn btn-common btn-effect" data-filter=".all">
                        All 
                    </a>
                    <a class="filter btn btn-common btn-effect" data-filter=".kegiatan">
                        Kegiatan
                    </a>
                    <a class="filter btn btn-common btn-effect" data-filter=".wisata">
                        Wisata
                    </a>
                </div>
                <!-- Portfolio Controller/Buttons Ends-->
            </div>
        </div>

        <!-- Portfolio Recent Projects -->
        <div id="portfolio" class="row portfolio-grid">
            @foreach($galeri_combined as $g)
                @php
                    $jenis_foto = strtolower($g->jenis_foto); // Mengonversi jenis foto menjadi huruf kecil
                @endphp
                <div class="col-lg-4 col-md-6 col-xs-12 mix all {{ $jenis_foto }}">
                    <div class="portfolio-item">
                        <div class="shot-item">
                            <img src="{{ asset('galeri/'.$g->foto) }}" alt="" style="width: 560px; height: 300px; object-fit: cover;"/>  
                            <div class="single-content">
                                <div class="fancy-table">
                                    <div class="table-cell">
                                        <div class="zoom-icon">
                                            <a class="lightbox" href="{{ asset('galeri/'.$g->foto) }}"><i class="lni-zoom-in item-icon"></i></a>
                                        </div>
                                        <a href="#">View Project</a>
                                    </div>
                                </div>
                            </div>
                        </div>               
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Container Ends -->
</section>

<!-- Tambahkan kode JavaScript untuk filter -->
<script>
    $(document).ready(function(){
        $('.filter').click(function(){
            var filterValue = $(this).attr('data-filter');
            console.log('Filter clicked:', filterValue);
            $('#portfolio .mix').hide();
            if(filterValue == 'all'){
                $('#portfolio .mix').show();
            } else {
                $('#portfolio .mix.' + filterValue).show();
            }
        });
    });
</script>
