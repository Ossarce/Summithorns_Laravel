@if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            notyf()->error($error);
        @endphp
    @endforeach
@endif

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{isset($title) ? "$title | Summit Horns" : "Summit Horns"}}</title>
        <link rel="icon" type="image/png" sizes="32x32" href="{{ Storage::disk('s3')->url('images/base/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Storage::disk('s3')->url('images/base/favicon/favicon-16x16.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ Storage::disk('s3')->url('images/base/favicon/apple-touch-icon.png') }}">
        <link rel="icon" sizes="192x192" href="{{ Storage::disk('s3')->url('images/base/favicon/android-chrome-192x192.png') }}">
        <link rel="icon" sizes="512x512" href="{{ Storage::disk('s3')->url('images/base/favicon/android-chrome-512x512.png') }}">
        <link rel="manifest" href="{{ Storage::disk('s3')->url('images/base/favicon/manifest.json') }}">
        @vite('resources/scss/app.scss')
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    </head>
    <body>
        <header class="header sticky {{ request()->is('/') ? 'inicio' : '' }}">
            <div class="contenedor contenido-header sticky-header">
                <div class="barra">
                    <a href="{{ route('public.home') }}">
                        <img class="logo-header" src="{{ Storage::disk('s3')->url('images/base/logo.svg')}}" alt="Logo Summit Horns">
                    </a>
                    <div class="mobile-menu">
                        <i class='bx bx-menu hamburger'></i>
                        {{-- <i class='bx bx-x close-hamburger hide-menu'></i> --}}
                    </div>
                    <nav class="nav-bar">
                        <a href="{{ route('public.spots') }}">Spots</a>
                        <a href="{{ route('public.blog') }}">Blog</a>
                        <a href="{{ route('public.contact') }}">Contacto</a>
                        <a href="{{ route('public.us') }}">Nosotros</a>
                        <div class="auth-container">
                            @auth
                                <a class="profile-link" href="{{ route('profile.index', ['id' => auth()->user()->id]) }}">
                                    <img src="{{ Storage::disk('s3')->url('/images/base/climb-person-people-climber-svgrepo-com-orange.svg')}}" alt="">
                                    {{ auth()->user()->username }}
                                </a>
                                <a class="auth-button sign-out" href="{{ route('logout') }}">Cerrar Sesión</a>
                            @else
                                <a class="auth-button" href="{{ route('login') }}">Inicia Sesión</a>
                                <a class="auth-button sign-up" href="{{ route('register') }}">Regístrate</a>
                            @endauth
                        </div>
                    </nav>
                </div>
                <div class="slogan-div">
                    @if (Request::is('/'))
                        <h2>Rutas Escaladas, Logros Compartidos</h2>
                    @endif
                </div>
            </div>
        </header>

        @yield('content')

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="nav-bar">
                    <a href="{{ route('public.spots') }}">Spots</a>
                    <a href="{{ route('public.blog') }}">Blog</a>
                    <a href="{{ route('public.contact') }}">Contacto</a>
                    <a href="{{ route('public.us') }}">Nosotros</a>
                </nav>
                <p class="copy">OSSVRC &copy;</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script>
            const isLoggedIn = {{ json_encode(Auth::check()) }};
        </script>
        @vite('resources/js/app.js')
    </body>
</html>
