@extends('layouts.app')

@section('content')
    <h2>Les musiques.</h2>

    <ul>
        @foreach ($musics as $music)
            <li>{{ $music->mus_titre }}</li>
        @endforeach
    </ul>
@endsection
