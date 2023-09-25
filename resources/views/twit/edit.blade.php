@extends('app')

@section('container')
    <h2>{{ $title??'' }}</h2>
    <form class="form-horizontal" action="{{ route('web.twit.update',['id'=>$twit->id]) }}" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2" for="twitter_title">Title:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $twit->twitter_title }}" id="twitter_title" placeholder="Fill Title" name="twitter_title" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="twitter_text">Text:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="twitter_text" name="twitter_text" rows="4" required>{{$twit->twitter_text}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                @csrf
                <button type="submit" class="btn btn-default">Publish</button>
            </div>
        </div>
    </form>
@endsection
