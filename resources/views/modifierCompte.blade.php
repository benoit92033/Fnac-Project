@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="margin-bottom:20px;"><h2>Modifier</h2><br>* Champs obligatoires</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/updateUser">
                            {{ csrf_field() }}
                        <fieldset class="form-gauche">

                            <div class="form-group{{ $errors->has('ach_nom') ? ' has-error' : '' }}">
                                <label for="ach_nom" class="col-md-4 control-label">Nom *</label>

                                <div class="col-md-6">
                                    <input id="ach_nom" min="2" type="text" class="form-control" name="ach_nom" value="{{$nom}}" required>

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
                                    <input id="ach_prenom" type="text" class="form-control" name="ach_prenom" value="{{$prenom}}" required >

                                    @if ($errors->has('ach_prenom'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ach_prenom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ach_telportable') ? ' has-error' : '' }}">
                                <label for="ach_telportable" custom="braaaaaaaa" class="col-md-4 control-label">Tél. Portable *</label>

                                <div class="col-md-6">
                                    <input id="ach_telportable" type="tel" class="form-control" name="ach_telportable" value="{{$telportable}}" required>

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
                                    <input id="ach_telfixe" type="tel" class="form-control" name="ach_telfixe" value="{{$telfixe}}">

                                    @if ($errors->has('ach_telfixe'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ach_telfixe') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                           <!-- <div class="form-group{{ $errors->has('ach_mel') ? ' has-error' : '' }}">
                                <label for="ach_mel" class="col-md-4 control-label">Adresse E-Mail *</label>

                                <div class="col-md-6">
                                    <input id="ach_mel" type="email" class="form-control" name="ach_mel" value="{{$email}}" required>

                                    @if ($errors->has('ach_mel'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ach_mel') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>-->

                            <div class="form-group{{ $errors->has('ach_motpasse') ? ' has-error' : '' }}">
                                <label for="ach_motpasse" class="col-md-4 control-label">Mot de passe *</label>

                                <div class="col-md-6">
                                    <input id="ach_motpasse" type="password" class="form-control" name="ach_motpasse" required>

                                    @if ($errors->has('ach_motpasse'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ach_motpasse') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="form-group{{ $errors->has('ach_newmotpasse') ? ' has-error' : '' }}">
                                <label for="ach_newmotpasse" class="col-md-4 control-label">Nouveau mot de passe</label>

                                <div class="col-md-6">
                                    <input id="ach_newmotpasse" type="password" class="form-control" name="ach_newmotpasse">

                                    @if ($errors->has('ach_newmotpasse'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ach_newmotpasse') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ach_newmotpasse-confirm" class="col-md-4 control-label">Confirmer le mot de passe</label>

                                <div class="col-md-6">
                                    <input id="ach_newmotpasse-confirm" type="password" class="form-control" name="ach_motpasse_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Modifier
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-droite">
                            <!-- -------------------------------------------------- -->
                            <div class="form-group{{ $errors->has('ach_adresse') ? ' has-error' : '' }}">
                                <label for="ach_adresse" class="col-md-4 control-label">Adresse *</label>

                                <div class="col-md-6">
                                    <input id="ach_adresse" type="text" class="form-control" name="ach_adresse" value="{{ $adr }}" required autofocus>

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
                                    <input id="ach_codePostal" type="text" class="form-control" name="ach_codePostal" value="{{ $cp }}" required autofocus>

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
                                    <input id="ach_ville" type="text" class="form-control" name="ach_ville" value="{{ $ville }}" required autofocus>

                                    @if ($errors->has('ach_ville'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ach_ville') }}</strong>
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


