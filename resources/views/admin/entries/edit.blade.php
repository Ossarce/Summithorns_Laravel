@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Editar entrada</h1>
    <a href="{{route('entries.index')}}"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{route('entries.update', $entry->id)}}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf
        @method('PUT')

        <label for="entry-title">Titulo</label>
        <input id="entry-title" type="text" name="entry[title]" value="{{$entry->title}}">

        <label for="entry-category">Categoria</label>
        <select name="entry[category_id]" id="entry-category-id">
            <option selected value="" disabled>-- Escoje una categoria --</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}" {{$entry->category_id === $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
            @endforeach
        </select>

        <label for="entry-image">Imagen</label>
        <input id="entry-image" type="file" name="entry[image]">
        @if ($entry->image)
            <img src="{{{asset('storage/images/blog/' . $entry->image)}}}" alt="Imagen {{$entry->title}}">
        @endif

        <label for="entry_description">Contenido</label>
        <div id="entry_description"></div>
        <textarea name="entry[description]" id="entry_description_hidden" style="display: none;"></textarea>

        <button type="submit" class="button blue-button">Editar Entrada</button>
    </form>
</main>
@endsection
