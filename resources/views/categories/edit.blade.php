<x-app-layout>

    @include('categories.header')

    @section('title', 'Categories')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('categories.show', $category->id) }}">
                <x-secondary-button>
                    {{ __('categories.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>

        <x-card>
            <div class="p-6 text-gray-900">
                <x-forms.form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST"
                    novalidate>
                    @method('PUT')

                    <x-input-label for="name" value="categories.edit_form_input_label_name" />

                    <x-text-input id="name" name="name" type="text" class="@error('name') is-invalid @enderror"
                        :value="$category->name" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />


                    <div class="mt-4">
                        <x-primary-button>
                            {{ __('categories.edit_form_update_button') }}
                        </x-primary-button>
                    </div>
                </x-forms.form>
            </div>
        </x-card>
    </x-container>
</x-app-layout>
