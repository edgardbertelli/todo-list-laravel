<x-app-layout>
    
    @include('checklists.header')

    <x-container>

            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif

            <div class="mb-4">
                <x-link href="{{ route('checklists.show', $checklist->id) }}">
                    <x-secondary-button>
                        {{ __('checklists.back_button') }}
                    </x-secondary-button>
                </x-link>
            </div>
            
            <x-card>
                <div class="p-6">
                    <div class="mb-6">
                        <p><strong>{{ __('checklists.show_page_name') }}: </strong>{{ $checklist->name }}</p>
                        <p><strong>{{ __('checklists.show_page_created_at') }}: </strong>{{ $checklist->created_at }}</p>
                        <p><strong>{{ __('checklists.show_page_updated_at') }}: </strong>{{ $checklist->updated_at }}</p>
                    </div>

                    <p class="mb-6">{{ __('checklists.delete_confirm_message') }}</p>
                    
                    <div>
                        <x-forms.form action="{{ route('checklists.destroy', $checklist->id) }}" method="POST">
                            @method('DELETE')
                            <x-danger-button type="submit">
                                {{ __('checklists.show_page_remove_button') }}
                            </x-danger-button>
                        </x-forms.form>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
