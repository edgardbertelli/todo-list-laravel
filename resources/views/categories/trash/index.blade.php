<x-app-layout>
    
    @include('categories.header')

    @section('title', 'Categories')

    <x-container>

        <x-link href="{{ route('categories.index') }}">
            <x-secondary-button type="button">
                {{ __('categories.back_button') }}
            </x-secondary-button>
        </x-link>

        @if($categories->count() === 0)
            <x-alert class="bg-yellow-200">
                <p>I'm sorry, {{ Auth::user()->name }}. You don't have any categories registered yet.<br>
                    But go ahead and <b><a href="{{ route('categories.create') }}">click here</a></b> to create a new one
                    right now.
                </p>
            </x-alert>
        @else
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-6">
                @foreach ($categories as $category)
                    <x-link href="{{ route('categories.show', $category->id) }}">
                        <x-card title="{{ $category->name }}">
                            {{ $category->name }}
                        </x-card>
                    </x-link>
                @endforeach
            </div>            
        @endif
    </x-container>
</x-app-layout>
