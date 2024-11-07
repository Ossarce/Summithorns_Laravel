<div class="contenedor seccion contenido-centrado" id="entries-container" data-current-page="1">
    @foreach($entries as $entry)
    <article class="blog-entry">
        <div class="imagen">
            <img class="mini-pic" loading="lazy" src="{{ Storage::disk('s3')->url('summithorns/summithorns/images/blog/' . $entry->image) }}" alt="Imagen Entrada: {{$entry->title}}">
        </div>
        <div class="entry-text">
        <a class="entry-container" href="{{route('public.entry', $entry)}}"><h4>{{$entry->title}}</h4></a>
            <div class="meta-info">
                <p>Autor:<a href="#"><span>{{$entry->user->username}}</span></a></p>
                <p class="date">Fecha: {{$entry->created_at->format('d-m-y')}}<span></span></p>
                <p class="category"> <a href="#">#{{$entry->entryCategory->category_name}}</a></p>
                <a class="entry-container" href="{{route('public.entry', $entry)}}">
                <p>{{$entry->short_description}}</a>
            </div>
    </article>
    @endforeach
</div>
