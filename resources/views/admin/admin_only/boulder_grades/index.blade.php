<h1>Administrar Grados Boulders</h1>
<a href="{{route('spots.index')}}"><p>Volver</p></a>
@foreach ($boulderGrades as $boulderGrade)
    <a href="{{route('boulder-grades.edit', $boulderGrade)}}"><h3>{{$boulderGrade->boulder_grade}}</h3></a>
@endforeach
<br>
<a href="{{route('boulder-grades.create')}}"><button>Añadir Grado</button></a>
