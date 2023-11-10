<x-app-layout>
    
    @include('categories.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <x-forms.form action="{{ route('categories.store') }}" method="POST" request_path="">
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" required/>
                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </x-forms.form>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
