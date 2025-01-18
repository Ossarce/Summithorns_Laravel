@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Editar spot</h1>
    <a href="{{route('spots.index')}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{ route('spots.update', $spot->id) }}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf
        @method('PUT')

        <label for="spot-name">Nombre del Spot</label>
        <input id="spot-name" type="text" name="spot[name]" value="{{$spot->name}}">

        <label for="spot-climbing-type">Tipo de Escalada</label>
        <select for="spot-climbing-type" name="spot[climbing_type_id]">
            <option value="" disabled>-- Selecciona Uno</option>
            @foreach ($climbingTypes as $climbingType)
                <option value="{{$climbingType->id}}" {{$climbingType->id === $spot->climbing_type_id ? 'selected' : ''}}>{{$climbingType->name}}</option>
            @endforeach
        </select>

        <label for="spot-image">Imagen del Spot</label>
        <input id="spot-image" type="file" name="spot[image]">
        @if ($spot->image)
            <img src="{{ Storage::disk('s3')->url('summithorns/summithorns/images/spots/' . $spot->image)}}" alt="Imagen {{$spot->name}}">
        @endif

        <label for="spot_description">Descripción</label>
        <div id="spot_description"></div>
        <textarea name="spot[description]" id="spot_description_hidden" style="display: none;"></textarea>

        <label for="map">Ubicación del Spot</label>
        <input id="spot-address" type="text" placeholder="Ingresa una dirección">
        <div id="map"></div>
        <input type="hidden" name="spot[region]" id="region" value="{{$spot->region}}">
        <input type="hidden" name="spot[latitude]" id="latitude" value="{{$spot->latitude}}">
        <input type="hidden" name="spot[longitude]" id="longitude" value="{{$spot->longitude}}">

        <div class="arriving-container">
            <div class="img-checker">
                <label for="bus"><img src="{{ Storage::disk('s3')->url('images/base/iconbus.svg') }}" alt="icono bus"></label>
                <input id="bus" type="checkbox" name="spot[bus]" value="1" class="arrival-image" {{$spot->bus ? 'checked' : ''}}>
            </div>
            <div class="img-checker">
                <label for="car"><img src="{{ Storage::disk('s3')->url('images/base/iconcar.svg') }}" alt="icono auto"></label>
                <input id="car" type="checkbox" name="spot[car]" value="1" class="arrival-image" {{$spot->car ? 'checked' : ''}}>
            </div>
            <div class="img-checker">
                <label for="bike"><img src="{{ Storage::disk('s3')->url('images/base/iconobicicleta.svg') }}" alt="icono bici" class="arrival-image"></label>
                <input id="bike" type="checkbox" name="spot[bike]" value="1" {{$spot->bike ? 'checked' : ''}}>
            </div>
        </div>
        <button type="submit" class="button blue-button">Editar Spot</button>
    </form>
</main>

<script>
    const apiKey = "{{ env('MAPTILE_API_KEY') }}";
    const initialLat = parseFloat(document.getElementById('latitude').value);
    const initialLong = parseFloat(document.getElementById('longitude').value);
    console.log(initialLat, initialLong);
    // Inicializar el mapa
    const map = L.map('map').setView([initialLat, initialLong], 18); // Vista inicial global

    // Agregar tiles de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    // Crear marcador arrastrable
    let marker = L.marker([initialLat, initialLong], { draggable: true }).addTo(map);

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
