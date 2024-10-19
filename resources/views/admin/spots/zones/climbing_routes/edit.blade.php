<h1>Editar Vía: "{{$climbingRoute->name}}"</h1>
<a href="{{route('routes.index', [$spot, $zone])}}"><p>Volver</p></a>
<form action="{{route('routes.update', [$spot, $zone, $climbingRoute])}}" method="POST">
    @csrf
    @method('PUT')
    <label for="route-name">Nombre del route</label>
    <input id="route-name" type="text" name="route[name]" value="{{$climbingRoute->name}}">

    <label for="route-grade">Grado</label>
    <select id="route-grade" name="route[grade]">
        <option value="" disabled>-- Selecione Uno --</option>
        @foreach ($routeGrades as $routeGrade)
            <option value="{{$routeGrade->id}}" {{$routeGrade->id === $climbingRoute->grade_id ? 'selected' : ''}}>{{$routeGrade->route_grade}}</option>
        @endforeach
    </select>

    <label for="route-image">Imagen de la Vía <span>(opcional)</span></label>
    <input id="route-image" type="file" name="route[image]">
    @if ($climbingRoute->image)
        <img src="{{asset('storage/images/spots/zones/routes' . $climbingRoute->image)}}" alt="Imagen vía {{$climbingRoute->name}}">
    @endif

    <label for="route-details">Detalles de la Vía <span>(opcional)</span></label>
    <textarea id="route-details" name="route[details]" cols="30" rows="10">{{$climbingRoute->details}}</textarea>

    <button type="submit">Editar Ruta</button>
</form>
