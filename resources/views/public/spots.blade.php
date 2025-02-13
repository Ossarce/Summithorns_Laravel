@extends('layouts.app')

@section('content')
<main class="seccion contenedor">
    <h2 class="section-title">Spots de Escalada</h2>
    {{-- <div class="sidebar-spots">
        <h4>Filtrar Por</h4>
        <div class="filter-box climbing-type">
            <p>Tipo de escalada</p>
            <div class="option">
                <input id="boulder" name="boulder" type="checkbox">
                <label for="boulder">Boulder</label>
            </div>
            <div class="option">
                <input id="route" name="route" type="checkbox">
                <label for="route">Deportiva</label>
            </div>
        </div>
        <div class="filter-box arriving">
            <p>Acceso</p>
            <div class="option">
                <input id="bus" type="checkbox" name="bus">
                <label for="bus">Transporte público</label>
            </div>
            <div class="option">
                <input id="car" type="checkbox" name="car">
                <label for="car">Auto</label>
            </div>
            <div class="option">
                <input id="bike" type="checkbox" name="bike">
                <label for="bike">Bicicleta</label>
            </div>
        </div>
        <div class="filter-box region">
            <p>Región</p>
            <div class="option">
                <input id="metropolitana" type="checkbox" name="metropolitana">
                <label for="metropolitana">Metropolitana</label>
            </div>
            <div class="option">
                <input id="valparaiso" type="checkbox" name="valparaiso">
                <label for="valparaiso">Valparaíso</label>
            </div>
        </div>
    </div>
    <div class="contenedor-filtros">
        <p class="filter-spots-btn">Filtros <i class='bx bx-menu-alt-left'></i></p>
        <select name="" id="">
            <option value="">Más nuevos</option>
            <option value="">Más antiguos</option>
            <option value="">Más populares</option>
        </select>
    </div> --}}
    @include('public.spotslisting')
    <x-pagination :items="$spots" />
</main>
@endsection
