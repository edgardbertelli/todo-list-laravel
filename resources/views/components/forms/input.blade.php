<div>
    <x-input-label for="{{ $id }}" :value="__($label)" />
    <x-text-input id="{{ $id }}" class="block mt-1 w-full" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" required autofocus />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>