@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Navegación de páginas">
        <ul class="pagination__list">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="pagination__item pagination__item--disabled">
                    <span class="pagination__link" aria-hidden="true">&laquo; Anterior</span>
                </li>
            @else
                <li class="pagination__item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination__link" rel="prev"
                       aria-label="Anterior">&laquo; Anterior</a>
                </li>
            @endif

            {{-- Números de Página --}}
            @foreach ($elements as $element)
                {{-- Separador --}}
                @if (is_string($element))
                    <li class="pagination__item pagination__item--disabled">
                        <span class="pagination__link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Links de Páginas --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="pagination__item {{ $page == $paginator->currentPage() ? 'pagination__item--active' : '' }}">
                            @if ($page == $paginator->currentPage())
                                <span class="pagination__link" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination__link">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <li class="pagination__item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination__link" rel="next"
                       aria-label="Siguiente">Siguiente &raquo;</a>
                </li>
            @else
                <li class="pagination__item pagination__item--disabled">
                    <span class="pagination__link" aria-hidden="true">Siguiente &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
