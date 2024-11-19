@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado zone">
    <a href="{{ route('public.spot', $spot) }}"><h3><i class='bx bx-arrow-back'></i> {{ $spot->name }}</h3></a>
    <h1 class="section-title">Zona: {{ $zone->name }}</h1>

    <picture class="displayed-pic">
        <img loading="lazy" src="{{ Storage::disk('s3')->url('summithorns/summithorns/images/spots/zones/' . $zone->image) }}" alt="{{ $zone->image }} Imagen">
    </picture>

    <div class="zone-info">
        @if ($zone->details)
            <p>{{ $zone->details }}</p>
        @endif

        {{-- <div class="climbing-info">
            @if ($spot->climbingType->name === 'Deportiva')
                <div class="zones-info">
                    {{ $climbingRoutesDataTable->table() }}
                </div>
            @endif

            @if ($spot->climbingType->name === 'Boulder')
                <div class="zones-info">
                    {{ $bouldersDatatable->table() }}
                </div>
            @endif
        </div> --}}
        <div class="climbing-info">
            <div class="table-container">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
