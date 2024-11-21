@extends('layouts.admin')

@section('content')
<main class="contenedor seccion admin-content">
    <h1 class="section-title">Crear entrada</h1>
    <a href="{{route('entries.index')}}" class="go-back"><p><i class='bx bx-arrow-back'></i> Volver</p></a>
    <form action="{{route('entries.store')}}" method="POST" enctype="multipart/form-data" class="form beauty-form">
        @csrf

        <label for="entry-title">Titulo</label>
        <input id="entry-title" type="text" name="entry[title]" placeholder="Título">

        <label for="entry-category">Categoria</label>
        <select name="entry[category_id]" id="entry-category-id">
            <option selected value="" disabled>-- Escoje una categoria --</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select>

        <label for="entry-image">Imagen</label>
        <input id="entry-image" type="file" name="entry[image]">

        <label for="entry_description">Contenido</label>
        <div id="entry_description"></div>
        <textarea name="entry[description]" id="entry_description_hidden" style="display: none;"></textarea>

        <button type="submit" class="button blue-button">Crear Entrada</button>
    </form>
</main>
@endsection
