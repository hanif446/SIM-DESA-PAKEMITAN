@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">LETAK GEOGRAFIS DESA</div>
    </div>
    <div class="isi-data">
        @if ($geografis == null)
            <div class="konten">
                <label class="isi-konten">
                    Data Geografis Belum Tersedia. Mohon Maaf atas Ketidaknyamanannya.
                </label>
            </div>
        @else
            <div class="konten">
                <label class="isi-konten">
                    {!! $geografis->geografis !!}
                </label>
            </div>
        @endif
    </div>
@endsection