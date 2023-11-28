<x-app-layout>

    @include('tasks.header')

<x-container>
    <div class="mb-4">
        <x-link href="{{ route('tasks.index') }}">
            <x-secondary-button>
                {{ __('tasks.back_button') }}
            </x-secondary-button>
        </x-link>
    </div>
    
    <x-card>
        <div class="p-6 text-gray-900">
            <x-forms.form action="{{ route('tasks.store') }}" method='POST' novalidate>

                {{-- Title --}}
                <div class="mb-4">
                    <x-input-label for="title" value="tasks.create_form_input_label_title" />
                    <x-text-input id="title"
                                  name="title"
                                  class="@error('title') is-invalid @enderror"
                                  value="{{ old('title') }}"
                                  autofocus
                                  required />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <x-input-label for="description" value="tasks.create_form_input_label_description" />
                    <x-forms.textarea id="description"
                                      name="description"
                                      class="@error('description') is-invalid @enderror"
                                      rows="5"
                                      cols="60"
                                      required />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                {{-- Checklist's ID --}}
                <div class="mb-6">
                    <x-input-label for="checklists" value="tasks.create_form_input_label_checklist" />
                    <x-forms.select id="checklists"
                                    name="checklist_id"
                                    class="@error('checklist_id') is-invalid @enderror"
                                    required>
                        @foreach ($checklists as $checklist)
                            <option value="{{ $checklist->id }}">
                                {{ $checklist->name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                    <x-input-error :messages="$errors->get('checklist_id')" class="mt-2" />
                </div>

                {{-- Submit button --}}
                <div class="mt-4">
                    <x-primary-button>
                        {{ __('tasks.create_form_submit_button') }}
                    </x-primary-button>
                </div>
            </x-forms.form>
        </div>
    </x-card>
</x-container>


</x-app-layout>