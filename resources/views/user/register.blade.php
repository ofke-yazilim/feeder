@extends('app')

@section('container')
    <h2>{{ $title??'' }}</h2>
    <form class="form-horizontal" action="{{ route('web.store') }}" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Adınız:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="name-{{time()}}" id="name" placeholder="İsminizi Giriniz." name="name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="surname">Surname:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="surname-{{time()}}" id="surname" placeholder="Şifre Giriniz" name="surname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" value="name-{{time()}}@okesmez.com" id="email" placeholder="Email Adresinizi Giriniz." name="email" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="gsm">Gsm:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="5554442312" id="gsm" placeholder="GSM Giriniz" name="gsm" maxlength="11" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="twitter_address">Twitter Adresiniz:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="https://twitter.com/{{ time() }}" id="twitter_address" placeholder="Şifre Giriniz" name="twitter_address" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Şifre:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" value="123456" id="password" placeholder="Şifre Giriniz" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                @csrf
                <button type="submit" class="btn btn-default">Kayıt</button>
            </div>
        </div>
    </form>
@endsection
