<x-app-layout>
  
    @include('categories.header')

    @section('title', 'Categories')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <x-forms.form action="{{ route('categories.update', $category->slug) }}"
                                  method="POST"
                                  novalidate>
                        @method('PUT')

                        <x-input-label for="name" value="categories.edit_form_input_label_name" />

                        <x-text-input id="name" 
                                      name="name"
                                      type="text"
                                      class="@error('name') is-invalid @enderror"
                                      :value="$category->name"
                                      required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />


                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('categories.edit_form_update_button') }}
                            </x-primary-button>
                        </div>
                    </x-forms.form>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
