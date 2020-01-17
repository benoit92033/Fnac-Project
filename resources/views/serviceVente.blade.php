@extends('layouts.app')

@section('content')
    <h1>Service vente</h1>

    <h2>Ajouter un rayon.</h2>
    <form method="post" action="/ajouterRayon">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <p>
            <label>Nom</label>
            <input type="text" name="ajouterRayon">
        </p>
        @foreach ($musiques as $mus)
            <p>
                <input type="checkbox" value="{{$mus['mus_id']}}" name="musiques[]">
                <label>{{$mus['mus_titre']}}</label>
            </p>
        @endforeach
        <p>
            <label></label>
            <input type="submit" value="Ajouter un rayon">
        </p>
    </form>

    <h2>Ajouter une photo.</h2>
    <form id="search" method="post" enctype="multipart/form-data" action="/ajouterPhoto">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <p>
            <select name="musique" id="type" style="width:200px;">
                <option>-Sélectionner une musique-</option>
                @foreach ($musiques as $mus)
                        <option value="{{$mus['mus_id']}}">{{$mus['mus_titre']}}</option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="image">Sélectionner une photo :</label>
            <input type="file" name="image"/>
        </p>
        <p>
            <label></label>
            <input type="submit" value="Ajouter une photo">
        </p>
    </form>
    @if (isset($msg))
        <p>{{$msg}}</p>
    @endif
@endsection
