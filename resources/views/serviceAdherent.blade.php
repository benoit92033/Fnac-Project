@extends('layouts.app')

@section('content')
    <h1>Service adhérents</h1>
    <h1>Commandes :</h1>
    @foreach( $commandes as $commande)
    <div id="commande">
        <h2>Commande n° : {{$commande["aca_id"]}}</h2>
        <p>Commandée par : {{$commande["ach_pseudo"]}}</p>
        <p>Commande passée le : {{$commande["aca_date"]}}</p>
        @if($commande['adr_rue'] != null)
            <p>Adresse : {{$commande['adr_rue']}} {{$commande['adr_cp']}} {{$commande['adr_ville']}}</p>
        @elseif($commande['rel_nom'] != null)
            <p>Point Relais : {{$commande["rel_nom"]}}</p>
        @elseif($commande['mag_nom'] != null)
            <p>Magasin : {{$commande['mag_nom']}}</p>
        @endif

        <h3>Articles : </h3>
        @foreach( $commande["lignesCommandes"] as $ligneCommande)
            <div id="commande">
                <p>Musique : {{$ligneCommande["mus_titre"]}}</p>
                <p>Quantité : {{$ligneCommande["lea_quantite"]}}</p>
            </div>
        @endforeach

        @if($commande['aca_preparee'] == true)
            <p>Commande préparée !</p>
        @else
            <form method="post" action="/serviceAdherent">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <input type="hidden" name="cmd" value="{{$commande['aca_id']}}" >
                <input type="submit" name="preparee" value="Préparer la commande"/>
            </form>
        @endif
    </div>
    @endforeach
@endsection
