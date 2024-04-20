{{-- @if ($errors->any())
    @foreach ($errors->all() as $error)

        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endforeach
@endif --}}

@if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{session()->get('message')}}
    </div>
@endif

@if(session()->has('warning'))
    <div class="alert alert-warning" role="alert">
        {{session()->get('warning')}}
    </div>
@endif

@if(session()->has('danger'))
    <div class="alert alert-danger" role="alert">
        {{session()->get('danger')}}
    </div>
@endif
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
