@extends('layouts.app')

@section('content')
<main class="contenedor seccion contenido-centrado entry">
    <div class="entry-title">
        <a href="#"><p class="category">#{{ $entry->entryCategory->category_name }}</p></a>
        <h1 class="section-title" >{{$entry->title}}</h1>
    </div>
    <picture>
        <img loading="lazy" src="{{Storage::disk('s3')->url('summithorns/summithorns/images/blog/' . $entry->image)}}" alt="Imagen Entrada: {{$entry->title}}">
    </picture>
    <div class="meta-info">
        <p>Autor:<a href="{{ route('profile.index', ['id' => $entry->user_id]) }}"><span>{{$entry->user->username}}</span></a></p>
        <p class="date">Fecha: {{$entry->created_at->format('d-m-y')}}<span></span></p>
    </div>
    <div class="body-article">
        {!! $entry->description !!}
    </div>
    <div class="alinear-derecha">
        <a href="/blog" class="blue-button">Ir al Blog</a>
    </div>
</main>
@endsection
