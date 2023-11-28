<x-app-layout>
    
    @include('tasks.header')

    @section('title', 'tasks')

    <x-container>

            @if (session('status_message'))
                <x-alert class="bg-green-200 mb-6">
                    {{ session('status_message') }}
                </x-alert>
            @endif

            <div class="mb-4">
                <x-link href="{{ route('tasks.show', $task->id) }}">
                    <x-secondary-button>
                        {{ __('tasks.back_button') }}
                    </x-secondary-button>
                </x-link>
            </div>
            
            <x-card>
                <div class="p-6">
                    <div class="mb-6">
                        <p><strong>{{ __('tasks.show_page_title') }}: </strong>{{ $task->title }}</p>
                        <p><strong>{{ __('tasks.show_page_created_at') }}: </strong>{{ $task->created_at }}</p>
                        <p><strong>{{ __('tasks.show_page_updated_at') }}: </strong>{{ $task->updated_at }}</p>
                    </div>

                    <p class="mb-6">{{ __('tasks.delete_confirm_message') }}</p>
                    
                    <div>
                        <x-forms.form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @method('DELETE')
                            <x-danger-button type="submit">
                                {{ __('tasks.show_page_remove_button') }}
                            </x-danger-button>
                        </x-forms.form>
                    </div>
                </div>
            </x-card>
    </x-container>
</x-app-layout>
