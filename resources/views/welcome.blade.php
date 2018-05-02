<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Styles -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/home.css">
        <script type="text/javascript" src="/js/home.js"></script>
        @yield('script')
        <!-- Styles -->
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            OPENSTACK
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li><a href="#">Info</a></li>
                            <li><a href="#">Stack</a></li>
                            <li><a href="{{ route('server-list') }}">Server</a></li>
                            <li><a href="#">Images</a></li>
                            <li><a href="#">Volume</a></li>
                            <li><a href="#">Flaror</a></li>
                            <li><a href="#">Network</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Đăng xuất</a>
                                <form id="logout-form" method="post" action="{{ route('logout') }}" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="menu-left">
                <ul class="menu">
                    <li class="item-memu">
                        <span class="tilte">Username: </span><b>{{ $data['name']}}</b>
                    </li>
                    <li class="item-memu">
                        <span class="tilte">Domain: </span><b>{{ $data['domain']['name']}}</b>
                    </li>
                    <li class="item-memu">
                        <span class="tilte">ID: </span><b>{{ $data['id']}}</b>
                    </li>
                </ul>
            </div>
         @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
