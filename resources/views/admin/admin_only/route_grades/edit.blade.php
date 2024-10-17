<h1>Editar Grado Vía</h1>
<a href="{{route('route-grades.index')}}"><p>Volver</p></a>
<form action="{{route('route-grades.update', $routeGrade)}}" method="POST">
    @csrf
    @method('PUT')
    <label for="route-grade-name">Grado de Vía</label>
    <input id="route-grade-name" type="text" name="route_grade[grade]" value="{{$routeGrade->route_grade}}">

    <button type="submit">Editar Grado</button>
</form>
