<x-app-layout>
    
    @include('categories.header')

    @section('title', 'Categories')

    <x-container>

            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif

            <div class="mb-4">
                <x-link href="{{ route('categories.show', $category->id) }}">
                    <x-secondary-button>
                        {{ __('categories.back_button') }}
                    </x-secondary-button>
                </x-link>
            </div>
            
            <x-card>
                <div class="p-6">
                    <div class="mb-6">
                        <p><strong>{{ __('categories.show_page_name') }}: </strong>{{ $category->name }}</p>
                        <p><strong>{{ __('categories.show_page_created_at') }}: </strong>{{ $category->created_at }}</p>
                        <p><strong>{{ __('categories.show_page_updated_at') }}: </strong>{{ $category->updated_at }}</p>
                    </div>

                    <p class="mb-6">{{ __('categories.delete_confirm_message') }}</p>
                    
                    <div>
                        <x-forms.form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @method('DELETE')
                            <x-danger-button type="submit">
                                {{ __('categories.show_page_remove_button') }}
                            </x-danger-button>
                        </x-forms.form>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
