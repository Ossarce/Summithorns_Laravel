@extends('layouts.admin')

@section('content')

<main class="seccion contenedor admin-content">

<h1>Panel de Administración</h1>

<div class="contenedor seccion contenido-centrado">
    <div class="admin-card">
        <img src="{{ asset('images/base/spot-admin-card.webp') }}" alt="Imagen Administración Spots">
        <a href="{{route('spots.index')}}"><p>Administrar Spots</p></a>
    </div>
    <div class="admin-card">
        <img src="{{ asset('images/base/blog-admin-card.webp') }}" alt="Imagen Administración Blog">
        <a href="{{route('entries.index')}}"><p>Administrar Blog</p></a>
    </div>
</div>

</main>

@endsection
