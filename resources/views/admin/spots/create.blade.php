<h1>Crear nuevo spot</h1>
<a href="{{route('spots.index')}}">Volver</a>
<form action="{{ route('spots.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="spot[name]" placeholder="Name" required>

    <input type="file" name="spot[image]" required>

    <textarea name="spot[description]" placeholder="Description" required></textarea>

    <label>
        <input type="checkbox" name="spot[bus]" value="1"> Accessible by Bus
    </label>

    <label>
        <input type="checkbox" name="spot[car]" value="1"> Accessible by Car
    </label>

    <label>
        <input type="checkbox" name="spot[bike]" value="1"> Accessible by Bike
    </label>

    <button type="submit">Create Spot</button>
</form>
