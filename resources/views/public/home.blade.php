@extends('layouts.app')

@section('content')
<main class="contenedor seccion">
    <h1>Summit Horns</h1>
    <div class="us-icons">
        <div class="icon">
            <img src="{{ asset('images/base/iconcompass.svg') }}" alt="compass icon" loading="lazy">
            <h3>Ubicaciones</h3>
            <p>Encuentra los mejores spots de escalada para todos los niveles.</p>
        </div>
        <div class="icon">
            <img src="{{ asset('images/base/iconcarabiner.svg') }}" alt="carabiner icon" loading="lazy">
            <h3>Reseña de Equipos</h3>
            <p>Reseñas para mantenerte seguro, preparado e informado.</p>
        </div>
        <div class="icon">
            <img src="{{ asset('images/base/icontent.svg') }}" alt="tent icon" loading="lazy">
            <h3>Consejos Varios</h3>
            <p>Consejos útiles para mejorar tu escalada y cuidar el entorno.</p>
        </div>
    </div>
</main>

<section class="seccion contenedor">
    <h2 class="section-title">Spots de Escalada</h2>
    @include('public.spotslisting')
    <div class="alinear-derecha">
        <a href="{{route('public.spots')}}" class="blue-button">Ver todos los Spots</a>
    </div>
</section>

<section class="launchment-contact">
    <h2>Prepárate para la aventura</h2>
    <p>¿Quieres Colaborar con nosotros?</p>
    <a href="/contact" class="yellow-button">Únete al proyecto</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3><a class="section-title" href="{{route('public.blog')}}">Más Allá de las Cumbres</a></h3>
        @include('public.bloglisting')
    </section>
</div>
@endsection
