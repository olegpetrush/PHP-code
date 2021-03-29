<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{--
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    --}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 py-lg-4">
            <div class="container">
                <a class="navbar-brand font-bold" href="#">Logo</a>
                <div class="search d-lg-none ml-auto mr-4">
                    <img src="{{asset('images/search.svg')}}" alt="">
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample07">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Find Products</a>
                        </li>
                        {{--
                        <li class="nav-item">
                            <a class="nav-link" href="#">Feature</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        --}}
                    </ul>
                    <div class="search d-none d-lg-block mr-lg-4" style="visibility: hidden">
                        <span class="d-inline mr-lg-3">Search</span>
                        <img src="{{asset('images/search.svg')}}" alt="">
                    </div>
                    {{--
                    <div class="cta" style="display: none">

                    @if (Route::has('login'))
                            @auth
                                    <a class="login" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            @else
                                <a class="login" href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a class="signup" href="{{ route('register') }}">Sign Up</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                    --}}
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('after_scripts')
</body>
</html>
