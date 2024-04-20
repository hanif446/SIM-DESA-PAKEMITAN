@extends('layouts.homepage')
@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{asset('template2/img/bg.png')}}" alt="Gambar">
        <div class="teks">KONTAK DESA</div>
    </div>
    <div class="isi-data">
        @if ($kontak== null)
            <div class="konten">
                <label class="isi-konten">
                    Data Kontak Belum Tersedia. Mohon Maaf atas Ketidaknyamanannya.
                </label>
            </div>
        @else
            <div class="konten-maps">
                    <object style="border:0; height: 450px; width: 100%;" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63273.59939726374!2d108.17542480840957!3d-7.6184321186451625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65ef6586a9c2a1%3A0x3e8780cb95bd2b0f!2sPakemitan%2C%20Kec.%20Cikatomas%2C%20Kabupaten%20Tasikmalaya%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1713394887820!5m2!1sid!2sid"></object>
            </div>
            <div class="kontak">
                <div style="text-align: center;">
                    <b>Silahkan untuk hubungi kami jika ada yang kurang jelas : </b>
                </div>
                <table class="kontak-table">
                    <tr class="alamat">
                        <td><i class="fas fa-map-marker-alt"></i></td>
                        <td>Alamat : </td>
                        <td><span>{{ $kontak->alamat }}</span></td>
                    </tr>
                    <tr class="no-hp">
                        <td><i class="fas fa-phone-alt"></i></td>
                        <td>No HP : </td>
                        <td><span>{{ $kontak->no_hp }}</span></td>
                    </tr>
                    <tr class="email">
                        <td><i class="fas fa-envelope"></i></td>
                        <td>Email : </td>
                        <td><span>{{ $kontak->email }}</span></td>
                    </tr>
                </table>
            </div>            
        @endif
    </div>
@endsection