<x-app-layout>
    
    @include('checklists.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif

            <x-card>
                <div class="p-6 text-gray-900">
                    <p><strong>{{ __('checklists.show_page_name') }}: </strong>{{ $checklist->name }}</p>
                    <p><strong>{{ __('checklists.show_page_category') }}: </strong>{{ $checklist->category_name }}</p>
                    <p><strong>{{ __('checklists.show_page_created_at') }}: </strong>{{ $checklist->created_at }}</p>
                    <p><strong>{{ __('checklists.show_page_updated_at') }}: </strong>{{ $checklist->updated_at }}</p>
                </div>
                <a href="{{ route('checklists.edit', $checklist->slug) }}">
                    <x-primary-button>
                        {{ __('checklists.show_page_edit_button') }}
                    </x-primary-button>
                </a>
                <x-forms.form action="{{ route('checklists.destroy', $checklist->slug) }}" method="POST">
                    @method('DELETE')
                    <x-danger-button>
                        {{ __('checklists.show_page_remove_button') }}
                    </x-danger-button>
                </x-forms.form>
            </x-card>
        </div>
    </div>
</x-app-layout>
