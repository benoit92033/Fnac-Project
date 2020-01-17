@extends('layouts.app')

@section('content')
    @if(count($results))
        @foreach ($results as $result)
            <div class="musique">
                <?php $path = 'storage/'.$result['mus_urlphoto'];?>
                <img src="{{URL::asset($path)}}" alt="" height="200" width="200">
                <h2>{{ $result["mus_titre"] }}</h2>
                <h2>{{ $result["mus_prixttc"] }}€</h2>
                <form method="post" action="/delFavori">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="musique" value="{{$result['mus_id']}}" />
                    <input type="submit" name="favori" value="Supprimer des Favoris" />
                </form>
            </div>
        @endforeach
    @else
        <p>Vous n'avez pas de favoris</p>
    @endif
@endsection
