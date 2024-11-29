@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section title">Editar Zona</h1>
    <a href="{{route('zones.index', $spot)}}"class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{route('zones.update', [$spot, $zone])}}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf
        @method('PUT')

        <label for="zone-name">Nombre de la Zona</label>
        <input id="zone-name" type="text" name="zone[name]" value="{{$zone->name}}">

        <label for="zone-image">Imagen de la Zona</label>
        <input id="zone-image" type="file" name="zone[image]">
        @if ($zone->image)
            <img loading="lazy" src="{{ Storage::disk('s3')->url('summithorns/summithorns/images/spots/zones/' . $zone->image) }}" alt="{{ $zone->image }} Imagen">
        @endif

        <label for="zone_details">Detalles</label>
        <div id="zone_details"></div>
        <textarea name="zone[details]" id="zone_details_hidden" style="display: none;"></textarea>

        <button type="submit" class="button blue-button">Editar Zona</button>
    </form>
</main>
@endsection
