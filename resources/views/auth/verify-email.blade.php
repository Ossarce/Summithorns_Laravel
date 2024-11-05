@extends('layouts.app')

@section('content')

<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">Confirma Tu Cuenta</h1>

    <div class="us-text">
        <p>¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el correo, con gusto te enviaremos otro.</p>
        <p>Asegúrate de revisar también tu bandeja de spam.</p>
    </div>

    <div class="">
        <!-- Formulario para reenviar el correo de verificación -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            {{-- <div class="beauty-form"> --}}
                <input type="submit" value="Reenviar Verificación" class="button blue-button">
            {{-- </div> --}}
        </form>
    </div>
</main>

@endsection
