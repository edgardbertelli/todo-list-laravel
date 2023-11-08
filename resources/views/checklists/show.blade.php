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
                    <p><strong>{{ __('Name: ') }}</strong>{{ $checklist->name }}</p>
                    <p><strong>{{ __('Category: ') }}</strong>{{ $checklist->category_name }}</p>
                    <p><strong>{{ __('Created at ') }}</strong>{{ $checklist->created_at }}</p>
                    <p><strong>{{ __('Updated at ') }}</strong>{{ $checklist->updated_at }}</p>
                </div>
                <a href="{{ route('checklists.edit', $checklist->slug) }}">
                    <x-primary-button>
                        {{ __('Edit') }}
                    </x-primary-button>
                </a>
                <x-forms.form action="{{ route('checklists.destroy', $checklist->slug) }}" method="POST" request_path="destroy">
                    <x-danger-button>
                        {{ __('Remove') }}
                    </x-danger-button>
                </x-forms.form>
            </x-card>
        </div>
    </div>
</x-app-layout>
