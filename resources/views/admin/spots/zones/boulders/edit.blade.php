@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1>Editar Boulder: "{{$boulder->name}}"</h1>
<a href="{{route('boulders.index', [$spot, $zone])}}"><p>Volver</p></a>
<form action="{{route('boulders.update', [$spot, $zone, $boulder])}}" method="POST">
    @csrf
    @method('PUT')
    <label for="boulder-name">Nombre del Boulder</label>
    <input id="boulder-name" type="text" name="boulder[name]" value="{{$boulder->name}}">

    <label for="boulder-grade">Grado</label>
    <select id="boulder-grade" name="boulder[grade]">
        <option value="" disabled>-- Selecione Uno --</option>
        @foreach ($boulderGrades as $boulderGrade)
            <option value="{{$boulderGrade->id}}" {{$boulderGrade->id === $boulder->grade_id ? 'selected' : ''}}>{{$boulderGrade->boulder_grade}}</option>
        @endforeach
    </select>

    <label for="boulder-image">Imagen del Boulder <span>(opcional)</span></label>
    <input id="boulder-image" type="file" name="boulder[image]">
    @if ($boulder->image)
        <img src="{{asset('storage/images/spots/zones/boulders' . $boulder->image)}}" alt="Imagen Boulder {{$boulder->name}}">
    @endif

    <label for="boulder-details">Detalles del Boulder <span>(opcional)</span></label>
    <textarea id="boulder-details" name="boulder[details]" cols="30" rows="10">{{$boulder->details}}</textarea>

    <button type="submit">Editar Boulder</button>
</form>
