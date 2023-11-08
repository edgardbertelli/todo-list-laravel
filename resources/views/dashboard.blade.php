<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                @php
                    $message = 'Olá, '.Auth::user()->name;
                @endphp
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <x-alert type="error" alert-type="danger" title="Watch out!">
                        <strong>This component is an alert. Watch out!</strong>
                    </x-alert>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
