<form action="{{ $action }}" method="{{ $method }}">
    @csrf

    @if ($requestPath === 'update')
        @method('PUT')
    @endif

    @if ($requestPath === 'destroy')
        @method('DELETE')
    @endif
    
    {{ $slot }}
</form>
