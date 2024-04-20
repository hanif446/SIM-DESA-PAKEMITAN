@extends('layouts.homepage')

@section('content')
    <div class="kotak">
        <img class="img-kotak" src="{{ asset('template2/img/bg.png') }}" alt="Gambar">
        <div class="teks">PENGADUAN MASYARAKAT</div>
    </div>
    <div class="isi-data konten isi-konten">
        <div class="row">          
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('homepage.pengaduan-store') }}" method="POST">
                    @csrf <!-- Add CSRF token -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="judul" placeholder="Judul" class="form-control" style="width: 100%;" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="7" style="width: 100%;" required></textarea>
                            </div>
                            <div class="submit-button">
                                <button class="btn btn-common btn-effect" id="submit" type="submit">Kirim Pesan</button>
                                <div id="msgSubmit" class="h3 hidden"></div> 
                                <div class="clearfix"></div> 
                            </div>
                        </div>
                    </div>            
                </form>
            </div>
        </div>
    </div>
@endsection
