@extends('layouts.app')

@section('content')

<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">Reseta tu contraseña</h1>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

        <div class="beauty-form">
            <label for="password">Contraseña</label>
            <x-text-input id="password" type="password" name="password" />

            <label for="password_confirmation">Confirmar Contraseña</label>
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" />

            <input type="submit" value="Cambiar Contraseña" class="button blue-button">
        </div>
    </form>
</main>

@endsection
