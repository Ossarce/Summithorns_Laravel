{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.app')

@section('content')

<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">Olvidaste tu contraseña?</h1>
    <form method="POST" class="form" action="{{route('password.email')}}">
        @csrf
        <div class="beauty-form">
            <x-input-label for="email" :value="__('Email')" />
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
