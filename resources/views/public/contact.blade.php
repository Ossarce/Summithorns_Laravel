@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">¿Conversemos?</h1>
    <picture>
        <source src="build/img/destacada2.webp" type="image/webp">
        <source src="build/img/destacada2.jpg" type="image/jpg">
        <img src="build/img/destacada2.jpg" alt="Contact Us Image">
    </picture>
    <form action="/contact" method="POST" class="form beauty-form">
        <label>Nombre</label>
        <input type="text" name="contact[name]" required>

        <label>Correo</label>
        <input type="email" name="contact[email]" required>

            <!-- <label for="phone">Phone</label>
            <input type="tel" placeholder="56994561266" id="phone"> -->
        <label for="purpose">Razón</label>
        <select id="purpose" name="contact[purpose]" required>
            <option value="" disabled selected>--Selecciona una--</option>
            <option value="Become a Blog Contributor">Ser Colaborador</option>
            <option value="General Inquiry">Consulta General</option>
            <option value="Other">Otra</option>
        </select>

        <label>Message:</label>
        <textarea name="contact[message]" rows="4" required></textarea>
        <div class="btn">
            <input type="submit" value="Send" class="blue-button contact-btn">
        </div>
    </form>
</main>
@endsection
