@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">AGENDA KEGIATAN DESA</div>
    </div>
    <div class="isi-data">
        <div class="konten isi-konten">
            <table class="table" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
                <thead>
                    <tr style="border: 1px solid #ddd;">
                        <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">No</th>
                        <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">Judul</th>
                        <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">Deskripsi</th>
                        <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">Tanggal Kegiatan</th>
                        <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">Waktu Kegiatan</th>
                        <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">Tempat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agenda as $index => $item)
                        <tr style="border: 1px solid #ddd;">
                            <td style="padding: 8px; text-align: center; border: 1px solid #ddd;">{{ $index + 1 }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->judul }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->deskripsi }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->tgl_kegiatan }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->waktu_mulai }} s/d {{ $item->waktu_selesai }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->tempat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Tambahkan Pagination Links -->
            {{ $agenda->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
