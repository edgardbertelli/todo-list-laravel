<x-app-layout>
    
    @include('projects.header')

    <x-container>

            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif

            <div class="mb-4">
                <x-link href="{{ route('projects.show', $project->id) }}">
                    <x-secondary-button>
                        {{ __('projects.back_button') }}
                    </x-secondary-button>
                </x-link>
            </div>
            
            <x-card>
                <div class="p-6">
                    <div class="mb-6">
                        <p><strong>{{ __('projects.show_page_name') }}: </strong>{{ $project->name }}</p>
                        <p><strong>{{ __('projects.show_page_created_at') }}: </strong>{{ $project->created_at }}</p>
                        <p><strong>{{ __('projects.show_page_updated_at') }}: </strong>{{ $project->updated_at }}</p>
                    </div>

                    <p class="mb-6">{{ __('projects.delete_confirm_message') }}</p>
                    
                    <div>
                        <x-forms.form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                            @method('DELETE')
                            <x-danger-button type="submit">
                                {{ __('projects.show_page_remove_button') }}
                            </x-danger-button>
                        </x-forms.form>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
