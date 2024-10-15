<h1>Editar Zona</h1>
<a href="{{route('zones.index', $spot)}}">Volver</a>
<form action="{{route('zones.update', [$spot, $zone])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="zone-name">Nombre de la Zona</label>
    <input id="zone-name" type="text" name="zone[name]" value="{{$zone->name}}">

    <label for="zone-image">Imagen de la Zona</label>
    <input id="zone-image" type="file" name="zone[image]">
    @if ($zone->image)
        <img src="{{asset('storage/images/spots/zones/' . $zone->image)}}" alt="Imagen Zona {{$zone->name}}">
    @endif

    <label for="zone-details">Detalles de la zona</label>
    <textarea id="zone-details" name="zone[details]" cols="30" rows="10">{{$zone->details}}</textarea>

    <button type="submit">Editar Zona</button>
</form>
