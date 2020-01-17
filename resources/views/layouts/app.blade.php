<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FNAC') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/isadmin') }}">
                        <img src="/logoFnac.png" alt="">
                        <!--{{ config('app.name', 'FNAC') }}-->
                    </a>

                    @guest
                        <li type=none class='droite'><a href="{{ route('register') }}">S'inscrire</a></li>
                        <li type=none class='droite'><a href="{{ route('login') }}">Connexion</a></li>
                    @else
                        <li type=none class='droite'>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Se déconnecter
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endguest

                    @if (auth()->check())
                        <li type=none class='droite'><a href="/MonCompte">Mon compte</a></li> 
                        <li type=none class='droite'><a href="/favoris">Mes favoris</a></li>
                        <li type=none class='droite'><a href="/panier">Mon Panier</a></li>        
                    @endif
                </div>
            </div>
        </nav>
       
        @yield('content')
        
    </div>
 
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>