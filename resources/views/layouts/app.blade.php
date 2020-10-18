<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ARTchive')</title>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-red navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    ARTchive
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i style="color:white; padding:0;" class="fa fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Left Side Of Navbar --}}
                    <ul class="navbar-nav mr-auto">

                        {{-- About tab --}}
                        <li class="nav-item dropdown">
                             <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                About<span class="caret"></span>
                            </a>
                             <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                {{-- Dropdown Item: UAG Link --}}
                                <a class="dropdown-item" target=”_blank”
                                   href="https://www.svsu.edu/artgallery/">University Art Gallery</a>

                                 {{-- Dropdown Item: FAQ --}}
                                <a class="dropdown-item" href="{{ route('faq.show') }}">
                                    Frequently Asked Questions
                                </a>
                            </div>
                        </li>

                        {{-- View All Exhibits --}}
                        <a class="nav-link" href="{{ route('exhibit.index') }}">
                                Exhibits<span class="caret"></span>
                        </a>

                        {{-- View All Artwork --}}
                        <a class="nav-link" href="{{ route('artwork.index') }}">
                            Student Artwork<span class="caret"></span>
                        </a>
                    </ul>

                    {{-- Right Side Of Navbar --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- Authentication Links for GUESTS --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @else

                            {{-- ARCHIVIST dropdown --}}
                            @if (Auth::user()->isAuthorized("ARCHIVIST"))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Archivist<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- Dropdown Item: Upload Photos --}}
                                    <a class="dropdown-item" href="{{ route('archivist.index') }}">Upload Photos</a>
                                                                                    {{-- TODO: move this to exhibits page? --}}
                                </div>
                            </li>
                            @endcan

                            {{-- ADMIN dropdown --}}
                            @if (Auth::user()->isAuthorized("ADMIN"))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Admin<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- Dropdown Item: Manage Users --}}
                                    <a class="dropdown-item" href="{{ route('user.index') }}">Manage Users</a>

                                    {{-- Dropdown Item: Manage Exhibits --}}
                                    <a class="dropdown-item" href="{{ route('exhibit.adminIndex') }}">Manage Exhibits</a>
                                </div>
                            </li>
                            @endcan

                            {{-- USER Account dropdown --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Account<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- Dropdown Item: Information --}}
                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()) }}">Information</a>

                                    {{-- Dropdown Item: My Submissions --}}
                                    <a class="dropdown-item" href="{{ route('dashboard')}}">Submissions</a>

                                    {{-- Dropdown Item: Profile --}}
                                    <a class="dropdown-item" href="{{ route('profile.show', Auth::user()) }}">Public Profile</a>

                                    {{-- Dropdown Item: Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    {{-- Declare Logout Form --}}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="margin-top: 80px; margin-bottom: 50px;">
            @yield('content')
        </main>
    </div>
</body>
</html>
