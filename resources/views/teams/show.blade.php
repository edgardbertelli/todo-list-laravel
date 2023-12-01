<x-app-layout>
    
    @include('teams.header')

    <x-container>

            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif
            
            <div class="flex justify-between">
                <div class="mb-4">
                    <x-link href="{{ route('teams.index') }}">
                        <x-secondary-button>
                            {{ __('teams.back_button') }}
                        </x-secondary-button>
                    </x-link>
                </div>

                <div class="mb-4">
                    <x-link href="{{ route('teams.add', $team->id) }}">
                        <x-primary-button type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>       
                            {{ __('teams.add_member_button') }}
                        </x-primary-button>
                    </x-link>
                </div>
            </div>
            
            <x-card>
                <div class="p-6">
                    <div class="mb-6">
                        <p><strong>{{ __('teams.show_page_name') }}: </strong>{{ $team->name }}</p>
                        <p><strong>{{ __('teams.show_page_description') }}: </strong>{{ $team->description }}</p>
                        <ul>
                            <p><strong>Membros:</strong></p>
                            @foreach ($team->users as $user)
                                <li class="ml-4">{{ $user->username }}</li>
                            @endforeach
                        </ul>
                        <p><strong>{{ __('teams.show_page_created_at') }}: </strong>{{ $team->created_at }}</p>
                        <p><strong>{{ __('teams.show_page_updated_at') }}: </strong>{{ $team->updated_at }}</p>
                    </div>

                    <div class="flex justify-between">
                        <div>
                            <a href="{{ route('teams.edit', $team->id) }}">
                                <x-primary-button>
                                    {{ __('teams.show_page_edit_button') }}
                                </x-primary-button>
                            </a>
                        </div>
    
                        <div>
                            <x-link href="{{ route('teams.delete', $team->id) }}">
                                <x-danger-button>
                                    {{ __('teams.show_page_remove_button') }}
                                </x-danger-button>
                            </x-link>
                        </div>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
