<h1>Crear Nueva Categoría</h1>
<a href="{{route('categories.index')}}">Volver</a>
<form action="{{route('categories.store')}}" method="POST">
    @csrf
    <input type="text" name="category[category_name]" placeholder="Nombre Categoría">

    <button type="submit">Crear Categoría</button>
</form>
