<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checklists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <x-forms.form action="{{ route('checklists.update', $checklist->slug) }}" method="POST" request_path="update">
                        <x-forms.input id="name" name="name" label="Name" type="text" value="{{ $checklist->name }}" />
                        <div class="mt-4">
                            <label for="category">{{ __('Category') }}</label>
                            <select name="category_id" id="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($checklist->category_name == $category->name)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </x-forms.form>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
