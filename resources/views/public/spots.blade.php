@extends('layouts.app')

@section('content')
<main class="seccion contenedor">
    <h2 class="section-title">Spots de Escalada</h2>
    @include('public.spotslisting')
    <x-pagination :items="$spots" />
</main>
@endsection
