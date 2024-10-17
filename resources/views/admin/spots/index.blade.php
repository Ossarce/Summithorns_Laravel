<h1>Administración de Spots</h1>
<a href="{{route('admin.panel')}}"><h3>Volver al panel</h3></a>
<a href="{{route('climbing-types.index')}}"><h4>Ver Tipos de Escalada</h4></a>
<a href="{{route('boulder-grades.index')}}"><h4>Ver Grados de Boulders</h4></a>
<a href="{{route('route-grades.index')}}"><h4>Ver Grados de Vías</h4></a>
@foreach ($spots as $spot)
    <h2>Nombre del Spot</h2>
    <a href="{{route('spots.edit', $spot->id)}}"><p>{{ $spot->name }}</p></a>
    <a href="{{route('zones.index', $spot)}}">Ir a las zonas de este spot</a>
@endforeach
<br>
<h3>Crear un spot nuevo</h3>
<a href="{{route('spots.create')}}"><button>Crear Spot</button></a>
