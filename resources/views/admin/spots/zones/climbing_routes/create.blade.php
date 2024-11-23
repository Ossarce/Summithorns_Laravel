@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Añadir Nueva Vía</h1>
    <a href="{{route('routes.index', [$spot, $zone])}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{route('routes.store', [$spot, $zone])}}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf
        <label for="route-name">Nombre de la Vía</label>
        <input id="route-name" type="text" name="route[name]">

        <label for="route-grade">Grado</label>
        <select id="route-grade" name="route[grade]">
            <option value="" selected disabled>-- Seleccione Uno --</option>
            @foreach ($routeGrades as $routeGrade)
                <option value="{{$routeGrade->id}}">{{$routeGrade->route_grade}}</option>
            @endforeach
        </select>

        {{-- <label for="route-image">Imagen de la Vía <span>(opcional)</span></label>
        <input id="route-image" type="file" name="route[image]"> --}}

        {{-- <label for="boulder-image">Abridor <span>(comunicarse con soporte de no estar en el listado de usuarios)</span></label> ***Se implementara en un futuro cercano***--}}

        {{-- <label for="route-details">Detalles de la Vía <span>(opcional)</span></label>
        <textarea id="route-details" name="route[details]" cols="30" rows="10"></textarea> --}}

        <button type="submit" class="button blue-button">Añadir Vía</button>
    </form>
</main>
@endsection
