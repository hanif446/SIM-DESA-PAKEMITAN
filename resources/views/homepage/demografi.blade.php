@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">DEMOGRAFI DESA</div>
    </div>
    <div class="isi-data">
        @if ($demografi == null)
            <div class="konten">
                <label class="isi-konten">
                    Data Demografi Belum Tersedia. Mohon Maaf atas Ketidaknyamanannya.
                </label>
            </div>
        @else
            <div class="konten">
                <label class="isi-konten">
                    {!! $demografi->demografi !!}
                </label>
            </div>
        @endif
    </div>
@endsection