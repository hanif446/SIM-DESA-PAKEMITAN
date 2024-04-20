@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{ asset('template2/img/bg.png') }}" alt="Gambar">
        <div class="teks">PERANGKAT DESA</div>
    </div>
    <div class="isi-data">
        @if ($perangkat_desa->isEmpty())
            <div class="konten">
                <label class="isi-konten">
                    Data Perangkat Desa Belum Tersedia. Mohon Maaf atas Ketidaknyamanannya.
                </label>
            </div>
        @else
            <div class="kotak-gambar">
                @foreach ($perangkat_desa as $pegawai)
                    <div class="kotak-pegawai">
                        <img src="{{url('pegawai/'.$pegawai->foto)}}" alt="Gambar Pegawai">
                        <div class="keterangan">
                            <h3>{{ $pegawai->nama_pegawai }}</h3>
                            <p>{{ $pegawai->jabatan }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @if ($perangkat_desa->hasPages())
        <div class="isi-data">
            <div class="konten">
                <label class="isi-konten">
                    {{ $perangkat_desa->links('vendor.pagination.bootstrap-5') }}
                </label>
            </div>
        </div>
    @endif
@endsection
