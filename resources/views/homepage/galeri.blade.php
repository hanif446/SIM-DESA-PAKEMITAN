@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">GALERI</div>
    </div>
    <div class="container" style="margin-top: 100px;margin-bottom: 100px;">
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
                            <img src="{{ asset('galeri/'.$g->foto) }}" alt="" style="width: 560px; height: 300px; object-fit: cover;margin-bottom: 50px;"/>  
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
@endsection
@push('javascript-internal')
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
@endpush