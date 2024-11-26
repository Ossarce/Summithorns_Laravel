@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Administrar Vías de {{$spot->name}} en sector {{$zone->name}}</h1>
    <a href="{{route('zones.index', [$spot])}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <a href="{{route('routes.create', [$spot, $zone])}}" class="yellow-button">Añadir Vía</a>
    <div class="zone-image">
        <img src="{{ Storage::disk('s3')->url('summithorns/summithorns/images/spots/zones/' . $zone->image) }}" alt="{{ $zone->name }} Imagen">
    </div>
    <div class="table-container">
        {{ $dataTable->table() }}
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
