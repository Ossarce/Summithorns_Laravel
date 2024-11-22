@extends('layouts.admin')

@section('content')
<main class="seccion contenedor admin-content">
    <h1 class="section-title">Administración de Spots</h1>
    <a href="{{route('admin.panel')}}"><h3><i class='bx bx-arrow-back'></i> Volver al panel</h3></a>
    <a href="{{route('spots.create')}}" class="yellow-button">Crear Spot</a>
    <div class="table-container">
        {{ $dataTable->table() }}
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
