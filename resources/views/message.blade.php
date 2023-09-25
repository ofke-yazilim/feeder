<div class="bd-example">
    @if(session()->has('type'))
        @if(session()->get('type') == 'success')
            <div class="alert alert-success" role="alert">
                {!! session()->get('message') !!}
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
    @endif
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
    @endif
</div>
