<h1>Crear nuevo spot</h1>
<a href="{{route('spots.index')}}">Volver</a>
<form action="{{ route('spots.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="spot-name">Nombre Spot</label>
    <input id="spot-name" type="text" name="spot[name]" placeholder="Name">

    <label for="spot-climbing-type">Tipo de Escalada</label>
    <select id="spot-climbing-type" name="spot[climbing_type_id]">
        <option value="" selected disabled>-- Selecciona Uno --</option>
        @foreach ($climbingTypes as $climbingType)
            <option value="{{$climbingType->id}}">{{$climbingType->name}}</option>
        @endforeach
    </select>

    <label for="spot-image">Imagen del Spot</label>
    <input id="spot-image" type="file" name="spot[image]">

    <label for="spot-description">Descripción</label>
    <textarea id="spot-description" name="spot[description]" cols="30" rows="10"></textarea>

    <label>
        <input type="checkbox" name="spot[bus]" value="1"> Accessible by Bus
    </label>

    <label>
        <input type="checkbox" name="spot[car]" value="1"> Accessible by Car
    </label>

    <label>
        <input type="checkbox" name="spot[bike]" value="1"> Accessible by Bike
    </label>

    <button type="submit">Crear Spot</button>
</form>
