<h1>Crear nuevo spot</h1>
<a href="{{route('spots.index')}}">Volver</a>
<form action="{{ route('spots.update', $spot->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="spot[name]" value="{{$spot->name}}">

    <input type="file" name="spot[image]">
    @if ($spot->image)
        <img src="{{asset('images/spots/' . $spot->image)}}" alt="Imagen {{$spot->name}}">
    @endif

    <textarea name="spot[description]">{{$spot->description}}</textarea>

    <label>
        <input type="checkbox" name="spot[bus]" value="1" {{$spot->bus ? 'checked' : ''}}> Accessible by Bus
    </label>

    <label>
        <input type="checkbox" name="spot[car]" value="1" {{$spot->car ? 'checked' : ''}}> Accessible by Car
    </label>

    <label>
        <input type="checkbox" name="spot[bike]" value="1" {{$spot->bike ? 'checked' : ''}}> Accessible by Bike
    </label>

    <button type="submit">Create Spot</button>
</form>
