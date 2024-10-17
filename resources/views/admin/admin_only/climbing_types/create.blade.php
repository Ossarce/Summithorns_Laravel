<h1>Añadir un Tipo de Escalada</h1>
<a href="{{route('climbing-types.index')}}"><p>Volver</p></a>
<form action="{{route('climbing-types.store')}}" method="POST">
    @csrf

    <label for="climbing-type-name">Tipo de Escalada</label>
    <input id="climbing-type-name" type="text" name="climbing_type[name]">

    <button type="submit">Añadir Tipo de Escalada</button>
</form>
