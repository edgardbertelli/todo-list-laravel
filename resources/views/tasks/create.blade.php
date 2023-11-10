<x-app-layout>
    
    @include('tasks.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <x-forms.form action="{{ route('tasks.store') }}" method="POST" request_path="">
                        <x-input-label for="title" value="Title" />

                        <x-text-input id="title" name="title" required />
                        
                        <x-forms.textarea id="description"
                                          name="description"
                                          label="{{ __('Description') }}"
                                          rows="4"
                                          cols="50"></x-forms.textarea>

                        <x-forms.select id="checklists" name="checklist_id" label="{{ __('Checklist') }}" required>
                            @foreach ($checklists as $checklist)
                                <option value="{{ $checklist->id }}">{{ $checklist->name }}</option>
                            @endforeach
                        </x-forms.select>
                       
                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </x-forms.form>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
