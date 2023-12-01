<x-app-layout>

    @include('teams.header')

    <x-container>
        @if (session('status_message'))
            <x-alert class="bg-green-200 mb-6">
                {{ session('status_message') }}
            </x-alert>
        @endif

        <div>
            <x-link href="{{ route('teams.create') }}">
                <x-primary-button type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('teams.create_team_button') }}
                </x-primary-button>
            </x-link>
        </div>

        @if ($teams->count() === 0)
            <x-alert class="bg-yellow-200">
                <p>I'm sorry, {{ Auth::user()->name }}. You don't have any teams registered yet.<br>
                    But go ahead and <b><a href="{{ route('teams.create') }}">click here</a></b> to create a new one
                    right now.
                </p>
            </x-alert>
        @else
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-6">
                @foreach ($teams as $team)
                    <x-card>
                        <div class="text-lg mb-4">
                            <x-link href="{{ route('teams.show', ['id' => $team->id]) }}" title="{{ $team->name }}">
                                <p><strong>{{ $team->name }}</strong></p>
                            </x-link>
                        </div>
                        <div class="text-sm mb-4">
                            <p>
                                @isset($team->description)
                                    {{ $team->description }}
                                @endisset
                            </p>
                        </div>
                        <div class="text-xs text-gray-400">
                            <p>{{ __("Criado por {$team->created_by->name}") }}</p>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </x-container>
</x-app-layout>
