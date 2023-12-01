<x-app-layout>
    
    @include('teams.header')

    <x-container>

            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif

            <div class="mb-4">
                <x-link href="{{ route('teams.show', $team->id) }}">
                    <x-secondary-button>
                        {{ __('teams.back_button') }}
                    </x-secondary-button>
                </x-link>
            </div>
            
            <x-card>
                <div class="p-6">
                    <div class="mb-6">
                        <p><strong>{{ __('teams.show_page_name') }}: </strong>{{ $team->name }}</p>
                        <p><strong>{{ __('teams.show_page_description') }}: </strong>{{ $team->description }}</p>
                        <p><strong>{{ __('teams.show_page_created_at') }}: </strong>{{ $team->created_at }}</p>
                        <p><strong>{{ __('teams.show_page_updated_at') }}: </strong>{{ $team->updated_at }}</p>
                    </div>

                    <p class="mb-6">{{ __('teams.delete_confirm_message') }}</p>
                    
                    <div>
                        <x-forms.form action="{{ route('teams.destroy', $team->id) }}" method="POST">
                            @method('DELETE')
                            <x-danger-button type="submit">
                                {{ __('teams.show_page_remove_button') }}
                            </x-danger-button>
                        </x-forms.form>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
