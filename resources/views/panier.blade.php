@extends('layouts.app')

@section('content')
    @if(count($results))
        <?php $prix = 0 ?>
        @foreach ($results as $result)
            <div class="musique">
                <?php $path = 'storage/'.$result['mus_urlphoto'];?>
                <img src="{{URL::asset($path)}}" alt="" height="100" width="100">
                <h4>{{ $result["mus_titre"] }}</h4>
                <h4>{{ $result["mus_prixttc"] }}€</h4>

                <form method="post" action="/delMusique">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="musique" value="{{$result['mus_id']}}" />
                    <input type="submit" name="panier" value="Supprimer du Panier" />
                </form>
                <div id="qte">
                    <p>Quantité :</p>
                    <form method="post" action="/panier">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="musique" value="{{$result['mus_id']}}" />
                        <input type="submit" name="moins" value="-">
                    </form>
                    <p>{{ $result["qte"] }}</p>
                    <form method="post" action="/panier">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="musique" value="{{$result['mus_id']}}" />
                        <input type="submit" name="plus" value="+">
                    </form>
                </div>
            </div>
            <?php $prix += $result["mus_prixttc"] ?>
        @endforeach
        <div class="musique">
            <h1>Total du Panier : {{$prix}} €</h1>
            <p>
                <form method="post" action="/commande">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" name="useless" value="Commander" />
                </form>
            </p>
            <p>
                <form method="post" action="/delAllPanier">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" name="useless" value="Annuler Panier" />
                </form>
            </p>
        </div>
    @else
        <p>Votre panier est vide</p>
    @endif
    @if(isset($messageCommande))
        <p>{{$messageCommande}}</p>
    @endif
@endsection
