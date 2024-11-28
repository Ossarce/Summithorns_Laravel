@extends('layouts.app')

@section('content')

<main class="contenedor seccion contenido-centrado">
    <h1 class="section-title">Edita tu perfil</h1>
    <form action="{{ route('profile.update', $profile->id) }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="beauty-form edit-form">

            <label for="first_name">Primer Nombre*</label>
            <input type="text" id="first_name" name="profile[first_name]" value="{{ old('profile.first_name', $profile->first_name) }}">

            <label for="last_name">Segundo Nombre</label>
            <input type="text" id="last_name" name="profile[last_name]" value="{{ old('profile.last_name', $profile->last_name) }}">

            <label for="avatar">Avatar</label>
            <input type="file" name="profile[avatar]" id="avatar" >
            <img src="{{ $profile->avatar ? Storage::disk('s3')->url('summithorns/summithorns/images/profiles/avatars/' . $user->profile->avatar) : Storage::disk('s3')->url('images/base/avatar-default.png') }}" alt="Avatar de {{ $user->username }}" class="avatar-edit">

            <div class="edit-container">
                <label for="private">Perfil Privado?</label>
                <input type="checkbox" id="private" name="profile[private]" value="1" {{ $profile->is_private ? 'checked' : '' }} class="edit-private" >
            </div>


            <label for="location">Ubicación</label>
            <input type="text" id="location" name="profile[location]" value="{{ old('profile.location', $profile->location) }}">

            <label for="bio">Bio</label>
            <textarea name="profile[bio]" id="bio" cols="30" rows="10">{{ old('profile.bio', $profile->bio) }}</textarea>

            <label for="website">Sitio Web</label>
            <input type="text" name="profile[website]" id="website" value="{{ old('profile.website', $profile->website) }}">

            <label for="instagram">Instagram</label>
            <input type="text" name="profile[instagram]" id="instagram" value="{{ old('profile.instagram', $profile->instagram) }}">

            <label for="facebook">Facebook</label>
            <input type="text" name="profile[facebook]" id="facebook" value="{{ old('profile.facebook', $profile->facebook) }}">

        </div>
        <input type="submit" value="Actualizar Perfil" class="button blue-button">
    </form>
</main>

@endsection
