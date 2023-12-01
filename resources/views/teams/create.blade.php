<x-app-layout>
    
    @include('teams.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('teams.index') }}">
                <x-secondary-button>
                    {{ __('teams.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>
        
        <div class="rows-1">
            <div class="columns-1">
                <x-card>
                    <div class="p-6">
                        <x-forms.form action="{{ route('teams.store') }}"
                                      method="POST"
                                      novalidate>
                                      
                            {{-- Name --}}
                            <div>
                                <x-input-label for="name" value="teams.create_form_input_label_name" />
                                <x-text-input id="name"
                                              name="name"
                                              type="text"
                                              class="@error('name') is-invalid @enderror"
                                              value="{{ old('name') }}"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- Description --}}
                            <div class="mt-4">
                                <x-input-label for="description" value="teams.create_form_input_label_description" />
                                <x-forms.textarea id="description"
                                                  name="description"
                                                  class="@error('description') is-invalid @enderror"
                                                  rows="5"
                                                  cols="60"
                                                  required />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            {{-- Submit button --}}
                            <div class="mt-6">
                                <x-primary-button>
                                    {{ __('teams.create_form_submit_button') }}
                                </x-primary-button>
                            </div>
                        </x-forms.form>
                    </div>
                </x-card>
            </div>
        </div>
    </x-container>
</x-app-layout>
