@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado">
    <div class="spot-head">
        <div class="favorite-name-container">
            <h3>{{$spot->name}}</h3>
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
    <p class="spot-info">{{$spot->description}}</p>
    <div class="alinear-derecha">
        <a href="{{route('public.spots')}}" class="blue-button">View All Spots</a>
    </div>
</main>
@endsection
