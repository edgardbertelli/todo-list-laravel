<x-app-layout>
   
    @include('checklists.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('checklists.index') }}">
                <x-secondary-button>
                    {{ __('checklists.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>

        <x-card>
            <div class="p-6">
                <x-forms.form action="{{ route('checklists.store') }}"
                              method="POST"
                              novalidate>

                    <div class="mb-4">
                        <x-input-label for="name" value="checklists.create_form_input_label_name" />
                        <x-text-input id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="@error('name') is-invalid @enderror"
                                    required />
                        @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <x-input-label for="projects" value="checklists.create_form_input_label_project" />
                        <x-forms.select id="projects" 
                                        name="project"
                                        class="@error('project') is-invalid @enderror"
                                        required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </x-forms.select>
                        @error('project')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <x-primary-button>
                            {{ __('checklists.create_form_submit_button') }}
                        </x-primary-button>
                    </div>
                </x-forms.form>
            </div>
        </x-card>
    </x-container>
 
</x-app-layout>
