@extends('layouts.homepage')

@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{ asset('template2/img/bg.png') }}" alt="Gambar">
        <div class="teks">PENGUMUMAN</div>
    </div>
    <div class="isi-data konten isi-konten">
        <div class="row">
            @if ($pengumuman->isEmpty())
                <div class="col-md-12">
                    <p class="text-center">Tidak ada pengumuman yang tersedia saat ini.</p>
                </div>
            @else
                @foreach ($pengumuman as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('pengumuman/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="max-height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 1.1rem;">{{ $item->judul }}</h5>
                                <p class="card-text" style="font-size: 0.9rem;">
                                    <span><i class="fas fa-user"></i> Penerbit: {{ $item->penerbit }}</span><br>
                                    <span><i class="far fa-calendar-alt"></i> Tanggal: {{ date('d F Y', strtotime($item->created_at)) }}</span>
                                </p>
                                <a style="margin-top: 20px" href="{{ route('homepage.pengumuman-detail', $item->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
