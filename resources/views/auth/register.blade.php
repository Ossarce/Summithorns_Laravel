@extends('layouts.app')

@section('content')


<main class="contenedor seccion contenido-centrado">
    <h1 class="login-title">Bienvenido a Summit Horns!</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="beauty-form">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" type="text" name="username" :value="old('username')" autofocus />


            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" />

            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" />

            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" type="password" name="password_confirmation" />

            <div class="auth-section">
                <a href="{{route('login')}}">Ya eres usuario? Inicia Sesión</a>
            </div>

            <input type="submit" value="Create Account" class="button blue-button">
        </div>
    </form>
</main>

@endsection
