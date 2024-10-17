<h1>Administración del Blog</h1>
<a href="{{route('admin.panel')}}"><h3>Volver al panel</h3></a>
<a href="{{route('climbing-types.index')}}"><h4>Ver Tipos de Escalada</h4></a>
@foreach ($entries as $entry)
    <a href="{{route('entries.edit', $entry->id)}}">
        <p>{{$entry->title}}</p>
    </a>
@endforeach
<a href="{{route('entries.create')}}"><button>Crear Entrada</button></a>
