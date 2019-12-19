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
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet"> 
</head>
<body>
<header>
    <div class="container">
<!--
        <a href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
-->
        <a href="{{ url('/') }}">
            <img src="{{ url('img/logo_blanc.png') }}" id="logo" alt="logo">
        </a>
        
    </div>
    
</header>
<!-- Authentication Links -->
    <nav>
    <ul>
        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li> Bonjour {{ Auth::user()->name }}</li>
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endguest
    </ul>
</nav>

<div id="main">
    <div class="container">
        @yield('content')
    </div>
   
</div>

@section('footer')
<footer>

</footer>
@endsection
<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
</body>
</html>