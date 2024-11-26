@extends('layouts.app')

@section('content')
<main class="contenedor seccion">
    <h1 class="section-title">¡Ups! Página no encontrada</h1>
    <div class="container-error">
        <img src="{{ asset('images/base/404-logos_transparent.webp')}}">
        <div class="error-text">
            <p>La ruta de escalada que buscas no existe aquí. No te preocupes; incluso los mejores escaladores se desvían a veces.</p>
            <p>Volvamos a encaminarte:</p>
            <ul>
                <li>Regresa al <a href="{{route('public.home')}}">inicio</a> y comienza una nueva aventura.</li>
                <li>Explora todos los <a href="{{route('public.spots')}}">lugares de escalada</a> que tenemos para ti.</li>
                <li>O échale un vistazo a nuestro <a href="{{route('public.blog')}}">blog</a>.</li>
            </ul>
            <p>Recuerda, tanto en la escalada como en la navegación, lo importante es el viaje. ¡Buenos Pegues! 🏞️🧗‍♀️</p>
        </div>
    </div>
</main>
@endsection
