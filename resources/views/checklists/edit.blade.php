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
                        <x-input-label for="projects" value="checklists.edit_form_input_label_project" />
                        <x-forms.select id="projects" 
                                        name="project"
                                        class="@error('project') is-invalid @enderror"
                                        required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected($checklist->project_name == $project->name)>{{ $project->name }}</option>
                            @endforeach
                        </x-forms.select>
                        @error('project')
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
