<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{URL::to('js/app1.js')}}"></script>
    <script src="{{URL::to('js/jquery.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Authentication Links -->
                    @guest
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                                </li>
                            @endif
                        </ul>
                            @else
                            <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        <li>
                            <h3>SCM Book Shop</h3>
                        </li>
                        @if(auth()->user()->type==1)
                        <li>
                            <a class="nav-link" href="/author/authorList">Author List<span class="sr-only">(current)</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="/genre/genreList">Genre List<span class="sr-only">(current)</span></a>
                        </li>
                        @endif
                        <li>
                            <a class="nav-link" href="/book/bookList" >Book List<span class="sr-only">(current)</span></a>
                        </li>
                        </ul>
                            <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                        @if(auth()->user()->type==0)
                        <li>
                        @if(Session::has('cart'))
                            @php $cart = Session::get('cart');  @endphp
                        <div class="panel-heading">{{ count($cart)}}</div>
                        @endif
                        </li>
                        <li>
                        <a class="nav-link" href="/cart/cartList" >Cart List<span class="sr-only">(current)</span></a>
                        </li>
                        @endif
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <a class="dropdown-item" href="/logout">

                                            {{ __('Logout') }}
                                        </a>


                                </li>
                            </ul>
                    @endguest

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
