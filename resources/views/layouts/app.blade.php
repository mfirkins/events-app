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
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    #app {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #70afce, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 12s ease infinite;

    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    #navbar {
        background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
    }

    #profile-picture {
        height: 25px;
        width: auto;
    }
</style>

<body>
    <div id="app">
        <nav id="navbar" class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <img src="{{ asset('/storage/images/logo.svg') }}" alt="" width="30" height="24"
                        class="d-inline-block align-text-top">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/category/1">Free Events</a></li>
                                <li><a class="dropdown-item" href="/category/2">Musical Events</a></li>
                                <li><a class="dropdown-item" href="/category/3">Professional Talks</a></li>
                                <li><a class="dropdown-item" href="/category/4">18+ Events</a></li>
                                <li><a class="dropdown-item" href="/category/5">Online Events</a></li>
                                <li><a class="dropdown-item" href="/category/6">Sports</a></li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-contrast text-card-bg" href="{{ route('create_event') }}">+ Create an
                                Event</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <span class="navbar-text text-white">Hey there, {{ Auth::user()->name }}</span>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <img id="profile-picture" class="rounded"
                                        src={{ asset('storage/images/profile_pictures/' . Auth::user()->image_name) }} </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main id="main-div" class="py-1">
            <div id="content-div">
                @hasSection('page-name')
                    <h1 class="text-center text-white">@yield('page-name')</h1>
                @endif
                @yield('content')
            </div>
        </main>
        <footer class="text-center text-lg-start bg-light text-muted">
            <div id="navbar"class="text-center p-4 text-white">
                © 2022 Copyright:
                <a class="text-reset fw-bold" href="http://localhost">SuperEvent LTD, Morgan Firkins</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
</body>

</html>
