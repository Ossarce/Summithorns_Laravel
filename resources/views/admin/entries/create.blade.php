<h1>Crear entrada</h1>
<a href="{{route('entries.index')}}">Volver</a>
<form action="{{route('entries.store')}}" method="POST" enctype="multipart/form-data">
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

    <label for="entry-description">Contenido</label>
    <textarea id="entry-description" name="entry[description]"></textarea>

    <button type="submit">Crear Entrada</button>
</form>
