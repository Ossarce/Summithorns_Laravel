@extends('layouts.app')

@section('content')


<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">Bienvenido a Summit Horns!</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="beauty-form">
            <label for="username">Nombre de Usuario</label>
            <x-text-input id="username" type="text" name="username" :value="old('username')" autofocus />


            <label for="email">Correo</label>
            <x-text-input id="email" type="email" name="email" :value="old('email')" />

            <label for="password">Contraseña</label>
            <x-text-input id="password" type="password" name="password" />

            <label for="password_confirmation">Confirma Contraseña</label>
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" />

            <div class="auth-section">
                <a href="{{route('login')}}">Ya eres usuario? Inicia Sesión</a>
            </div>

            <input type="submit" value="Crear Cuenta" class="button blue-button">
        </div>
    </form>
</main>

@endsection
