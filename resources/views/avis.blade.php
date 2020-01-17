@extends('layouts.app')

@section('content')
    <h1>Avis</h1>
    <div class="musique">
        <?php $path = 'storage/'.$musique[0]['mus_urlphoto'];?>
        <img src="{{URL::asset($path)}}" alt="" height="200" width="200">
        <h2>{{ $musique[0]["mus_titre"] }}</p>
        <h2>{{ $musique[0]["mus_prixttc"] }}€</p>
    </div>

    <div>
        <form method="post" action="/avis">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            <input type="hidden" name="musique" value="{{$musique[0]['mus_id']}}" />
            <input type="submit" name="recents" value="Avis les plus récents" />
        </form>

        <form method="post" action="/avis">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            <input type="hidden" name="musique" value="{{$musique[0]['mus_id']}}" />
            <input type="submit" name="negatif" value="Avis négatifs" />
        </form>
    </div>

    @if ($noResult == false)
        @foreach($avis as $av)
            <div id="avis">
                <h2>{{ $av["avi_titre"] }}</h2>
                <p style="font-size:12px;">Publiée le {{ $av["avi_date"] }}</p>
                <p>{{ $av["avi_detail"] }}</p>
                <p>Note : {{ $av["avi_note"] }}/5</p>
                @if(auth()->check())
                    <p>Cet avis vous a été utile ?</p>
                    <form id="avisUtile" method="post" action="/avisUtileInutile">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="avisId" value="{{$av['avi_id']}}" />
                        <input type="hidden" name="nbAvisUtile" value="{{$av['avi_nbutileoui']}}" />
                        <input type="hidden" name="musique" value="{{$av['mus_id']}}" />
                        <input type="submit" name="avisUtile" value="Oui ({{ $av['avi_nbutileoui'] }})" />
                    </form> 
                    <form id="avisInutile" method="post" action="/avisUtileInutile">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="avisId" value="{{$av['avi_id']}}" />
                        <input type="hidden" name="nbAvisInutile" value="{{$av['avi_nbutilenon']}}" />
                        <input type="hidden" name="musique" value="{{$av['mus_id']}}" />
                        <input type="submit" name="avisInutile" value=" Non ({{ $av['avi_nbutilenon'] }})" />
                    </form>

                    <?php $test = false; ?>
                    @foreach($avisDejaSignaler as $avis)
                        @if ($av["avi_id"] == $avis)
                            <?php $test = true; ?>
                        @endif
                    @endforeach
                    @if ($test == false)
                        <form method="post" action="/avisAbusif">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                            <input type="hidden" name="avisId" value="{{$av['avi_id']}}" />
                            <input type="hidden" name="musique" value="{{$av['mus_id']}}" />
                            <input type="submit" name="signaler" value="Signaler" />
                        </form>
                    @endif
                @else
                    <p>Avis Utile : {{ $av['avi_nbutileoui'] }}</p>
                    <p>Avis Inutile : {{ $av['avi_nbutilenon'] }}</p>
                @endif
            </div>
        @endforeach
    @else
        <p>Aucun avis</p>
    @endif

@endsection
