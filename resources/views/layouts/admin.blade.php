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
        {{-- Boxicons Icons --}}
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        {{-- DataTables JS & CSS --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        {{-- Quill JS --}}
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        {{-- Notyf & SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
        {{-- Leafleet Map --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    </head>
    <body>
        <div class="sidebar">
            <div class="top">
                <div class="logo">
                    <a href="{{ route('admin.panel') }}">
                        <img src="{{ asset('images/base/Summit Horns-logos_transparent_mini.webp') }}" alt="Mini Logo SummitHorns">
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
                        <span class="nav-item">Menu Principal</span>
                    </a>
                    {{-- <span class="tooltip">Menu Principal</span> --}}
                </li>
                <li>
                    <a href="{{ route('spots.index') }}">
                        <i class='bx bxs-map'></i>
                        <span class="nav-item">Spots</span>
                    </a>
                    {{-- <span class="tooltip">Spots</span> --}}
                </li>
                <li>
                    <a href="{{ route('entries.index') }}">
                        <i class='bx bxs-pencil'></i>
                        <span class="nav-item">Blog</span>
                    </a>
                    {{-- <span class="tooltip">Blog</span> --}}
                </li>
                <li>
                    <a href="{{ route('public.home') }}" target="_blank">
                        <i class='bx bx-world' ></i>
                        <span class="nav-item">Revisar Sitio</span>
                    </a>
                    {{-- <span class="tooltip">Check Website</span> --}}
                </li>
                <li>
                    <a class="sign-out" href="{{ route('logout') }}">
                        <i class='bx bx-log-out' ></i>
                        <span class="nav-item">Cerrar Sesión</span>
                    </a>
                    {{-- <span class="tooltip">Logout</span> --}}
                </li>
            </ul>
        </div>

        @yield('content')

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="nav-bar">
                    <a href="{{ route('admin.panel') }}">Dashboard</a>
                    <a href="{{ route('spots.index') }}">Spots</a>
                    <a href="{{ route('entries.index') }}">Blog</a>
                    <a href="{{ route('public.home') }}">Summit Horns</a>
                </nav>
                <p class="copy">OSSVRC &copy;</p>
            </div>
        </footer>
        <script>
            const isLoggedIn = {{ json_encode(Auth::check()) }};
            let entryDescription = '';
            let spotDescription = '';
            let zoneDetails = '';

            @if (isset($entry))
                entryDescription = {!! json_encode($entry->description) !!};
            @endif
            @if (isset($spot))
                spotDescription = {!! json_encode($spot->description) !!};
            @endif
            @if (isset($zone))
                zoneDetails = {!! json_encode($zone->details) !!};
            @endif
        </script>
        <script>
             $(document).ready(function() {
                $('body').on('click', '.delete-item', function(e) {
                    e.preventDefault();
                    let deleteUrl = $(this).attr('href');

                    Swal.fire({
                        title: "Estás Seguro?",
                        text: "No podrás deshacer esta acción!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí Borralo!",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: deleteUrl,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    if(data.status == 'success') {
                                        Swal.fire({
                                            title: "Borrado!",
                                            text: "Se ha borrado con éxito",
                                            icon: "success",
                                        })
                                        $(e.target).closest('.dataTable').DataTable().draw();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            })
                        }
                    });
                })
            })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        @vite('resources/js/app.js')
    </body>
</html>
