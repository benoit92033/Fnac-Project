@extends('layouts.app')

@section('content')
    <h1>Service communication</h1>
    <h1>Avis signalés :</h1>
    @foreach( $avisAbusif as $avis)
        <p>Signalé par : {{$avis["ach_pseudo"]}}</p>
        <div id="avis">
            <h2>{{ $avis["avi_titre"] }}</h2>
            <p style="font-size:12px;">Publiée le {{ $avis["avi_date"] }}</p>
            <p>{{ $avis["avi_detail"] }}</p>
            <p>Note : {{ $avis["avi_note"] }}/5</p>
            <form action="/delAvisAbusif" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="avis[]" value="{{$avis['avi_id']}}" />
                <input type="submit" name="delAvis" value="Supprimer cet avis" />
            </form>
        </div>
    @endforeach
@endsection
