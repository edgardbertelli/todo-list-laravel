<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Report - ' . now()) }}</title>
    </head>
    
    <body>
        {{-- Headline --}}
        <x-container>
            <x-card>
                <h1 class="font-bold text-center">{{ __('Report: ' . Auth::user()->username) }}</h1>
            </x-card>
        </x-container>

        {{-- projects list --}}
        <x-container>
            <x-card>
                <div class="p-6">
                    <h2 class="font-semibold">{{ __('projects') }}</h2>
                    <ol class="list-decimal">
                        @foreach ($projects as $project)
                            <li>{{ __("{$project->name} - {$project->created_at}") }}</li>
                        @endforeach
                    </ol>
                </div>
            </x-card>
        </x-container>

        {{-- Checklists list --}}
        <x-container>
            <x-card>
                <div class="p-6">
                    <h2 class="font-semibold">{{ __('Checklists') }}</h2>
                    <ol class="list-decimal">
                        @foreach ($checklists as $checklist)
                            <li>
                                {{ $checklist->name }}
                            </li>
                        @endforeach
                        </ol>
                </div>
            </x-card>
        </x-container>

        {{-- Tasks list --}}
        <x-container>
            <x-card>
                <div class="p-6">
                    <h2 class="font-semibold">{{ __('Tasks') }}</h2>
                    <ol class="list-decimal">
                        @foreach ($tasks as $task)
                            <li>
                                {{ $task->title }}
                            </li>
                        @endforeach
                    </ol>
                </div>
            </x-card>
        </x-container>

        {{-- The map --}}
        <x-container>
            <x-card>
                <div class="p-6">
                    <h2 class="font-semibold">{{ __('Map') }}</h2>
                    <ol class="list-decimal">
                        @foreach ($projects as $project)
                            <li>{{ $project->name }}
                                <ol class="list-decimal">
                                    @foreach ($project->checklists as $checklist)
                                        <li class="ml-4">{{ $checklist->name }}
                                            <ol class="list-decimal">
                                                @foreach ($checklist->tasks as $task)
                                                    <li class="ml-8">{{ $task->title }}</li>
                                                @endforeach
                                            </ol>
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </x-card>
        </x-container>
    </body>
</html>
