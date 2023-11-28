<x-app-layout>
    
    @include('checklists.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('checklists.show', $checklist->id) }}">
                <x-secondary-button>
                    {{ __('checklists.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>

        <x-card>
            <div class="p-6 text-gray-900">
                <x-forms.form action="{{ route('checklists.update', $checklist->id) }}"
                              method="POST"
                              novalidate>
                    @method('PUT')

                    <div>
                        <x-input-label for="name" value="checklists.edit_form_input_label_name" />
                        <x-text-input id="name"
                                      name="name"
                                      class="@error('name') is-invalid @enderror"
                                      :value="$checklist->name"
                                      required />
                        @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    
    
                    <div class="mt-4 mb-6">
                        <x-input-label for="categories" value="checklists.edit_form_input_label_category" />
                        <x-forms.select id="categories" 
                                        name="category"
                                        class="@error('category') is-invalid @enderror"
                                        required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($checklist->category_name == $category->name)>{{ $category->name }}</option>
                            @endforeach
                        </x-forms.select>
                        @error('category')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <x-primary-button>
                            {{ __('checklists.edit_form_update_button') }}
                        </x-primary-button>
                    </div>
                </x-forms.form>
            </div>
        </x-card>
    </x-container>
   

</x-app-layout>
