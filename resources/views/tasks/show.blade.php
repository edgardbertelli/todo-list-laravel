<x-app-layout>
   
    @include('tasks.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <p><strong>{{ __('tasks.show_page_title') }}: </strong>{{ $task->title }}</p>
                    <p><strong>{{ __('tasks.show_page_description') }}: </strong>@isset ($task->description) {{ $task->description }} @endisset</p>
                    <p><strong>{{ __('tasks.show_page_checklist') }}: </strong>{{ $task->checklist_name }}</p>
                    <p><strong>{{ __('tasks.show_page_category') }}: </strong>{{ $task->category_name }}</p>
                    <p><strong>{{ __('tasks.show_page_created_at') }}: </strong>{{ $task->created_at }}</p>
                    <p><strong>{{ __('tasks.show_page_updated_at') }}: </strong>{{ $task->updated_at }}</p>
                </div>
                <a href="{{ route('tasks.edit', $task->slug) }}">
                    <x-primary-button>
                        {{ __('tasks.show_page_edit_button') }}
                    </x-primary-button>
                </a>
                <x-forms.form action="{{ route('tasks.destroy', $task->slug) }}" method="POST" request_path="{{ Route::currentRouteName() }}">
                    <x-danger-button>
                        {{ __('tasks.show_page_remove_button') }}
                    </x-danger-button>
                </x-forms.form>
            </x-card>
        </div>
    </div>
</x-app-layout>
