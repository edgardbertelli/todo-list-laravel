<x-app-layout>

    @include('tasks.header')

    <x-container>
        @if (session('status_message'))
            <x-alert class="bg-green-200 mb-6">
                {{ session('status_message') }}
            </x-alert>
        @endif

        <a href="{{ route('tasks.create') }}">
            <x-primary-button type="button">
                {{ __('tasks.create_task_button') }}
            </x-primary-button>
        </a>
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="p-6 text-gray-900">
                @if ($tasks->count() === 0)
                    <x-alert class="bg-yellow-200">
                        <p>
                            I'm sorry, {{ Auth::user()->name }}. You don't have any tasks registered yet.<br>
                            But go ahead and <b><a href="{{ route('tasks.create') }}">click here</a></b> to create a new one
                            right now.
                        </p>
                    </x-alert>
                @else
                    @foreach ($tasks as $task)
                        <a href="{{ route('tasks.show', $task->slug) }}">
                            <x-card>
                                <strong>{{ $task->title }}</strong>
                                <p>{{ $task->description }}</p>
                            </x-card>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </x-container>

</x-app-layout>
