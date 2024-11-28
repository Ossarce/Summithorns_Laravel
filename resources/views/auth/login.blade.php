@extends('layouts.app')

@section('content')

<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">Inicia Sesión</h1>
    <form method="POST" class="form" action="{{ route('login') }}">
        @csrf
        <div class="beauty-form">
            <label for="email">Correo</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />

            <label for="password">Contraseña</label>
            <x-text-input id="password" type="password" name="password" autocomplete="current-password" />

            <div class="auth-section auth-flex">
                <a href="{{route('register')}}">Nuevo aquí? Crea una cuenta</a>
                <a href="{{route('password.request')}}">Olvidaste tu contraseña?</a>
            </div>

            <input type="submit" value="Iniciar Sesión" class="button blue-button">
        </div>
    </form>
</main>

@endsection
