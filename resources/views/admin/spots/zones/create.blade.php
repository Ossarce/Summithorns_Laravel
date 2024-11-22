@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section title">Añadir Zona a {{$spot->name}}</h1>
    <a href="{{route('zones.index', $spot)}}"class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{route('zones.store', $spot)}}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf

        <label for="zone-name">Nombre de la zona</label>
        <input id="zone-name" type="text" name="zone[name]">

        <label for="zone-image">Imagen de la zona</label>
        <input id="zone-image" type="file" name="zone[image]">

        <label for="zone_details">Detalles</label>
        <div id="zone_details"></div>
        <textarea name="zone[details]" id="zone_details_hidden" style="display: none;"></textarea>

        <button type="submit" class="button blue-button">Añadir Zona</button>
    </form>
</main>
@endsection
