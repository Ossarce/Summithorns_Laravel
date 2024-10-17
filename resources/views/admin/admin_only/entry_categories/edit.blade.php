<h1>Editar Categoría</h1>
<a href="{{route('entry-categories.index')}}">Volver</a>
<form action="{{route('entry-categories.update', $category->id)}}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="category[category_name]" value="{{$category->category_name}}">

    <button type="submit">Editar Categoría</button>
</form>
