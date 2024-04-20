@extends('layouts.homepage')

@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{ asset('template2/img/bg.png') }}" alt="Gambar">
        <div class="teks">DETAIL PENGUMUMAN</div>
    </div>
    <div class="isi-data konten isi-konten">
        <div class="card">
            <img src="{{ asset('pengumuman/'.$pengumuman->gambar) }}" class="card-img-top" alt="Gambar Pengumuman" style="max-height: 300px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center">{{ $pengumuman->judul }}</h5>
                <p class="card-text">{{ $pengumuman->isi_pengumuman }}</p>
                <p class="card-text"><strong><span><i class="fas fa-user"></i> Penerbit:</strong> {{ $pengumuman->penerbit }}</p>
                <p class="card-text"><strong><span><i class="far fa-calendar-alt"></i> Tanggal Buat:</strong> {{ date('d F Y', strtotime($pengumuman->created_at)) }}</p>
                <a style="margin-top: 20px" href="{{ route('homepage.pengumuman-desa') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
