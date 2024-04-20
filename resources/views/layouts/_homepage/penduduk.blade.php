@php
    use App\Models\Penduduk;
    use App\Models\KK;

    $jumlahPenduduk = Penduduk::count();
    $jumlahKK = KK::count();
    $jumlahPendudukLaki = Penduduk::where('jk', '=', 'Laki-laki')->count();
    $jumlahPendudukPerempuan = Penduduk::where('jk', '=', 'Perempuan')->count();

@endphp

<div class="counters section bg-defult">
    <div class="container">
      <div class="row"> 
        <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="facts-item"> 
            <div class="icon">
              <i class="lni-users"></i>
            </div>                
            <div class="fact-count">
              <h3><span class="counter">{{ $jumlahPenduduk }}</span></h3>
              <h4>Jumlah Penduduk</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="lni-home"></i>
            </div>                
            <div class="fact-count">
              <h3><span class="counter">{{ $jumlahKK }}</span></h3>
              <h4>Jumlah KK</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="lni-user"></i>
            </div>                
            <div class="fact-count">
              <h3><span class="counter">{{ $jumlahPendudukLaki }}</span></h3>
              <h4>Jumlah Laki-Laki</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="lni-user"></i>
            </div>                
            <div class="fact-count">
              <h3><span class="counter">{{ $jumlahPendudukPerempuan}}</span></h3>
              <h4>Jumlah Perempuan</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>