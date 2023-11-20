<x-app-layout>
    
    @include('categories.header')

    <x-container>
        <x-link href="{{ route('categories.create') }}">
            <x-primary-button type="button">
                {{ __('Create category') }}
            </x-primary-button>
        </x-link>

        <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-6">
            @foreach ($categories as $category)
                <x-link href="{{ route('categories.show', $category->slug) }}">
                    <x-card title="{{ $category->name }}">
                        {{ $category->name }}
                    </x-card>
                </x-link>
            @endforeach
        </div>

        {{-- <x-alert>
            <p>I'm sorry, {{ Auth::user()->name }}. You don't have any categories registered yet.<br>
                But go ahead and <b><a href="{{ route('categories.create') }}">click here</a></b> to create a new one
                right now.
            </p>
        </x-alert> --}}
    </x-container>
</x-app-layout>
