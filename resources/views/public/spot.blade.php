@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado">
    <div class="spot-head">
        <div class="favorite-name-container">
            <h1>{{$spot->name}}</h1>
            <span class="like-icon {{ $isFavorite ? 'liked' : '' }}" data-spot-id="{{ $spot->id }}"></span>
        </div>
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

    <picture class="displayed-pic">
        <img loading="lazy" src="{{Storage::disk('s3')->url('summithorns/summithorns/images/spots/'. $spot->image)}}" alt="{{$spot->name}} Imagen">
    </picture>


    <div class="spot-info">
        <div class="spot-data">
            <p>Zonas: {{ $spot->zones()->count() }}</p>
            @if ($spot->climbingType->name === 'Deportiva')
                <p>Vías: {{ $totalRoutes }}</p>
            @endif
            @if ($spot->climbingType->name === 'Boulder')
                <p> Boulders: {{ $totalBoulders }}</p>
            @endif
        </div>
        <p>{{$spot->description}}</p>
        <div class="table-container">
            {{ $dataTable->table() }}
        </div>
    </div>

    <div class="alinear-derecha spot-button">
        <a href="{{route('public.spots')}}" class="blue-button">Ver todos los spots</a>
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
