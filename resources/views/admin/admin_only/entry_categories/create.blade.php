<h1>Crear Nueva Categoría</h1>
<a href="{{route('entry-categories.index')}}"><p>Volver</p></a>
<form action="{{route('entry-categories.store')}}" method="POST">
    @csrf
    <label for="entry-category-name">Nombre de la Categoría</label>
    <input id="entry-category-name" type="text" name="category[category_name]">

    <button type="submit">Crear Categoría</button>
</form>
