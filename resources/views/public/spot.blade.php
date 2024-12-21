@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado">
    <div class="spot-head">
        <div class="favorite-name-container">
            <h1>{{$spot->name}}</h1>
            <span class="like-icon {{ $isFavorite ? 'liked' : '' }}" data-spot-id="{{ $spot->id }}"></span>
        </div>
        <ul class="guide-icons">
            @if($spot->bus == '1')
                <li>
                    <img loading="lazy" src="{{ asset('images/base/iconbus.svg') }}" alt="Ícono Bus">
                </li>
            @endif

            @if($spot->car == '1')
                <li>
                    <img loading="lazy" src="{{ asset('images/base/iconcar.svg') }}" alt="Ícono Auto">
                </li>
            @endif
            @if($spot->bike == '1')
                <li>
                    <img loading="lazy" src="{{ asset('images/base/iconobicicleta.svg') }}" alt="Ícono Bicicleta">
                </li>
            @endif
        </ul>
    </div>

    <picture class="displayed-pic">
        <img loading="lazy" src="{{Storage::disk('s3')->url('summithorns/summithorns/images/spots/'. $spot->image)}}" alt="{{$spot->name}} Imagen">
    </picture>


    <div class="spot-info">
        <div class="spot-data">
            <p>Zonas: {{ $spot->zones()->count() }}</p>
            @if ($spot->climbingType->name === 'Deportiva')
                <p>Vías: {{ $totalRoutes }}</p>
            @endif
            @if ($spot->climbingType->name === 'Boulder')
                <p> Boulders: {{ $totalBoulders }}</p>
            @endif
        </div>
        <div class="spot-description">
            {!! $spot->description !!}
        </div>
        <div class="table-container">
            <h2>Listado de Zonas</h2>
            {{ $dataTable->table() }}
        </div>
        <div class="comments-container">
            <h3>Comentarios</h3>
            @foreach ($comments as $comment)
                <div class="comment">
                    <img src="{{ $comment->user->profile->avatar ? Storage::disk('s3')->url('summithorns/summithorns/images/profiles/avatars/' . $comment->user->profile->avatar) : asset('images/base/avatar-default.png') }}" alt="Avatar de {{ $comment->user->username }}">
                    <div class="comment-content">
                        <div class="comment-title">
                            <a href="{{ route('profile.index', $comment->user->id) }}"><h4>{{ $comment->user->username }}</h4></a>
                            <p>{{ $comment->created_at->format('d/m/Y') }}</p>
                        </div>
                        <p>{{ $comment->comment }}</p>
                        <div class="comment-actions">
                            <p data-comment-id="{{ $comment->id }}" class="reply-btn">Responder</p>
                            @if ($comment->replies->isNotEmpty())
                                <p data-comment-id="{{ $comment->id }}" class="show-replies">Respuestas({{ $comment->replies->count() }})<i class='bx bx-chevron-down' ></i></p>
                            @endif
                        </div>
                        @if (Auth::check() && $comment->isOwnedBy(Auth::id()))
                                <div class="edit-delete-comment">
                                    {{-- <a href=""><p>Editar</p></a> --}}
                                    <a class="delete-comment-btn" data-comment-id="{{ $comment->id }}" href="{{ route('comment.delete', $comment->id) }}"><p><i class='bx bx-trash bx-border'></i></p></a>
                                </div>
                        @endif
                        <div class="comment-actions-content">
                            @if ($comment->replies->isNotEmpty())
                                <div class="reply-container" data-replies-container-id="{{ $comment->id }}">
                                    @foreach ($comment->replies as $reply)
                                        <div class="reply">
                                            <img src="{{ $reply->user->profile->avatar ? Storage::disk('s3')->url('summithorns/summithorns/images/profiles/avatars/' . $reply->user->profile->avatar) : asset('images/base/avatar-default.png') }}" alt="Avatar de {{ $reply->user->username }}">
                                            <div class="comment-content">
                                                <div class="reply-comment-title">
                                                    <a href="{{ route('profile.index', $reply->user->id) }}"><h5>{{ $reply->user->username }}</h5></a>
                                                    <p>{{ $reply->created_at->format('d/m/Y') }}</p>
                                                </div>
                                                <p>{{ $reply->comment }}</p>
                                                @if (Auth::check() && $reply->isOwnedBy(Auth::id()))
                                                    <div class="edit-delete-comment">
                                                        <a class="delete-reply-btn" data-reply-id="{{ $reply->id }}" href="{{ route('comment.delete', $reply->id) }}"><p><i class='bx bx-trash bx-border'></i></p></a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="reply-form" data-reply-form-id="{{ $comment->id }}">
                                @if (Auth::check())
                                    <form action="{{ route('comment.store.reply', ['commentId' => $comment->id]) }}" method="POST" class="form beauty form">
                                        @csrf
                                        <textarea name="comment[content]" id="comment" rows="3" cols="6"></textarea>
                                        <button type="submit" class="button yellow-button">Responder</button>
                                    </form>
                                @else
                                    <div class="auth-container">
                                        <p><a href="{{ route('login') }}?redirect={{ urlencode(url()->full()) }}">Inicia Sesión</a> para responder.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="leave-comment">
                <h4 for="comment">Deja un comentario</h4>
                @if (Auth::check())
                    <form action="{{ route('comment.store.spot', $spot) }}" method="POST" class="form beauty form">
                        @csrf
                        <textarea name="comment[content]" id="comment" rows="3" cols="6"></textarea>
                        <button type="submit" class="button yellow-button">Comentar</button>
                    </form>
                @else
                    <div class="auth-container">
                        <p><a href="{{ route('login') }}?redirect={{ urlencode(url()->full()) }}">Inicia Sesión</a> para comentar.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="alinear-derecha spot-button">
        <a href="{{route('public.spots')}}" class="blue-button">Ver todos los spots</a>
    </div>
</main>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
