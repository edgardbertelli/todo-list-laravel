<x-app-layout>

    @include('tasks.header')

    <x-container>

        <x-link href="{{ route('tasks.index') }}">
            <x-secondary-button type="button">
                {{ __('tasks.back_button') }}
            </x-secondary-button>
        </x-link>

        @if ($tasks->count() === 0)
            <x-alert class="bg-yellow-200">
                <p>I'm sorry, {{ Auth::user()->name }}. You don't have any tasks registered yet.<br>
                    But go ahead and <b><a href="{{ route('tasks.create') }}">click here</a></b> to create a new one
                    right now.
                </p>
            </x-alert>
        @else
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-6">
                @foreach ($tasks as $task)
                    <x-card title="{{ $task->title }}">
                        <div class="flex justify-between">
                            <div class="text-gray-400">
                                {{ $task->title }}
                            </div>
                            <div>
                                <x-forms.form action="{{ route('tasks.restore', $task->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    <x-secondary-button type="submit"
                                        title="{{ __('tasks.trash_restore_button') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                        </svg>
                                    </x-secondary-button>
                                </x-forms.form>
                                <x-forms.form action="{{ route('tasks.force', $task->id) }}"
                                    method="POST">
                                    @method('DELETE')
                                    <x-danger-button type="submit" title="{{ __('tasks.force') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </x-danger-button>
                                </x-forms.form>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </x-container>
</x-app-layout>
