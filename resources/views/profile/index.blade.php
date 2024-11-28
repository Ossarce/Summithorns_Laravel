@extends('layouts.app')

@section('content')

<main class="contenedor seccion contenido-centrado">
    <div class="profile-container">
        <div class="profile-column">
            <img class="profile-pic"
            src="{{ $user->profile->avatar
                  ? Storage::disk('s3')->url('summithorns/summithorns/images/profiles/avatars/' . $user->profile->avatar)
                  : asset('images/base/avatar-default.png') }}"
            alt="Avatar de {{ $user->username }}">
            <div class="profile-content  socials-container">
                @if ($user->profile->instagram)
                    <a class="socials" href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                @endif
                @if ($user->profile->facebook)
                    <a class="socials" href="#" target="_blank"><i class='bx bxl-facebook-square'></i></a>
                @endif
            </div>
            <div class="profile-content">
                @if ($user->profile->website)
                    <a href="{{ $user->profile->website }}" target="_blank"><p>{{ $user->profile->website }}</p></a>
                @endif
            </div>
            <div class="profile-column fav-border">
                <h4>Favorite Spots</h4>
                <ul>
                    @foreach ($user->favorites as $favorite)
                        @if ($favorite->spot)
                            <li><a href="{{ route('public.spot', $favorite->spot->id) }}">{{ $favorite->spot->name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="filler-card">
                <img src="{{ Storage::disk('s3')->url('images/base/fillerimage.webp') }}" alt="Filler Image">
            </div>
        </div>
        <div class="profile-column timeline">
            <h3>{{ $user->profile->first_name . ' ' . $user->profile->last_name }}</h3>
            <p>{{ $user->profile->location }}</p>
            <div class="socials-container">
                <div class="profile-content">
                    <a href="#">
                        <p>Followers</p>
                        <p>10</p>
                    </a>
                </div>
                <div class="profile-content">
                    <a href="#">
                        <p>Following</p>
                        <p>10</p>
                    </a>
                </div>
            </div>
            <div class="profile-content bio">
                <p>{{ $user->profile->bio ? $user->profile->bio  : 'No hay bio aún! Personalízala con tu historia de escalada o déjala en blanco. Hazla única!'}}</p>
            </div>
            <div class="profile-column">
            <h4>Achievements</h4>
            <ul>
                <li>Escaló a vista Solo Para Cobardes (5.11a)</li> <!-- On sighted = Escalado a vista -->
                <li>Flasheó Demetrio (V4)</li> <!-- Flashed = Flasheado -->
                <li>Escaló a vista Pitufo Gruñon (5.10d)</li> <!-- On sighted = Escalado a vista -->
                <li>Escaló a vista Cochinillo Valenciano (5.11b)</li> <!-- On sighted = Escalado a vista -->
                <li>Escaló a vista Para Cobardes (5.11a)</li> <!-- On sighted = Escalado a vista -->
                <li>Escaló Tritón (5.10c)</li> <!-- Redpointed = Redpoint -->
            </ul>

        </div>
        </div>
    </div>

    @if(Auth::id() === $user->id)
        <div class="user-panel">
            <a class="yellow-button" href="{{ route('profile.edit', ['id' => $user->id]) }}">Editar Perfil</a>
            @if(Auth::user()->role_id === 1)
                <a class="blue-button" href="{{ route('admin.panel') }}">Panel de Administración</a>
            @endif
        </div>
    @endif

</main>


@endsection
