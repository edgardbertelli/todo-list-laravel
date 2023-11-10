<form action="{{ $action }}" {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf

    @if ($requestPath === 'categories.update' || $requestPath === 'checklists.update' || $requestPath === 'tasks.update')
        @method('PUT')
    @endif

    @if ($requestPath === 'categories.destroy' || $requestPath === 'checklists.destroy' || $requestPath === 'tasks.destroy')
        @method('DELETE')
    @endif
    
    {{ $slot }}
</form>