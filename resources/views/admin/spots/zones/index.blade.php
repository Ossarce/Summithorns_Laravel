<h1>Zonas de {{$spot->name}}</h1>
<a href="{{route('spots.index')}}"><p>Volver</p></a>

@foreach ($zones as $zone)
    <h2>Nombre zona</h2>
    <a href="{{route('zones.edit', [$spot, $zone])}}"><p>{{$zone->name}}</p></a>
@endforeach
<br>
<h3>Añadir Nueva Zona</h3>
<a href="{{route('zones.create', $spot)}}"><button>Añadir Zona</button></a>
