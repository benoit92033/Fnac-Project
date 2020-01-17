@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:20px;"><h2>S'inscrire</h2><br>* Champs obligatoires</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                    <fieldset class="form-gauche">
                        <div class="form-group{{ $errors->has('ach_pseudo') ? ' has-error' : '' }}">
                            <label for="ach_pseudo" class="col-md-4 control-label">Pseudo *</label>

                            <div class="col-md-6">
                                <input id="ach_pseudo" type="text" class="form-control" name="ach_pseudo" value="{{ old('ach_pseudo') }}" required autofocus>

                                @if ($errors->has('ach_pseudo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_pseudo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_nom') ? ' has-error' : '' }}">
                            <label for="ach_nom" class="col-md-4 control-label">Nom *</label>

                            <div class="col-md-6">
                                <input id="ach_nom" min="2" type="text" class="form-control" name="ach_nom" value="{{ old('ach_nom') }}" required>

                                @if ($errors->has('ach_nom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_prenom') ? ' has-error' : '' }}">
                            <label for="ach_prenom" class="col-md-4 control-label">Prénom *</label>

                            <div class="col-md-6">
                                <input id="ach_prenom" type="text" class="form-control" name="ach_prenom" value="{{ old('ach_prenom') }}" required >

                                @if ($errors->has('ach_prenom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_prenom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_civilite') ? ' has-error' : '' }}">
                            <label for="ach_civilite"  class="col-md-4 control-label">Civilité  *</label>

                            <div class="col-md-6">
                                <div>
                                    <input type="radio" id="Monsieur" value="M." name="ach_civilite" checked>
                                    <label for="Monsieur">M.</label>
                                </div>
                                <div>
                                    <input type="radio" id="Mademoiselle" value="Mlle" name="ach_civilite">
                                    <label for="Mademoiselle">Mlle</label>                                    
                                </div>
                                <div>
                                    <input type="radio" id="Madame" value="Mme" name="ach_civilite">
                                    <label for="Madame">Mme</label>                                    
                                </div>

                                @if ($errors->has('ach_civilite'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_civilite') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_telportable') ? ' has-error' : '' }}">
                            <label for="ach_telportable" custom="braaaaaaaa" class="col-md-4 control-label">Tél. Portable *</label>

                            <div class="col-md-6">
                                <input id="ach_telportable" type="tel" class="form-control" name="ach_telportable" value="{{ old('ach_telportable') }}" required>

                                @if ($errors->has('ach_telportable'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_telportable') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_telfixe') ? ' has-error' : '' }}">
                            <label for="ach_telfixe" class="col-md-4 control-label">Tél. Fixe</label>

                            <div class="col-md-6">
                                <input id="ach_telfixe" type="tel" class="form-control" name="ach_telfixe" value="{{ old('ach_telfixe') }}">

                                @if ($errors->has('ach_telfixe'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_telfixe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_mel') ? ' has-error' : '' }}">
                            <label for="ach_mel" class="col-md-4 control-label">Adresse E-Mail *</label>

                            <div class="col-md-6">
                                <input id="ach_mel" type="email" class="form-control" name="ach_mel" value="{{ old('ach_mel') }}" required>

                                @if ($errors->has('ach_mel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_mel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group{{ $errors->has('ach_motpasse') ? ' has-error' : '' }}">
                            <label for="ach_motpasse" class="col-md-4 control-label">Mot de passe *</label>
                            <p>6 caractères mininum</p>

                            <div class="col-md-6">
                                <input id="ach_motpasse" type="password" class="form-control" name="ach_motpasse" required>

                                @if ($errors->has('ach_motpasse'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_motpasse') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ach_motpasse-confirm" class="col-md-4 control-label">Confirmer le mot de passe *</label>

                            <div class="col-md-6">
                                <input id="ach_motpasse-confirm" type="password" class="form-control" name="ach_motpasse_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    S'inscrire
                                </button>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-droite">
                        <!-- -------------------------------------------------- -->
                        <div class="form-group{{ $errors->has('ach_adresse') ? ' has-error' : '' }}">
                            <label for="ach_adresse" class="col-md-4 control-label">Adresse *</label>

                            <div class="col-md-6">
                                <input id="ach_adresse" type="text" class="form-control" name="ach_adresse" value="{{ old('ach_adresse') }}" required autofocus>

                                @if ($errors->has('ach_adresse'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_adresse') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_codePostal') ? ' has-error' : '' }}">
                            <label for="ach_codePostal" class="col-md-4 control-label">Code Postal *</label>

                            <div class="col-md-6">
                                <input id="ach_codePostal" type="text" class="form-control" name="ach_codePostal" value="{{ old('ach_codePostal') }}" required autofocus>

                                @if ($errors->has('ach_codePostal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_codePostal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ach_ville') ? ' has-error' : '' }}">
                            <label for="ach_ville" class="col-md-4 control-label">Ville *</label>

                            <div class="col-md-6">
                                <input id="ach_ville" type="text" class="form-control" name="ach_ville" value="{{ old('ach_ville') }}" required autofocus>

                                @if ($errors->has('ach_ville'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ach_ville') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mag_id') ? ' has-error' : '' }}">
                            <label for="mag_id" class="col-md-4 control-label">Magasin *</label>

                            <div class="col-md-6">
                                <select id="mag_id" name="mag_id" required>
                                    @foreach($Magasin as $mag)
                                        <option value="{{$mag->mag_id}}">{{$mag->mag_nom}}</option>
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('mag_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mag_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
