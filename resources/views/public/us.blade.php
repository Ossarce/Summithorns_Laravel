@extends('layouts.app')

@section('content')
<main class="contenedor seccion">
    <h1 class="section-title">Descubriendo Nuevos Horizontes: El porqué de Summit Horns</h1>
    <div class="us-content">
        <div class="image">
            <picture>
                {{-- <source src="{{asset('images/base/nosotros.webp')}}" type="image/webp">
                <source src="build/img/nosotros.jpg" type="image/jpg"> --}}
                <img loading="lazy" src="{{ asset('images/base/nosotros.webp') }}" alt="About Us Image">
            </picture >
            <blockquote>
                Comenzando un Camino para Mejorar las Experiencias de Escalada y Fortalecer la Comunidad
            </blockquote>
        </div>
        <div class="us-text">
            <p>La razón de este sitio es el afán de un grupo de amigos por documentar todos los lugares de escalada que podamos, de la manera que nos agrade tanto visual como funcionalmente. Buscamos crear un espacio donde los amantes de la escalada no se queden como meros observadores, sino que puedan aportar tanto en la sección de lugares como en el blog del sitio, compartiendo así sus saberes y experiencias.</p>

            <p>Te invitamos a ser parte activa de esta comunidad. Si tienes lugares que deseas documentar o historias que contar, ¡no dudes en colaborar con nosotros! Juntos, podemos enriquecer este espacio y hacer de Summit Horns un recurso valioso para todos los escaladores.</p>
        </div>
    </div>
</main>

{{-- <section class="contenedor seccion">
    <h2 class="section-title">Summit Horns</h2>
    <div class="us-icons">
        <div class="icon">
            <img src="{{ Storage::disk('s3')->url('images/base/iconcompass.svg') }}" alt="compass icon" loading="lazy">
            <h3>Ubicaciones</h3>
            <p>Encuentra los mejores spots de escalada para todos los niveles.</p>
        </div>
        <div class="icon">
            <img src="{{ Storage::disk('s3')->url('images/base/iconcarabiner.svg') }}" alt="carabiner icon" loading="lazy">
            <h3>Reseña de Equipos</h3>
            <p>Reseñas para mantenerte seguro, preparado e informado.</p>
        </div>
        <div class="icon">
            <img src="{{ Storage::disk('s3')->url('images/base/icontent.svg') }}" alt="tent icon" loading="lazy">
            <h3>Consejos Varios</h3>
            <p>Consejos útiles para mejorar tu escalada y cuidar el entorno.</p>
        </div>
    </div>
</section> --}}
@endsection
