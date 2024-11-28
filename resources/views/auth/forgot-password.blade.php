@extends('layouts.app')

@section('content')

<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">Olvidaste tu contraseña?</h1>
    <form method="POST" class="form" action="{{route('password.email')}}">
        @csrf
        <div class="beauty-form">
            <label for="email">Correo</label>
            <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus />

            <div class="auth-section auth-flex">
                <a href="{{route('login')}}">Recordaste tu contraseña? Inicia Sesión</a>
                <a href="{{route('register')}}">Nuevo? Crea una cuenta</a>
            </div>

            <input type="submit" value="Recuperar" class="button blue-button">
        </div>
    </form>
</main>

@endsection
