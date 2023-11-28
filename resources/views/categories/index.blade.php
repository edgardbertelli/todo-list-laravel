<x-app-layout>
    
    @include('categories.header')

    @section('title', 'Categories')

    <x-container>
        
        @if (session('status_message'))
            <x-alert class="bg-green-200 mb-6">
                {{ session('status_message') }}
            </x-alert>
        @endif

        <div class="flex justify-between">
            <div>
                <x-link href="{{ route('categories.create') }}">
                    <x-primary-button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>                          
                        {{ __('categories.create_category_button') }}
                    </x-primary-button>
                </x-link>
            </div>

            <div>
                <x-link href="{{ route('categories.trash.index') }}">
                    <x-secondary-button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                          </svg>
                        {{ __('categories.category_trash_button') }}
                    </x-secondary-button>
                </x-link>
            </div>
    
        </div>

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
