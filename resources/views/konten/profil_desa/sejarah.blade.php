@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_sejarah')}}
@endsection
@section('sejarah', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('sejarah.store') }}" method="POST">
                @csrf
                @if ($cek_data > 0)
                    <div class="form-group">
                        <label class="font-weight-bold">Sejarah Desa</label>
                        <textarea name="sejarah" id="sejarah" class="form-control @error('sejarah') is-invalid @enderror" rows="20" placeholder="Input Sejarah Desa">{{ old('sejarah', $sejarah->sejarah) }}</textarea>
                        @error('sejarah')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="float-right">
                        <button type="submit" class="btn btn-warning float-right px-3">
                            Ubah
                        </button>
                    </div>
                @else
                    <div class="form-group">
                        <label class="font-weight-bold">Sejarah Desa</label>
                        <textarea name="sejarah" id="sejarah" class="form-control @error('sejarah') is-invalid @enderror" rows="20" placeholder="Input Sejarah Desa">{{ old('sejarah') }}</textarea>
                        @error('sejarah')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-primary float-right px-3">
                            Simpan
                        </button>
                    </div>
                @endif
             </form>
          </div>
       </div>
    </div>
 </div>
 
@endsection

@push('javascript-external')
    <script src="{{ asset('template/vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('template/vendor/tinymce5/tinymce.min.js') }}"></script>
@endpush

@push('javascript-internal')
    <script>
        $(document).ready(function () {
            $("#sejarah").tinymce({
                relative_urls: false,
                language: "en",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table directionality",
                    "emoticons template paste textpattern",
                ],
                toolbar1: "fullscreen preview",
                toolbar2: "insertfile undo redo | styleselect | bold italic |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |"
            });
        });

    </script>
@endpush
