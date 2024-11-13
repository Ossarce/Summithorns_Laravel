@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado">
    <h1>{{$entry->title}}</h1>
    <picture>
        <img loading="lazy" src="{{Storage::disk('s3')->url('summithorns/summithorns/images/blog/' . $entry->image)}}" alt="Imagen Entrada: {{$entry->title}}">
    </picture>
    <div class="meta-info">
        <p>Autor:<a href="{{ route('profile.index', ['id' => $entry->user_id]) }}"><span>{{$entry->user->username}}</span></a></p>
        <p class="date">Fecha: {{$entry->created_at->format('d-m-y')}}<span></span></p>
        <p class="category"> <a href="#">#{{$entry->entryCategory->category_name}}</a></p>
    </div>
    <div class="body-article">
        <p>{{$entry->description}}</p>
    </div>
    <div class="alinear-derecha">
        <a href="/blog" class="blue-button">Go to Blog</a>
    </div>
</main>
@endsection
