@php
    use App\Models\Pegawai;
    $pegawai = Pegawai::all();
@endphp

<!-- testimonial Section Start -->
<div id="testimonial" class="section">
  <div class="container">
    <h3 class="text-center mb-5">Perangkat Desa</h3>
    <div class="row justify-content-md-center">
      <div class="col-md-10 wow fadeInRight" data-wow-delay="0.2s">
        <div class="touch-slider owl-carousel owl-theme">
          @if ($pegawai->count() > 0)
            @foreach($pegawai as $p)
            <div class="testimonial-item">
              <img src="{{ asset('pegawai/'.$p->foto) }}" alt="Foto Pegawai" />
              <div class="testimonial-text">
                <h3>{{ $p->nama_pegawai }}</h3>
                <span>{{ $p->jabatan }}</span>
              </div>
            </div>
            @endforeach
          @else
            <div class="testimonial-item">
              <p>Tidak ada data pegawai yang ditemukan.</p>
            </div>
          @endif
        </div>
      </div>
    </div>        
  </div>
</div>
<!-- testimonial Section End -->
