<h1>Prueba uno!</h1>
@foreach ($spots as $spot)
    <a href="{{route('spots.edit', $spot->id)}}"><p>{{ $spot->name }}</p></a>
@endforeach
<a href="{{route('spots.create')}}">Crear Spot</a>
