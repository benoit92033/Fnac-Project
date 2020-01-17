@extends('layouts.app')

@section('content')

    <div id="monCompte">
        <li type = none>Nom : {{$nom}}</li>
        <li type = none>Prenom : {{$prenom}}</li>
        <li type = none>Email : {{$email}}</li>
        <li type = none>Pseudo : {{$pseudo}}</li>
        <li type = none>Civilité : {{$civilite}}</li>
        <li type = none>Telephone portable : {{$telportable}}</li>
        @if (isset($telfixe))
            <li type = none>Telephone fixe : {{$telfixe}}</li>
        @endif
        <li type = none>Votre magasin : {{$magasin[0]['mag_nom']}}</li>
        <li type = none>Votre point relais : {{$relais[0]['rel_nom']}} ( {{$relais[0]['rel_ville']}} )</li>
        <li type = none>Votre adresse : {{$adresse[0]['adr_rue']}} {{$adresse[0]['adr_cp']}} {{$adresse[0]['adr_ville']}}</li>
    </div>

    <div>
        <a href="/editCompte" id="modifier">Modifier</a>
    </div>

@endsection