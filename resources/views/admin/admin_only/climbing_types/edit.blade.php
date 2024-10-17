<h1>Editar Tipo de Escalada</h1>
<a href="{{route('climbing-types.index')}}"><p>Volver</p></a>
<form action="{{route('climbing-types.update', $climbingType)}}" method="POST">
    @csrf
    @method('PUT')

    <label for="climbing-type-name">Tipo de Escalada</label>
    <input id="climbing-type-name" type="text" name="climbing_type[name]" value="{{$climbingType->name}}">

    <button type="submit">Editar Tipo de Escalada</button>
</form>
