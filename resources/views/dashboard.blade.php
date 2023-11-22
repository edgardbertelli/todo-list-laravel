<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('dashboard.header') }}
        </h2>
    </x-slot>

    <x-container>
        {{-- Download report button --}}
        <div class="w-full columns-1 mb-6">
            <x-link href="{{ route('reports.make') }}">
                <x-primary-button type="button">
                    {{ __('dashboard.download_report_button') }}
                </x-primary-button>
            </x-link>
        </div>

        <div class="grid gap-4 grid-cols-3 grid-rows-1">
            {{-- Categories count --}}
            <x-card class="bg-pink-100">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <div>
                        <p class="font-semibold">{{ __('dashboard.categories') }}</p>
                        <p>{{ $categories->count() }}</p>
                    </div>                  
                </div>
            </x-card>

            {{-- Checklists count --}}
            <x-card class="bg-green-100">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <div>
                        <p class="font-semibold">{{ __('dashboard.checklists') }}</p>
                        <p>{{ $checklists->count() }}</p>
                    </div>                      
                </div>
            </x-card>

            {{-- Tasks count --}}
            <x-card class="bg-yellow-100">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                    </svg>                      
                    <div>
                        <p class="font-semibold">{{ __('dashboard.tasks') }}</p>
                        <p>{{ $tasks->count() }}</p>
                    </div>
                </div>
            </x-card>
        </div>
    </x-container>
</x-app-layout>
