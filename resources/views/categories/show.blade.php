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
                <x-link href="{{ route('categories.index') }}">
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

                    <div class="flex justify-between">
                        <div>
                            <a href="{{ route('categories.edit', ['id' => $category->id]) }}">
                                <x-primary-button>
                                    {{ __('categories.show_page_edit_button') }}
                                </x-primary-button>
                            </a>
                        </div>
    
                        <div>
                            <x-forms.form action="{{ route('categories.destroy', ['id' => $category->id]) }}"
                                          method="POST">
                                @method('DELETE')
                                <x-danger-button>
                                    {{ __('categories.show_page_remove_button') }}
                                </x-danger-button>
                            </x-forms.form>
                        </div>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
