@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Administrar Boulders de {{$spot->name}} en sector {{$zone->name}}</h1>
    <a href="{{route('zones.index', [$spot])}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <a href="{{route('boulders.create', [$spot, $zone])}}" class="yellow-button">Añadir Boulder</a>
    <div class="table-container">
        {{ $dataTable->table() }}
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
