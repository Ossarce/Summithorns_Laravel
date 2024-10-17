<h1>Administrar Tipos de Escalada</h1>
<a href="{{route('spots.index')}}">Volver</a>
@foreach ($climbingTypes as $climbingType)
    <a href="{{route('climbing-types.edit', $climbingType)}}"><h3>{{$climbingType->name}}</h3></a>
@endforeach
<br>
<a href="{{route('climbing-types.create')}}"><button>Añadir Tipo de Escalada</button></a>
