<x-app-layout>
   
    @include('checklists.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <x-forms.form action="{{ route('checklists.store') }}"
                                  method="POST"
                                  novalidate>

                        <x-input-label for="name" value="checklists.create_form_input_label_name" />
                        <x-text-input id="name"
                                      name="name"
                                      value="{{ old('name') }}"
                                      class="@error('name') is-invalid @enderror"
                                      required />
                        @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="mt-4">
                            <x-input-label for="categories" value="checklists.create_form_input_label_category" />
                            <x-forms.select id="categories" 
                                            name="category"
                                            class="@error('category') is-invalid @enderror"
                                            required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-forms.select>
                            @error('category')
                                <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('checklists.create_form_submit_button') }}
                            </x-primary-button>
                        </div>
                    </x-forms.form>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
