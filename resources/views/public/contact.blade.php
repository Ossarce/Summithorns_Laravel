@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">¿Conversemos?</h1>
    <div class="contact-content">
        <picture>
            <img src="{{asset('images/base/contact.webp')}}" alt="Contactátanos Imagen" class="contact-img">
        </picture>
        <form action="{{route('public.submit')}}" method="POST" class="form beauty-form">
            @csrf
            <label>Nombre</label>
            <input type="text" name="contact[name]" value="{{old('contact.name')}}">

            <label>Correo</label>
            <input type="email" name="contact[email]" value="{{old('contact.email')}}">

                <!-- <label for="phone">Phone</label>
                <input type="tel" placeholder="56994561266" id="phone"> -->
            <label for="purpose">Razón</label>
            <select id="purpose" name="contact[purpose]">
                <option value="" disabled selected>--Selecciona una--</option>
                <option value="Ser Colaborador" {{old('contact.purpose') == 'Ser Colaborador' ? 'selected' : ''}}>Ser Colaborador</option>
                <option value="Consulta General" {{old('contact.purpose') == 'Consulta General' ? 'selected' : ''}}>Consulta General</option>
                <option value="Otra" {{old('contact.purpose') == 'Otra' ? 'selected' : ''}}>Otra</option>
            </select>

            <label>Mensaje</label>
            <textarea name="contact[message]" rows="4" cols="6">{{old('contact.message')}}</textarea>
            <div class="btn">
                <input type="submit" value="Enviar" class="blue-button contact-btn">
            </div>
        </form>
    </div>
</main>
@endsection
