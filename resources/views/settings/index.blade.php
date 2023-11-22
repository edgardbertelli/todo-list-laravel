<x-app-layout>
    
    @include('settings.header')

    <x-container>
        <x-card>
            <div class="p-6">
                <h2>Language</h2>
                {{ app()->getLocale() }}
    
                <div class="columns-2">
                    <div>
                        <p>Select a language.</p>
                    </div>
                    <div>
                        @foreach ( config('app.available_locales') as $locale => $language )
                            <a href="{{ route('locales.set', ['locale' => $locale]) }}">{{ $language }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-card>
    </x-container>
    
</x-app-layout>
