<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{isset($title) ? "$title | Summit Horns" : "Summit Horns"}}</title>
        @vite('resources/scss/app.scss')
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="header sticky {{ request()->is('/') ? 'inicio' : '' }}">
            <div class="contenedor contenido-header sticky-header">
                <div class="barra">
                    <a href="{{ url('/') }}">
                        <img class="logo-header" src="{{asset('images/base/logo.svg')}}" alt="Logo Summit Horns">
                    </a>
                    <div class="mobile-menu">
                        <i class='bx bx-menu hamburger'></i>
                        <i class='bx bx-x close-hamburger hide-menu'></i>
                    </div>
                    <nav class="nav-bar">
                        <a href="{{ url('/us') }}">Us</a>
                        <a href="{{ url('/spots') }}">Spots</a>
                        <a href="{{ url('/blog') }}">Blog</a>
                        <a href="{{ url('/contact') }}">Contact</a>
                        <div class="auth-container">
                            @auth
                                <a class="profile-link" href="{{ url('/profile', ['id' => auth()->user()->id]) }}">
                                    <img src="{{asset('images/base/climb-person-people-climber-svgrepo-com-orange.svg')}}" alt="">
                                    {{ auth()->user()->username }}
                                </a>
                                <a class="auth-button sign-out" href="{{ route('logout') }}">Logout</a>
                            @else
                                <a class="auth-button" href="{{ route('login') }}">Log In</a>
                                <a class="auth-button sign-up" href="{{ route('register') }}">Sign Up</a>
                            @endauth
                        </div>
                    </nav>
                </div>
                <div class="slogan-div">
                    @if (Request::is('/'))
                        <h2>Pinnacles Explored, Triumphs Shared</h2>
                    @endif
                </div>
            </div>
        </header>

        @yield('content')

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="nav-bar">
                    <a href="{{ url('/us') }}">Us</a>
                    <a href="{{ url('/spots') }}">Spots</a>
                    <a href="{{ url('/blog') }}">Blog</a>
                    <a href="{{ url('/contact') }}">Contact</a>
                </nav>
                <p class="copy">OSSVRC &copy;</p>
            </div>
        </footer>

        <script>
            const isLoggedIn = {{ json_encode(Auth::check()) }};
        </script>
        @vite('resources/js/app.js')
    </body>
</html>
