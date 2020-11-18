<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Notice') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    <div class="header">
        <div class="nav">
            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Войти</a>
                @endif

                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                @endif
            @else
                <a href="/profile/{{Auth::user()->id}}">{{ Auth::user()->name }}</a>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Выйти
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            @endguest
        </div>
    </div>
    <div class="container">
        <div class="row">
            <sidebar :auth="{{auth()->user() ? auth()->user() : 'false'}}"></sidebar>
            <router-view :auth="{{auth()->user() ? auth()->user() : 'false'}}"></router-view>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
