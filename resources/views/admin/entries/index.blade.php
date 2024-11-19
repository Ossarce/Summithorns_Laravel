@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title" >Administración del Blog</h1>
    <a href="{{route('admin.panel')}}"><h3><i class='bx bx-arrow-back'></i> Volver al panel</h3></a>
    <a href="{{route('entries.create')}}" class="yellow-button">Crear Entrada</a>
    <div class="table-container">
        {{ $dataTable->table() }}
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
