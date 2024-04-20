@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">SEJARAH DESA</div>
    </div>
    <div class="isi-data">
        @if ($sejarah == null)
            <div class="konten">
                <label class="isi-konten">
                    Data Sejarah Belum Tersedia. Mohon Maaf atas Ketidaknyamanannya.
                </label>
            </div>
        @else
            <div class="konten">
                <label class="isi-konten">
                    {!! $sejarah->sejarah !!}
                </label>
            </div>
        @endif
    </div>
@endsection