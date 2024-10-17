<h1>Editar spot</h1>
<a href="{{route('spots.index')}}">Volver</a>
<form action="{{ route('spots.update', $spot->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="spot-name">Nombre del Spot</label>
    <input id="spot-name" type="text" name="spot[name]" value="{{$spot->name}}">

    <label for="spot-climbing-type">Tipo de Escalada</label>
    <select for="spot-climbing-type" name="spot[climbing_type_id]">
        <option value="" disabled>-- Selecciona Uno</option>
        @foreach ($climbingTypes as $climbingType)
            <option value="{{$climbingType->id}}" {{$climbingType->id === $spot->climbing_type_id ? 'selected' : ''}}>{{$climbingType->name}}</option>
        @endforeach
    </select>

    <label for="spot-image">Imagen del Spot</label>
    <input id="spot-image" type="file" name="spot[image]">
    @if ($spot->image)
        <img src="{{asset('storage/images/spots/' . $spot->image)}}" alt="Imagen {{$spot->name}}">
    @endif

    <label for="spot-description">Descripción del Spot</label>
    <textarea id="spot-description" name="spot[description]">{{$spot->description}}</textarea>

    <label>
        <input type="checkbox" name="spot[bus]" value="1" {{$spot->bus ? 'checked' : ''}}> Accessible by Bus
    </label>

    <label>
        <input type="checkbox" name="spot[car]" value="1" {{$spot->car ? 'checked' : ''}}> Accessible by Car
    </label>

    <label>
        <input type="checkbox" name="spot[bike]" value="1" {{$spot->bike ? 'checked' : ''}}> Accessible by Bike
    </label>

    <button type="submit">Editar Spot</button>
</form>
