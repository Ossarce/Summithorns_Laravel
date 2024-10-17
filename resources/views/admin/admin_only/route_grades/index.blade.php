<h1>Administrar Grados de Vías</h1>
<a href="{{route('spots.index')}}"><p>Volver</p></a>
@foreach ($routeGrades as $routeGrade)
    <a href="{{route('route-grades.edit', $routeGrade)}}"><h3>{{$routeGrade->route_grade}}</h3></a>
@endforeach
<br>
<a href="{{route('route-grades.create')}}"><button>Añadir Grado</button></a>
