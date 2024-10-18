<h1>Administrar Boulders</h1>
<a href="{{route('zones.index', [$spot, $zone])}}"><p>Volver</p></a>
@foreach ($boulders as $boulder)
    <h2>Nombre del Boulder</h2>
    <a href="{{route('boulders.edit', [$spot, $zone, $boulder])}}"><p>{{$boulder->name}}</p></a>
@endforeach
<a href="{{route('boulders.create', [$spot, $zone])}}"><button>Añadir Boulder</button></a>

