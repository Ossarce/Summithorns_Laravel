<h1>Administración del Blog</h1>
@foreach ($entries as $entry)
    <a href="{{route('entries.edit', $entry->id)}}">
        <p>{{$entry->title}}</p>
    </a>
@endforeach
<a href="{{route('entries.create')}}"><button>Crear Entrada</button></a>
