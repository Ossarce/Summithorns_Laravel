@extends('layouts.app')

@section('content')
<main class="seccion contenedor contenido-centrado">
    <h2 class="section-title">Más allá de las Cumbres</h2>
    @include('public.bloglisting')
    <x-pagination :items="$entries" />
</main>

@endsection
