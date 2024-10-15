<h1>Añadir Zona a {{$spot->name}}</h1>
<a href="{{route('zones.index', $spot)}}">Volver</a>
<form action="{{route('zones.store', $spot)}}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="zone-name">Nombre de la zona</label>
    <input id="zone-name" type="text" name="zone[name]">

    <label for="zone-image">Imagen de la zona</label>
    <input id="zone-image" type="file" name="zone[image]">

    <label for="zone-details">Detalles de la zona</label>
    <textarea id="zone-details" name="zone[details]" cols="30" rows="10"></textarea>

    <button type="submit">Añadir Zona</button>
</form>
