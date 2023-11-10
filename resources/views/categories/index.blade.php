<x-app-layout>
    
    @include('categories.header')

    <a href="{{ route('categories.create') }}">
        <x-primary-button type="button">
            {{ __('Create category') }}
        </x-primary-button>
    </a>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="p-6 text-gray-900">
            @forelse ($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}">
                <x-card>
                    {{ $category->name }}
                </x-card>
            </a>
            @empty
            <x-alert>
                <p>I'm sorry, {{ Auth::user()->name }}. You don't have any categories registered yet.<br>
                    But go ahead and <b><a href="{{ route('categories.create') }}">click here</a></b> to create a new one
                    right now.
                </p>
            </x-alert>
            @endforelse
        </div>
    </div>
</x-app-layout>
