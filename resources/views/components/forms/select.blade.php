<label for="{{ $id }}">{{ $label }}</label>

<select name="{{ $name }}" id="{{ $id }}">
    @foreach ($collection as $item)
        <option value="{{ $item->value }}">{{ $item->name }}</option>
    @endforeach
</select>
