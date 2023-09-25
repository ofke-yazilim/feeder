@extends('app')

@section('container')
    <h2>{{ $title??'' }}</h2>
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Adınız:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ \Auth::user()->name }}" id="name" placeholder="İsminizi Adresinizi Giriniz." name="name" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="surname">Surname:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ \Auth::user()->surname }}" id="surname" placeholder="Şifre Giriniz" name="surname" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" value="{{ \Auth::user()->email }}" id="email" placeholder="Email Adresinizi Giriniz." name="email" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="gsm">Gsm:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ \Auth::user()->gsm }}" id="gsm" placeholder="GSM Giriniz" name="gsm" maxlength="11" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="twitter_address">Twitter Adresiniz:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ \Auth::user()->twitter_address }}" id="twitter_address" placeholder="Şifre Giriniz" name="twitter_address" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="validate_link">Validation Link:</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="validate_link" name="validate_link" rows="4" >{{ \env('APP_URL').'/validate?validate_token='.Auth::user()->validate_token.'&email='.Auth::user()->email }}</textarea>
        </div>
    </div>

@endsection
