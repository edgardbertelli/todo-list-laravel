<form action="{{ $action }}" {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf
    
    {{ $slot }}
</form>