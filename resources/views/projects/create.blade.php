<x-app-layout>
    
    @include('projects.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('projects.index') }}">
                <x-secondary-button>
                    {{ __('projects.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>
        
        <div class="grid gap-4 grid-cols-2">
            <div>
                <x-card>
                    <div class="p-6">
                        <x-forms.form action="{{ route('projects.store') }}"
                                      method="POST"
                                      novalidate>

                            <div>
                                <x-input-label for="name" value="projects.create_form_input_label_name" />
                
                                <x-text-input id="name"
                                              name="name"
                                              type="text"
                                              class="@error('name') is-invalid @enderror"
                                              value="{{ old('name') }}"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="team" id="team" value="projects.create_form_input_label_team" />
                                <x-forms.select id="team" name="team">
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </x-forms.select>
                                <x-input-error :messages="$errors->get('team')" class="mt-2" />
                            </div>
            
                            <div class="mt-6">
                                <x-primary-button>
                                    {{ __('projects.create_form_submit_button') }}
                                </x-primary-button>
                            </div>
                        </x-forms.form>
                    </div>
                </x-card>
            </div>

            <div>
                <div class="table table-auto w-full">
                    <div class="table-header-group">
                        <div class="table-row">
                            <div class="table-cell text-left font-semibold">{{ __('Name') }}</div>
                            <div class="table-cell text-left font-semibold">{{ __('Created at') }}</div>
                        </div>
                    </div>

                    <div class="table-row-group">
                        @isset($projects)
                            @foreach ($projects as $project)
                                <div class="table-row">
                                    <div class="table-cell">{{ $project->name }}</div>
                                    <div class="table-cell">{{ $project->created_at }}</div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                  </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
