@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Añadir Nuevo Boulder</h1>
    <a href="{{route('boulders.index', [$spot, $zone])}}"class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{route('boulders.store', [$spot,  $zone])}}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf
        <label for="boulder-name">Nombre del Boulder</label>
        <input id="boulder-name" type="text" name="boulder[name]">

        <label for="boulder-grade">Grado</label>
        <select id="boulder-grade" name="boulder[grade]">
            <option value="" selected disabled>-- Seleccione Uno --</option>
            @foreach ($boulderGrades as $boulderGrade)
                <option value="{{$boulderGrade->id}}">{{$boulderGrade->boulder_grade}}</option>
            @endforeach
        </select>

        {{-- <label for="boulder-image">Imagen del Boulder <span>(opcional)</span></label>
        <input id="boulder-image" type="file" name="boulder[image]"> --}}

        {{-- <label for="boulder-image">Abridor <span>(comunicarse con soporte de no estar en el listado de usuarios)</span></label> ***Se implementara en un futuro cercano***--}}

        {{-- <label for="boulder-details">Detalles del Boulder <span>(opcional)</span></label>
        <textarea id="boulder-details" name="boulder[details]" cols="30" rows="10"></textarea> --}}

        <button type="submit" class="button blue-button">Añadir Boulder</button>
    </form>
</main>
@endsection
