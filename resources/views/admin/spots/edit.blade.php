@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Editar spot</h1>
    <a href="{{route('spots.index')}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{ route('spots.update', $spot->id) }}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf
        @method('PUT')

        <label for="spot-name">Nombre del Spot</label>
        <input id="spot-name" type="text" name="spot[name]" value="{{$spot->name}}">

        <label for="spot-climbing-type">Tipo de Escalada</label>
        <select for="spot-climbing-type" name="spot[climbing_type_id]">
            <option value="" disabled>-- Selecciona Uno</option>
            @foreach ($climbingTypes as $climbingType)
                <option value="{{$climbingType->id}}" {{$climbingType->id === $spot->climbing_type_id ? 'selected' : ''}}>{{$climbingType->name}}</option>
            @endforeach
        </select>

        <label for="spot-image">Imagen del Spot</label>
        <input id="spot-image" type="file" name="spot[image]">
        @if ($spot->image)
            <img src="{{ Storage::disk('s3')->url('summithorns/summithorns/images/spots/' . $spot->image)}}" alt="Imagen {{$spot->name}}">
        @endif

        <label for="spot_description">Descripción</label>
        <div id="spot_description"></div>
        <textarea name="spot[description]" id="spot_description_hidden" style="display: none;"></textarea>

        <div class="arriving-container">
            <div class="img-checker">
                <label for="bus"><img src="{{ Storage::disk('s3')->url('images/base/iconbus.svg') }}" alt="icono bus"></label>
                <input id="bus" type="checkbox" name="spot[bus]" value="1" class="arrival-image" {{$spot->bus ? 'checked' : ''}}>
            </div>
            <div class="img-checker">
                <label for="car"><img src="{{ Storage::disk('s3')->url('images/base/iconcar.svg') }}" alt="icono auto"></label>
                <input id="car" type="checkbox" name="spot[car]" value="1" class="arrival-image" {{$spot->car ? 'checked' : ''}}>
            </div>
            <div class="img-checker">
                <label for="bike"><img src="{{ Storage::disk('s3')->url('images/base/iconobicicleta.svg') }}" alt="icono bici" class="arrival-image"></label>
                <input id="bike" type="checkbox" name="spot[bike]" value="1" {{$spot->bike ? 'checked' : ''}}>
            </div>
        </div>
        <button type="submit" class="button blue-button">Editar Spot</button>
    </form>
</main>
@endsection
