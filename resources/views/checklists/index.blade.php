<x-app-layout>
 
    @include('checklists.header')

    <x-container>
        @if (session('status_message'))
            <x-alert class="bg-green-200 mb-6">
                {{ session('status_message') }}
            </x-alert>
        @endif

        <a href="{{ route('checklists.create') }}">
            <x-primary-button type="button">
                {{ __('checklists.create_checklist_button') }}
            </x-primary-button>
        </a>
        
        @if ($checklists->count() === 0)
            <x-alert class="bg-yellow-200">
                <p>I'm sorry, {{ Auth::user()->name }}. You don't have any checklists registered yet.<br>
                    But go ahead and <b><a href="{{ route('checklists.create') }}">click here</a></b> to create a new one
                    right now.
                </p>
            </x-alert>
        @else
            
        @endif
        <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-6">
            @foreach ($checklists as $checklist)
                <x-link href="{{ route('checklists.show', $checklist->id) }}">
                    <x-card title="{{ $checklist->name }}">
                        {{ $checklist->name }}
                    </x-card>
                </x-link>
            @endforeach
        </div>
    </x-container>

</x-app-layout>
