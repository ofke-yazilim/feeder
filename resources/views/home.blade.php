@extends('app')

@section('container')
    <h2>Feed Listesi</h2>
    <ul class="list-group">
        @foreach($twits as $twit)
            <li class="list-group-item">
                @if($twit->user)
                    <span>{{ $twit->user->name }}</span><br>
                @else
                    <span>Anonim</span><br>
                @endif
                <strong>{{ $twit->twitter_text }}</strong><br>
                <em>{{ $twit->created_at }}</em>
                @if($twit->user && Auth::check())
                    @if($twit->user->id == \Auth::user()->id && $twit->status == 1)
                        <a href="{{ route('web.twit.edit',['id'=>$twit->id]) }}" class="btn btn-primary">
                            Edit
                        </a>
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
    {{ $twits->onEachSide(5)->links('vendor.pagination.default') }}
@endsection
