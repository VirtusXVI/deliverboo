<?php 
    $footerSocial = [
        [
            "social" => "Facebook",
        ],
        [
            "social" => "Instagram",
        ],
        [
            "social" => "Twitter",
        ]
    ]
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="front-office-layout">
        <header>
            <nav class="navbar navbar-expand-md navbar-light shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Deliveboo
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            {{-- @yield('navlinks') --}}
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li>
                                <a href="/" class="btn btn-home mr-3" style="color: white">Home</a>
                            </li>
                            <div id="navbarExampleTransparentExample" class="navbar-menu"> 
                                <div class="navbar-end">
                                    {{-- <cart-dropdown></cart-dropdown> --}}
                                </div>
                            </div>
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link login" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link register" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->restaurant_name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/admin">Sezione Admin</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
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
        </header>

        <main>
            @yield('content')
        </main>

        @include('sweetalert::alert')

        <footer>
            <div class="footer-content container">
                <h2>Deliveroo</h2>

                <div class="links">
                    {{-- Social --}}
                    <div class="social">
                        <div class="title">
                            <h3>Social</h3>
                        </div>
                        @foreach ($footerSocial as $list)
                            <li>
                                <a href="#"><span> {{$list['social']}}</span></a>
                            </li>
                        @endforeach
                    </div>

                    {{-- Contact --}}
                    <div class="contacts">
                        <div class="title">
                            <h3>Contatti</h3>
                        </div>
                        <div class="address">
                        <Span>Via XXXXXX, 17 - Italy</Span>
                        </div>
                        <div class="number">
                            <span>+39 xxxxxxxxx</span>
                        </div>
                        <div class="email">
                            <span>info@deliveroo.it</span>
                        </div>
                    </div>
                </div>

                {{-- Copy --}}
                <div class="copy">
                    <span>By Team Procas | Copyright &copy; 2022</span>
                </div>

            </div>
        </footer>
    </div>
</body>
</html>