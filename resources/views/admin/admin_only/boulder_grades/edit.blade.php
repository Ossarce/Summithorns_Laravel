<h1>Editar Grado Boulder</h1>
<a href="{{route('boulder-grades.index')}}"><p>Volver</p></a>
<form action="{{route('boulder-grades.update', $boulderGrade)}}" method="POST">
    @csrf
    @method('PUT')
    <label for="boulder-grade-name">Grado de Boulder</label>
    <input id="boulder-grade-name" type="text" name="boulder_grade[grade]" value="{{$boulderGrade->boulder_grade}}">

    <button type="submit">Editar Grado</button>
</form>
