@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Crear nuevo spot</h1>
    <a href="{{route('spots.index')}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{ route('spots.store') }}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf

        <label for="spot-name">Nombre Spot</label>
        <input id="spot-name" type="text" name="spot[name]">

        <label for="spot-climbing-type">Tipo de Escalada</label>
        <select id="spot-climbing-type" name="spot[climbing_type_id]">
            <option value="" selected disabled>-- Selecciona Uno --</option>
            @foreach ($climbingTypes as $climbingType)
                <option value="{{$climbingType->id}}">{{$climbingType->name}}</option>
            @endforeach
        </select>

        <label for="spot-image">Imagen del Spot</label>
        <input id="spot-image" type="file" name="spot[image]">

        <label for="spot_description">Descripción</label>
        <div id="spot_description"></div>
        <textarea name="spot[description]" id="spot_description_hidden" style="display: none;"></textarea>

        <label for="map">Ubicación del Spot</label>
        <input id="spot-address" type="text" placeholder="Ingresa una dirección">
        <div id="map"></div>
        <input type="hidden" name="spot[region]" id="region" value="">
        <input type="hidden" name="spot[latitude]" id="latitude" value="">
        <input type="hidden" name="spot[longitude]" id="longitude" value="">

        <div class="arriving-container">
            <div class="img-checker">
                <label for="bus"><img src="{{ Storage::disk('s3')->url('images/base/iconbus.svg') }}" alt="icono bus"></label>
                <input id="bus" type="checkbox" name="spot[bus]" value="1" class="arrival-image">
            </div>
            <div class="img-checker">
                <label for="car"><img src="{{ Storage::disk('s3')->url('images/base/iconcar.svg') }}" alt="icono auto"></label>
                <input id="car" type="checkbox" name="spot[car]" value="1" class="arrival-image">
            </div>
            <div class="img-checker">
                <label for="bike"><img src="{{ Storage::disk('s3')->url('images/base/iconobicicleta.svg') }}" alt="icono bici" class="arrival-image"></label>
                <input id="bike" type="checkbox" name="spot[bike]" value="1">
            </div>
        </div>

        <button type="submit" class="button blue-button ">Crear Spot</button>
    </form>
</main>
<script>
    const apiKey = "{{ env('MAPTILE_API_KEY') }}";
    // Inicializar el mapa
    const map = L.map('map').setView([-33.32777454592531, -70.6506], 7); // Vista inicial global

    // Agregar tiles de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    // Crear marcador arrastrable
    let marker = L.marker([-33.32777454592531, -70.6506], { draggable: true }).addTo(map);

    async function updateState(lat, lon) {
        try {
            const reverseResponse = await fetch(`https://api.maptiler.com/geocoding/${lon},${lat}.json?key=${apiKey}`);
            const reverseData = await reverseResponse.json();

            const region = reverseData.features.find(feature => feature.place_type.includes('region'))?.place_name || 'Ni las más puta idea';
            console.log(region);

            const municipality = reverseData.features.find(feature => feature.place_type.includes('municipality'))?.place_name || 'Ni las más puta idea';
            console.log(municipality);
            // Actualizar el campo oculto del estado
            document.getElementById('region').value = region;
        } catch (error) {
            console.error('Error al obtener el estado:', error);
        }
    }

    // Actualizar los valores de latitud y longitud cuando se mueva el marcador
    marker.on('dragend', function (e) {
        const coords = marker.getLatLng();
        document.getElementById('latitude').value = coords.lat;
        document.getElementById('longitude').value = coords.lng;

        updateState(coords.lat, coords.lng);
    });

    // Permitir que los usuarios hagan clic en el mapa para colocar el marcador
    map.on('click', function (e) {
        const coords = e.latlng;
        marker.setLatLng(coords);
        document.getElementById('latitude').value = coords.lat;
        document.getElementById('longitude').value = coords.lng;

        updateState(coords.lat, coords.lng);
    });

    const spotAddress = document.getElementById('spot-address');

    spotAddress.addEventListener('keydown', function(e) {
        if(e.key === 'Enter') {
            e.preventDefault();
        }
    });

    spotAddress.addEventListener('input', async function (e) {
        const query = e.target.value;
        if (query.length > 3) {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`);
            const data = await response.json();
            if (data.length > 0) {
                const { lat, lon } = data[0];
                map.setView([lat, lon], 14);
                marker.setLatLng([lat, lon]);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;

                updateState(lat, lon);
            }
        }
    });
</script>
@endsection
