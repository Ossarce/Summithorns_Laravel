<h1>Editar entrada</h1>
<a href="{{route('entries.index')}}">Volver</a>
<form action="{{route('entries.update', $entry->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="entry-title">Titulo</label>
    <input id="entry-title" type="text" name="entry[title]" value="{{$entry->title}}">

    <label for="entry-category">Categoria</label>
    <select name="entry[category_id]" id="entry-category-id">
        <option selected value="">-- Escoje una categoria --</option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}" {{$entry->category_id === $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
        @endforeach
    </select>

    <label for="entry-image">Imagen</label>
    <input id="entry-image" type="file" name="entry[image]">
    @if ($entry->image)
        <img src="{{{asset('storage/images/blog/' . $entry->image)}}}" alt="Imagen {{$entry->title}}">
    @endif

    <label for="entry-description">Contenido</label>
    <textarea id="entry-description" name="entry[description]">{{$entry->description}}</textarea>

    <button type="submit">Editar Entrada</button>
</form>
