<x-app-layout>
    
    @include('projects.header')

    @section('title', 'projects')

    <x-container>

            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif

            <div class="mb-4">
                <x-link href="{{ route('projects.index') }}">
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

                    <div class="flex justify-between">
                        <div>
                            <a href="{{ route('projects.edit', $project->id) }}">
                                <x-primary-button>
                                    {{ __('projects.show_page_edit_button') }}
                                </x-primary-button>
                            </a>
                        </div>
    
                        <div>
                            <x-link href="{{ route('projects.delete', $project->id) }}">
                                <x-danger-button>
                                    {{ __('projects.show_page_remove_button') }}
                                </x-danger-button>
                            </x-link>
                        </div>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
