@extends('layouts.app')

@section('content')
    <h1>Rechercher</h1>

    @foreach ($rayons as $rayon)
        <form method="post" action="/searchResult" id="rayons">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            <input type="submit" name="rayon" value="{{ $rayon['ray_nom'] }}" />
        </form> 
    @endforeach

    <form id="search" method="post" action="/searchResult">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <p>
            <label></label>
            <input type="text" name="recherche">
        </p>
        <p>
            <label></label>
            <input type="submit" value="Recherche par interprète">
        </p>
    </form> 
    <form method="post" action="/searchResult" id="search">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <p>
            <select name="genre" id="type">
                <option>-Sélectionner un genre-</option>
                @foreach ($genres as $genre)
                    @if($genreSelect == $genre["gen_libelle"])
                        <option selected="selected" value="{{$genre['gen_libelle']}}">{{$genre["gen_libelle"]}}</option>
                    @else
                        <option value="{{$genre['gen_libelle']}}">{{$genre["gen_libelle"]}}</option>
                    @endif
                @endforeach
            </select>
        </p>
        <p>
            <label></label>
            <input type="submit" value="Recherche par genre">
        </p>
    </form> 

        @if (isset($results))
            @foreach ($results as $result)
                <div class="musique">
                    <?php $path = 'storage/'.$result['mus_urlphoto'];?>
                    <img src="{{URL::asset($path)}}" alt="" height="200" width="200">
                    <h2>{{ $result["mus_titre"] }}</h2>
                    <h2>{{ $result["mus_prixttc"] }}€</h2>
                    <p>
                        <?php $existAvis = false; ?>
                        @foreach ($avis as $as)
                            @if ($as['mus_id'] == $result['mus_id'])
                                <?php $existAvis = true; ?>
                            @endif
                        @endforeach
                        @if ($existAvis == true)
                            <form method="post" action="/avis">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="musique" value="{{$result['mus_id']}}" />
                                <input type="submit" name="avis" value="Consulter les Avis" />
                            </form>
                        @else
                            <p>Aucun avis pour ce produit</p>
                        @endif
                    </p>
                    @if (auth()->check())
                        <p>
                            <?php $fav = false; ?>
                            @foreach ($favoris as $favori)
                                @if ($favori['mus_id'] == $result['mus_id'])
                                    <?php $fav = true; ?>
                                @endif
                            @endforeach
                            @if ($fav == false)
                                <form method="post" action="/addFavori">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="musique[]" value="{{$result['mus_id']}}" />
                                    <input type="submit" name="favori" value="Ajouter aux favoris" />
                                </form>
                            @endif
                        </p>

                        <p>
                            <?php $pan = false; ?>
                            @foreach ($panier as $musPanier)
                                @if ($musPanier['mus_id'] == $result['mus_id'])
                                    <?php $pan = true; ?>
                                @endif
                            @endforeach
                            @if ($pan == false)
                                <form method="post" action="/addPanier">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="musique[]" value="{{$result['mus_id']}}" />
                                    <input type="submit" name="panier" value="Ajouter au Panier" />
                                </form>
                            @endif
                        </p>

                        <p>
                            <?php $aca = false; ?>
                            @foreach ($musiquesAchetee as $mus)
                                @if ($mus['mus_id'] == $result['mus_id'])
                                    <?php $aca = true; ?>
                                @endif
                            @endforeach
                            <?php $dep = false; ?>
                            @foreach ($avisDeposes as $av)
                                @if ($av['mus_id'] == $result['mus_id'])
                                    <?php $dep = true; ?>
                                @endif
                            @endforeach
                            @if ($aca == true && $dep == false)
                                <form method="post" action="/formAddAvis">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="musique" value="{{$result['mus_id']}}" />
                                    <input type="submit" name="panier" value="Déposer un avis" />
                                </form>
                            @endif
                        </p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (isset($noResults))
            <p>Aucun résultat pour "{{ $noResults }}"</p>
        @endif
@endsection
