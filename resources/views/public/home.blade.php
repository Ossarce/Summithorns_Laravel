@extends('layouts.app')

@section('content')
<main class="contenedor seccion">
    <h1>Summit Horns</h1>
    <div class="us-icons">
        <div class="icon">
            <a href="{{ route('public.spots') }}">
                <img src="{{ asset('images/base/iconcompass.svg') }}" alt="compass icon" loading="lazy">
                <h3>Ubicaciones</h3>
                <p>Encuentra los mejores spots de escalada para todos los niveles.</p>
            </a>
        </div>
        {{-- <div class="icon">
            <img src="{{ asset('images/base/iconcarabiner.svg') }}" alt="carabiner icon" loading="lazy">
            <h3>Reseña de Equipos</h3>
            <p>Reseñas para mantenerte seguro, preparado e informado.</p>
        </div> --}}
        <div class="icon">
            <a href="{{ route('public.blog') }}">
                <img src="{{ asset('images/base/icontent.svg') }}" alt="tent icon" loading="lazy">
                <h3>Consejos Varios</h3>
                <p>Consejos útiles para mejorar tu escalada y cuidar el entorno.</p>
            </a>
        </div>
    </div>
</main>

<section class="seccion contenedor">
    <h2 class="section-title">Spots de Escalada</h2>
    <div class="contenedor">
        <div id="map"></div>
    </div>
    <h3 class="section-title sub-title">Últimos Spots Agregados</h3>
    @include('public.spotslisting')
    <div class="alinear-derecha">
        <a href="{{route('public.spots')}}" class="blue-button">Ver todos los Spots</a>
    </div>
</section>

<section class="launchment-contact">
    <h2>Prepárate para la aventura</h2>
    <p>¿Quieres Colaborar con nosotros?</p>
    <a href="/contact" class="yellow-button">Únete al proyecto</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3><a class="section-title" href="{{route('public.blog')}}">Más Allá de las Cumbres</a></h3>
        @include('public.bloglisting')
        <div class="alinear-derecha">
            <a href="{{route('public.blog')}}" class="blue-button">Ir al Blog</a>
        </div>
    </section>
</div>
<script>

    const spots = @json($clusterSpots);
    console.log(spots);
    // Crear el mapa
    const map = L.map('map').setView([-33.4372, -70.6506], 4);

    // Agregar tiles de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    // Crear el grupo de clustersz
    const markers = L.markerClusterGroup();

    // Agregar los marcadores al cluster
    spots.forEach(spot => {
        let countInfo = "";
        if(spot.climbingTypeName === "Deportiva") {
            countInfo = `Rutas: ${spot.routesCount}`;
        } else if(spot.climbingTypeName === "Boulder") {
            countInfo = `Boulders: ${spot.bouldersCount}`;
        }
        let content =
            `<a href="${spot.url}" >
                <div class="marker-card">
                    <h4>${spot.name}</h4>
                    <p>${spot.climbingTypeName}</p>
                    <p>${countInfo}</p>
                </div>
            </a>`;
        const marker = L.marker([spot.latitude, spot.longitude]).bindPopup(content);
        markers.addLayer(marker);
    });

    // Agregar el grupo de clusters al mapa
    map.addLayer(markers);
</script>
@endsection
