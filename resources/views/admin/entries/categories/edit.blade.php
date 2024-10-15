<h1>Editar Categoría</h1>
<a href="{{route('categories.index')}}">Volver</a>
<form action="{{route('categories.update', $category->id)}}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="category[category_name]" value="{{$category->category_name}}">

    <button type="submit">Crear Categoría</button>
</form>
