<x-app-layout>
    
    @include('categories.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <p><strong>{{ __('Name: ') }}</strong>{{ $category->name }}</p>
                    <p><strong>{{ __('Created at ') }}</strong>{{ $category->created_at }}</p>
                    <p><strong>{{ __('Updated at ') }}</strong>{{ $category->updated_at }}</p>
                </div>
                <a href="{{ route('categories.edit', $category->slug) }}">
                    <x-primary-button>
                        {{ __('Edit') }}
                    </x-primary-button>
                </a>
                <x-forms.form action="{{ route('categories.destroy', $category->slug) }}" method="POST" request_path="{{ Route::currentRouteName() }}">
                    <x-danger-button>
                        {{ __('Remove') }}
                    </x-danger-button>
                </x-forms.form>
            </x-card>
        </div>
    </div>
</x-app-layout>
