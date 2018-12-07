<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('components/jquery/jquery.min.js') }}" ></script>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    
    <script src="{{ asset('components/handlebars/handlebars.js') }}" ></script>
    
    <!-- Scripts -->
    <script src="{{ asset('js/dashboard.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    
    <!-- Templates --> 
    @yield('template')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-global navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('dashboard.index') }}">DASHBOARD</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-user navbar-right" style="height:100%">
                    <li style="height:50px;">
                        <form style="height:100%;display:flex;align-items:center;"method="post" action="{{ route('dashboard.changeTheme') }}">
                            @csrf
                            <select name="theme" style="margin-right:10px;">
                                <option value="0" {{ Auth::user()->night_mode == 0 ? 'selected' : '' }}>Mode nuit automatique</option>
                                <option value="1" {{ Auth::user()->night_mode == 1 ? 'selected' : '' }}>Mode nuit on</option>
                                <option value="2" {{ Auth::user()->night_mode == 2 ? 'selected' : '' }}>Mode nuit off</option>
                            </select>
                            <input type="submit" value="Changer" />
                        </form>

                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
                </ul>
                </div><!--/.nav-collapse -->
            </div>
            </nav>
        <nav class="navbar-primary">
        <ul class="navbar-primary-menu">
            <li>
                <a href="#"><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Gestion Agent</span></a>
                <a href="#"><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Gestion Matériel</span></a>
                <a href="{{ route('dashboard.registerToken') }}"><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Génération token d'accès</span></a>
                <a href="{{ route('dashboard.alerts') }}"><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Message d'alerte</span></a>
            </li>
        </ul>
        </nav>
        <div class="main-content">
                @if (session('status'))
                     <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            @yield('content')
        </div>

    </div>
</body>
</html>

















