<h1>Administrar Vías de {{$spot->name}} en sector {{$zone->name}}</h1>
<a href="{{route('zones.index', [$spot])}}"><p>Volver</p></a>
@foreach ($climbingRoutes as $climbingRoute)
    <h2>Nombre de la Vía</h2>
    <a href="{{route('routes.edit', [$spot, $zone, $climbingRoute])}}"><p>{{$climbingRoute->name}}</p></a>
@endforeach
<a href="{{route('routes.create', [$spot, $zone])}}"><button>Añadir Vía</button></a>
