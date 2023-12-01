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
                        <x-forms.form action="{{ route('teams.attach', $team->id) }}"
                                      method="POST"
                                      novalidate>
                                      
                            {{-- E-mail --}}
                            <div>
                                <x-input-label for="email" value="teams.create_form_input_label_email" />
                                <x-text-input id="email"
                                              name="email"
                                              type="email"
                                              class="@error('email') is-invalid @enderror"
                                              value="{{ old('email') }}"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            {{-- Submit button --}}
                            <div class="mt-6">
                                <x-primary-button>
                                    {{ __('teams.attach_member_submit_button') }}
                                </x-primary-button>
                            </div>
                        </x-forms.form>
                    </div>
                </x-card>
            </div>
        </div>
    </x-container>
</x-app-layout>
