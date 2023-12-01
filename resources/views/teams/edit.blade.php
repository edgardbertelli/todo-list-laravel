<x-app-layout>
    
    @include('teams.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('teams.show', $team->id) }}">
                <x-secondary-button>
                    {{ __('teams.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>
        
        <div class="rows-1">
            <div class="columns-1">
                <x-card>
                    <div class="p-6">
                        <x-forms.form action="{{ route('teams.update', $team->id) }}"
                                      method="POST"
                                      novalidate>

                            @method('PUT')
                                      
                            {{-- Name --}}
                            <div>
                                <x-input-label for="name" value="teams.update_form_input_label_name" />
                                <x-text-input id="name"
                                              name="name"
                                              type="text"
                                              class="@error('name') is-invalid @enderror"
                                              value="{{ $team->name }}"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- Description --}}
                            <div class="mt-4">
                                <x-input-label for="description" value="teams.update_form_input_label_description" />
                                <x-forms.textarea id="description"
                                                  name="description"
                                                  class="@error('description') is-invalid @enderror"
                                                  rows="5"
                                                  cols="60"
                                                  required>
                                    @isset($team->description)
                                        {{ $team->description }}
                                    @endisset
                                </x-forms.textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            {{-- Submit button --}}
                            <div class="mt-6">
                                <x-primary-button>
                                    {{ __('teams.update_form_submit_button') }}
                                </x-primary-button>
                            </div>
                        </x-forms.form>
                    </div>
                </x-card>
            </div>
        </div>
    </x-container>
</x-app-layout>
