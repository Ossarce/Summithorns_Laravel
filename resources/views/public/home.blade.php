@extends('layouts.app')

@section('content')
<main class="contenedor seccion">
    <h1>Summit Horns</h1>
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
</main>

<section class="seccion contenedor">
    <h2 class="section-title">Spots de Escalada</h2>
    <div class="contenedor-spots">
        @foreach ($spots as $spot)
        <div class="spot">
            <picture class="mini-pic">
                <img loading="lazy" src="{{ Storage::disk('s3')->url('images/spots/' . $spot->image) }}" alt="{{$spot->name}} Imagen">
            </picture>
            <div class="contenido-spot contenido-centrado">
                <div class="favorite-name-container">
                    <h3>{{$spot->name}}</h3>
                    {{-- <span class="like-icon <?php echo in_array($spot->id_spot, $favSpots) ? 'liked' : '' ?>" data-spot-id = "<?php echo $spot->id_spot ?>" ></span> --}}
                </div>
                <p>{{$spot->short_description}}</p>
                <ul class="guide-icons">
                    @if($spot->bus == '1')
                        <li>
                            <img loading="lazy" src="{{ Storage::disk('s3')->url('images/base/iconbus.svg') }}" alt="Ícono Bus">
                        </li>
                    @endif

                    @if($spot->car == '1')
                        <li>
                            <img loading="lazy" src="{{ Storage::disk('s3')->url('images/base/iconcar.svg') }}" alt="Ícono Auto">
                        </li>
                    @endif
                    @if($spot->bike == '1')
                        <li>
                            <img loading="lazy" src="{{ Storage::disk('s3')->url('images/base/iconobicicleta.svg') }}" alt="Ícono Bicicleta">
                        </li>
                    @endif
                </ul>
            </div>
            <a href="{{route('public.spot', $spot)}}" class="yellow-button-block-spot">Explorar</a>
        </div>
        @endforeach
    </div>
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

        <div class="contenedor seccion contenido-centrado" id="entries-container" data-current-page="1">
            @foreach($entries as $entry)
            <article class="blog-entry">
                <div class="imagen">
                    <img class="mini-pic" loading="lazy" src="{{ Storage::disk('s3')->url('images/blog/' . $entry->image) }}" alt="Imagen Entrada: {{$entry->title}}">
                </div>
                <div class="entry-text">
                <a class="entry-container" href="{{route('public.entry', $entry)}}"><h4>{{$entry->title}}</h4></a>
                    <div class="meta-info">
                        <p>Autor:<a href="#"><span>{{$entry->user->username}}</span></a></p>
                        <p class="date">Fecha: {{$entry->created_at->format('d-m-y')}}<span></span></p>
                        <p class="category"> <a href="#">#{{$entry->entryCategory->category_name}}</a></p>
                        <a class="entry-container" href="/entry?id=<?php echo $entry->id_entry ?>">
                        <p>{{$entry->short_description}}</a>
                    </div>
            </article>
            @endforeach
        </div>

    </section>
</div>
@endsection
