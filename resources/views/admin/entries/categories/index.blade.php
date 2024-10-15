<h1>Administración de las categorías</h1>
@foreach ($categories as $category)
    <a href="{{route('categories.edit', $category->id)}}"><p>{{$category->category_name}}</p></a>
@endforeach
<a href="{{route('categories.create')}}"><button>Crear Categoría</button></a>
