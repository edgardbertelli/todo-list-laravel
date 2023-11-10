<x-app-layout>
   
    @include('tasks.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="p-6 text-gray-900">
                    <p><strong>{{ __('Title: ') }}</strong>{{ $task->title }}</p>
                    <p><strong>{{ __('Description: ') }}</strong>@isset ($task->description) {{ $task->description }} @endisset</p>
                    <p><strong>{{ __('Checklist: ') }}</strong>{{ $task->checklist_name }}</p>
                    <p><strong>{{ __('Category: ') }}</strong>{{ $task->category_name }}</p>
                    <p><strong>{{ __('Created at ') }}</strong>{{ $task->created_at }}</p>
                    <p><strong>{{ __('Updated at ') }}</strong>{{ $task->updated_at }}</p>
                </div>
                <a href="{{ route('tasks.edit', $task->slug) }}">
                    <x-primary-button>
                        {{ __('Edit') }}
                    </x-primary-button>
                </a>
                <x-forms.form action="{{ route('tasks.destroy', $task->slug) }}" method="POST" request_path="{{ Route::currentRouteName() }}">
                    <x-danger-button>
                        {{ __('Remove') }}
                    </x-danger-button>
                </x-forms.form>
            </x-card>
        </div>
    </div>
</x-app-layout>
