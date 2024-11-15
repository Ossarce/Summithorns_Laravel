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

        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
    </head>
    <body>
        <div class="sidebar">
            <div class="top">
                <div class="logo">
                    <a href="{{ route('admin.panel') }}">
                        <img src="{{ Storage::disk('s3')->url('images/base/Summit Horns-logos_transparent_mini.webp') }}" alt="Mini Logo SummitHorns">
                    </a>
                </div>
                <i class='bx bx-menu sidebar-menu'></i>
            </div>
            <div class="admin">
                <img class="profile-pic" src="{{ $user->profile->avatar? Storage::disk('s3')->url('summithorns/summithorns/images/profiles/avatars/' . $user->profile->avatar) : Storage::disk('s3')->url('images/base/avatar-default.png') }}" alt="Avatar de {{ $user->username }}">
                <p>{{ $user->username }}</p>
            </div>
            <ul>
                <li>
                    <a href="{{ route('admin.panel') }}">
                        <i class='bx bxs-grid'></i>
                        <span class="nav-item">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="{{ route('spots.index') }}">
                        <i class='bx bxs-map'></i>
                        <span class="nav-item">Spots</span>
                    </a>
                    <span class="tooltip">Spots</span>
                </li>
                <li>
                    <a href="{{ route('entries.index') }}">
                        <i class='bx bxs-pencil'></i>
                        <span class="nav-item">Blog</span>
                    </a>
                    <span class="tooltip">Blog</span>
                </li>
                <li>
                    <a href="{{ route('public.home') }}">
                        <i class='bx bx-world' ></i>
                        <span class="nav-item">Check Website</span>
                    </a>
                    <span class="tooltip">Check Website</span>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-log-out' ></i>
                        <span class="nav-item">Logout</span>
                    </a>
                    <span class="tooltip">Logout</span>
                </li>
            </ul>
        </div>

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
        <script>
            const isLoggedIn = {{ json_encode(Auth::check()) }};
            // let entryDescription = '';
            // let spotDescription = '';
            // let zoneDescription = '';
            // <?php if (isset($entry)) : ?>
            //     entryDescription = <?php echo json_encode($entry->description); ?>;
            // <?php elseif (isset($spot)) : ?>
            //     spotDescription = <?php echo json_encode($spot->description) ?>;
            // <?php elseif (isset($zone)) : ?>;
            //     zoneDescription = <?php echo json_encode($zone->details) ?>;
            // <?php endif; ?>
        </script>
        {{-- <script src="/build/js/bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script> --}}
        @vite('resources/js/app.js')
    </body>
</html>
