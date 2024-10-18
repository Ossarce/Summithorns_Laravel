<h1>Zonas de {{$spot->name}}</h1>
<a href="{{route('spots.index')}}"><p>Volver</p></a>

@foreach ($zones as $zone)
    <h2>Nombre zona</h2>
    <a href="{{route('zones.edit', [$spot, $zone])}}"><p>{{$zone->name}}</p></a>
    @switch($spot->climbingType->name)
        @case('Boulder')
            <a href="{{route('boulders.index', [$spot, $zone])}}"><p>Ver Boulders</p></a>
            @break
        @case('Deportiva')
            <a href="/"><p>Ver Vías (Ahora no lleva a ninguna parrrrte)</p></a>
        @break
        @default
            <p>Ha ocurrido un error al mostrar las zonas. Comunícate con soporte si el problema persiste.</p>
    @endswitch
@endforeach
<br>
<h3>Añadir Nueva Zona</h3>
<a href="{{route('zones.create', $spot)}}"><button>Añadir Zona</button></a>
