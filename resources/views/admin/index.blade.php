@extends('layouts.admin')

@section('content')

<main class="seccion contenedor admin-content">

<h1>Panel de Administración</h1>

<div class="contenedor seccion contenido-centrado">
    <div class="admin-card">
        <h3>Administrar Spots</h3>
        <a href="{{route('spots.index')}}"><p>Administrar Spots</p></a>
    </div>
    <div class="admin-card">
        <h3>Administrar blog</h3>
        <a href="{{route('entries.index')}}"><p>Administrar Blog</p></a>
    </div>
</div>

</main>

@endsection
