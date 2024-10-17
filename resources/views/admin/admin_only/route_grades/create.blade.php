<h1>Añadir Grado Vía</h1>
<a href="{{route('route-grades.index')}}"><p>Volver</p></a>
<form action="{{route('route-grades.store')}}" method="POST">
    @csrf
    <label for="route-grade-name">Grado de Vía</label>
    <input id="route-grade-name" type="text" name="route_grade[grade]">

    <button type="submit">Añadir Nuevo Grado</button>
</form>
