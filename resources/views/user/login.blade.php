@extends('app')

@section('container')
    <h2>{{ $title }}</h2>
    <form class="form-horizontal" action="{{ route('web.login.post') }}" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Email Adresinizi Giriniz." name="email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Şifre:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Şifre Giriniz" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                @csrf
                <button type="submit" class="btn btn-default">Giriş</button>
            </div>
        </div>
    </form>
@endsection
