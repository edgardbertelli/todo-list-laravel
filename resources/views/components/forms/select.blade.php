<select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 shadow-sm']) }}>
    {{ $slot }}
</select>
