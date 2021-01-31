<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Bootstrap 5 -->    
    <link href="{{ asset('plugins/bootstrap5/bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/dataTables/dataTables.min.css') }}" rel="stylesheet">
    
    <!--Select 2 -->    
    <link href="{{asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!--Custom css -->    
    <link href="{{ asset('css/layouts/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Uniasselvi') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Auth::check()) 
                            @include('layouts.nav')
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Logar') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            {{-- <input type="hidden" id="ActionControl" value="{{ url('/') . '/' . Request::segment(1) . '/' . Request::segment(2) . '/' . Request::segment(3) }}"> --}}
            <input type="hidden" id="ActionControl" value="{{ url('/') . '/' . Request::segment(1) }}">

            @yield('content')
        </main>
    </div>
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery-3-5-1.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/dataTables.min.js') }}" defer></script>
	<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/bootstrap-5.min.js') }}"></script>

    <!-- Select 2 -->
	<script type="text/javascript" src="{{ URL::asset('plugins/select2/select2.min.js') }}"></script>

    <!-- Mask Jquery -->
	<script type="text/javascript" src="{{ URL::asset('plugins/maskJquery/jquery.mask.min.js') }}"></script>


    <!-- Custom js -->
	<script type="text/javascript" src="{{ URL::asset('js/layouts/app.js') }}"></script>
    @yield('js')

</body>
</html>
