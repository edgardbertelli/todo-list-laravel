<x-app-layout>

    @include('projects.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('projects.show', $project->id) }}">
                <x-secondary-button>
                    {{ __('projects.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>

        <x-card>
            <div class="p-6 text-gray-900">
                <x-forms.form action="{{ route('projects.update', ['id' => $project->id]) }}" method="POST"
                    novalidate>
                    @method('PUT')

                    <x-input-label for="name" value="projects.edit_form_input_label_name" />

                    <x-text-input id="name" name="name" type="text" class="@error('name') is-invalid @enderror"
                        :value="$project->name" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />


                    <div class="mt-4">
                        <x-primary-button>
                            {{ __('projects.edit_form_update_button') }}
                        </x-primary-button>
                    </div>
                </x-forms.form>
            </div>
        </x-card>
    </x-container>
</x-app-layout>
