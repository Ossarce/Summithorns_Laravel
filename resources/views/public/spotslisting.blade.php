<div class="contenedor-spots">
    @foreach ($spots as $spot)
    <div class="spot">
        <picture class="mini-pic">
            <img loading="lazy" src="{{ Storage::disk('s3')->url('summithorns/summithorns/images/spots/' . $spot->image) }}" alt="{{$spot->name}} Imagen">
        </picture>
        <div class="contenido-spot contenido-centrado">
            <div class="favorite-name-container">
                <h3>{{$spot->name}}</h3>
                <span class="like-icon {{ in_array($spot->id, $userFavorites) ? 'liked' : '' }} " data-spot-id="{{ $spot->id }}"></span>
            </div>
            <p>{{$spot->short_description}}</p>
            <ul class="guide-icons">
                @if($spot->bus == '1')
                    <li>
                        <img loading="lazy" src="{{ Storage::disk('s3')->url('images/base/iconbus.svg') }}" alt="Ícono Bus">
                    </li>
                @endif

                @if($spot->car == '1')
                    <li>
                        <img loading="lazy" src="{{ Storage::disk('s3')->url('images/base/iconcar.svg') }}" alt="Ícono Auto">
                    </li>
                @endif
                @if($spot->bike == '1')
                    <li>
                        <img loading="lazy" src="{{ Storage::disk('s3')->url('images/base/iconobicicleta.svg') }}" alt="Ícono Bicicleta">
                    </li>
                @endif
            </ul>
        </div>
        <a href="{{route('public.spot', $spot)}}" class="yellow-button-block-spot">Explorar</a>
    </div>
    @endforeach
</div>
