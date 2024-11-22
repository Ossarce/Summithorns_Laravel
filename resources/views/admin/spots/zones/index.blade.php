@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Zonas de {{$spot->name}}</h1>
    <a href="{{route('spots.index')}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <a href="{{ route('zones.create', $spot) }}" class="yellow-button">Añadir Zona</a>
    <div class="table-container">
        {{ $dataTable->table() }}
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
