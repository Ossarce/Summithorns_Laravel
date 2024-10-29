@props(['items'])

@if ($items->hasPages())
    <div class="contenedor">
        {{ $items->links() }}
    </div>
@endif
