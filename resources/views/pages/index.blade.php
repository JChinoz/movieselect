@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Movies Currently Selected</h1>
        @foreach ($response->Search as $item)
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <img src="{{$item->Poster}}" alt="">
                </div>
                <div class="col-8">
                    <h2>{{$item->Title}}</h2>
                    <h3>{{$item->Year}}</h3>
                    @if (!Auth::guest())
                        @php
                        $disabledFlag = 0;    
                        @endphp
                        @foreach ($like as $li)
                            @if ($item->imdbID == $li->movieId && $li->user_id == Auth::user()->id && $li->likeFlag == 1)
                                <button class="btn btn-primary" disabled>Like</button>
                                @php
                                    $disabledFlag = 1;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if ($disabledFlag == 0)
                            {!! Form::open(['action' => ['LikeController@update', $item->imdbID], 'method' => 'POST']) !!}
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Like', ['class' => 'btn btn-primary'])}}
                            {!! Form::close() !!}
                        @endif
                        {!! Form::open(['action' => ['LikeController@destroy', $item->imdbID], 'method' => 'POST']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Unlike', ['class' => 'btn btn-danger'])}}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        {{$like}}
    </div>
@endsection