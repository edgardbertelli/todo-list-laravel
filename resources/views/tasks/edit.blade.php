<x-app-layout>
    
    @include('tasks.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('tasks.show', $task->id) }}">
                <x-secondary-button>
                    {{ __('checklists.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>

        <x-card>
            <div class="p-6 text-gray-900">
                <x-forms.form action="{{ route('tasks.update', $task->id) }}"
                              method="POST"
                              novalidate>
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-14">
                        <x-input-label for="title" value="tasks.create_form_input_label_title" />
                        <x-text-input id="title"
                                      name="title"
                                      class="@error('title') is-invalid @enderror"
                                      value="{{ $task->title }}"
                                      autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <x-input-label for="description" value="tasks.create_form_input_label_description" />
                        <x-forms.textarea id="description"
                                          name="description"
                                          class="@error('description') is-invalid @enderror"
                                          rows="5"
                                          cols="60">
                        @if ($task->description) {{ $task->description }} @endif
                        </x-forms.textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Checklist's ID --}}
                    <div class="mb-6">
                        <x-input-label for="checklists" value="tasks.create_form_input_label_checklist" />
                        <x-forms.select id="checklists"
                                        name="checklist_id"
                                        class="@error('checklist_id') is-invalid @enderror">
                            @foreach ($checklists as $checklist)
                                <option value="{{ $checklist->id }}" @selected($checklist->id == $task->checklist_id)>
                                    {{ $checklist->name }}
                                </option>
                            @endforeach
                        </x-forms.select>
                        <x-input-error :messages="$errors->get('checklist_id')" class="mt-2" />
                    </div>

                    {{-- Submit button --}}
                    <div>
                        <x-primary-button>
                            {{ __('tasks.edit_form_update_button') }}
                        </x-primary-button>
                    </div>
                </x-forms.form>
            </div>
        </x-card>
    </x-container>
  
</x-app-layout>
