@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">STRUKTUR ORGANISASI</div>
    </div>
    <div class="isi-data">
        @if ($struktur_organisasi == null)
            <div class="konten">
                <label class="isi-konten">
                    Data Struktur Organisasi Belum Tersedia. Mohon Maaf atas Ketidaknyamanannya.
                </label>
            </div>
        @else
            <div class="konten">
                <label class="isi-konten">
                    <img class="img-struktur-organisasi" src="{{url('struktur_organisasi/'.$struktur_organisasi->struktur_organisasi)}}">
                </label>
            </div>
        @endif
    </div>
@endsection