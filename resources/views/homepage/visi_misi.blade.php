@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">VISI & MISI</div>
    </div>
    <div class="isi-data">
        @if ($visi_misi == null)
            <div class="konten">
                <label class="isi-konten">
                    Data Visi & Misi Belum Tersedia. Mohon Maaf atas Ketidaknyamanannya.
                </label>
            </div>
        @else
            <div class="visi">
                <p>Visi Desa Pakemitan</p>
                <label class="isi-visi">
                    {!! $visi_misi->visi !!}
                </label>
            </div>
            <div class="misi">
                <p>Misi Desa Pakemitan</p>
                <label class="isi-misi">
                    {!! $visi_misi->misi !!}
                </label>
            </div>
        @endif
    </div>
@endsection