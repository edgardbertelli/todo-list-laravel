<x-app-layout>

    @include('tasks.header')

    <x-container>

        @if (session('status_message'))
            <x-alert class="bg-green-200 mb-6">
                {{ session('status_message') }}
            </x-alert>
        @endif

        <div class="mb-4">
            <x-link href="{{ route('tasks.index') }}">
                <x-secondary-button>
                    {{ __('tasks.back_button') }}
                </x-secondary-button>
            </x-link>
        </div>

        <x-card>
            <div class="p-6">
                <div class="mb-6">
                    <p><strong>{{ __('tasks.show_page_title') }}: </strong>{{ $task->title }}</p>
                    <p><strong>{{ __('tasks.show_page_description') }}: </strong>
                        @isset($task->description)
                            {{ $task->description }}
                        @endisset
                    </p>
                    <p><strong>{{ __('tasks.show_page_checklist') }}: </strong>{{ $task->checklist_name }}</p>
                    <p><strong>{{ __('tasks.show_page_category') }}: </strong>{{ $task->category_name }}</p>
                    <p><strong>{{ __('tasks.show_page_created_at') }}: </strong>{{ $task->created_at }}</p>
                    <p><strong>{{ __('tasks.show_page_updated_at') }}: </strong>{{ $task->updated_at }}</p>
                </div>

                <div class="flex justify-between">
                    <div>
                        <a href="{{ route('tasks.edit', $task->id) }}">
                            <x-primary-button>
                                {{ __('tasks.show_page_edit_button') }}
                            </x-primary-button>
                        </a>
                    </div>
                    <div>
                        <x-link href="{{ route('tasks.delete', $task->id) }}">
                            <x-danger-button>
                                {{ __('tasks.show_page_remove_button') }}
                            </x-danger-button>
                        </x-link>
                    </div>
                </div>
            </div>

        </x-card>
    </x-container>

</x-app-layout>
