@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_demografi')}}
@endsection
@section('demografi', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('demografi.store') }}" method="POST">
                @csrf
                @if ($cek_data > 0)
                    <div class="form-group">
                        <label class="font-weight-bold">Demografi Desa</label>
                        <textarea name="demografi" id="demografi" class="form-control @error('demografi') is-invalid @enderror" rows="20" placeholder="Input Demografi Desa">{{ old('demografi', $demografi->demografi) }}</textarea>
                        @error('demografi')
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
                        <label class="font-weight-bold">Demografi Desa</label>
                        <textarea name="demografi" id="demografi" class="form-control @error('demografi') is-invalid @enderror" rows="20" placeholder="Input Demografi Desa">{{ old('demografi') }}</textarea>
                        @error('demografi')
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
            $("#demografi").tinymce({
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
