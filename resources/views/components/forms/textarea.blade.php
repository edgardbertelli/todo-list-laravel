<label for="{{ $id }}">{{ $label }}</label>

<textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" cols="{{ $cols }}">
    {{ $slot }}
</textarea>
