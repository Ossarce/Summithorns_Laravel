<h1>Añadir Grado Boulder</h1>
<a href="{{route('boulder-grades.index')}}"><p>Volver</p></a>
<form action="{{route('boulder-grades.store')}}" method="POST">
    @csrf
    <label for="boulder-grade-name">Grado de Boulder</label>
    <input id="boulder-grade-name" type="text" name="boulder_grade[grade]">

    <button type="submit">Añadir Nuevo Grado</button>
</form>
