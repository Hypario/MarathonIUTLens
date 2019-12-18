<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seeries - @yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<header class="header">
    <a href="{{ url('/') }}">
        {{ config('app.name', 'Seeries') }}
    </a>

<!-- Authentication Links -->
<nav>
    <ul>
        @guest
            <li><a href="{{ route('login') }}">Connexion</a></li>
            <li><a href="{{ route('register') }}">Inscription</a></li>
        @else
            <li> Bonjour <a href = {{ route('user.home') }}>{{ Auth::user()->name }}</a></li>
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Déconnexion
                </a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endguest
    </ul>
</nav>
</header>
<div id="main">
    @yield('content')
</div>

@section('footer')
<footer>

</footer>
@endsection
<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
</body>
</html>
