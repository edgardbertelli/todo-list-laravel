<x-app-layout>

    @include('tasks.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <x-forms.form action="{{ route('tasks.store') }}" method='POST' novalidate>

                        {{-- Title --}}
                        <div>
                            <x-input-label for="title" value="tasks.create_form_input_label_title" />
                            <x-text-input id="title"
                                          name="title"
                                          class="@error('title') is-invalid @enderror"
                                          autofocus
                                          required />
                            @error('title')
                                <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mt-4">
                            <x-input-label for="description" value="tasks.create_form_input_label_description" />
                            <x-forms.textarea id="description"
                                              name="description"
                                              class="@error('description') is-invalid @enderror"
                                              rows="5"
                                              cols="60"
                                              required />
                        </div>

                        {{-- Checklist's ID --}}
                        <div class="mt-4">
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
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('tasks.create_form_submit_button') }}
                            </x-primary-button>
                        </div>
                    </x-forms.form>
                </div>
            </x-card>
        </div>
    </div>

</x-app-layout>