@extends('layouts.app')

@section('content')

    <h1>Déposer un avis</h1>

    <form method="post" action="/addAvis" id="formAjouterAvis">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <input type="hidden" name="musique" value="{{ $musique }}" >
        <p>
            <label>Titre</label>
            <input type="text" name="titre">
        </p>
        <p>
            <label>Description</label><br>
            <textarea name="desc" cols="50" rows="5"></textarea>
        </p>
        <p>
            <label>Note</label>
            <select name="note">
                <option selected="selected" value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>
        </p>
        <p>
            <label></label>
            <input type="submit" value="Ajouter">
        </p>
    </form> 

@endsection
