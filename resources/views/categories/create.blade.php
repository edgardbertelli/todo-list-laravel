<x-app-layout>
    
    @include('categories.header')

    <x-container>
        <div class="mb-4">
            <x-link href="{{ route('categories.index') }}">
                <x-secondary-button>
                    {{ __('Back') }}
                </x-secondary-button>
            </x-link>
        </div>
        
        <div class="grid gap-4 grid-cols-2">
            <div>
                <x-card>
                    <div class="p-6">
                        <x-forms.form action="{{ route('categories.store') }}"
                                      method="POST"
                                      novalidate>
                            <x-input-label for="name" value="Name" />
            
                            <x-text-input id="name"
                                          name="name"
                                          type="text"
                                          class="@error('name') is-invalid @enderror"
                                          value="{{ old('name') }}"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            
                            <div class="mt-4">
                                <x-primary-button>
                                    {{ __('Create') }}
                                </x-primary-button>
                            </div>
                        </x-forms.form>
                    </div>
                </x-card>
            </div>

            <div>
                <div class="table table-auto w-full">
                    <div class="table-header-group">
                        <div class="table-row">
                            <div class="table-cell text-left font-semibold">{{ __('Name') }}</div>
                            <div class="table-cell text-left font-semibold">{{ __('Created at') }}</div>
                        </div>
                    </div>

                    <div class="table-row-group">
                        @foreach ($categories as $category)
                            <div class="table-row">
                                <div class="table-cell">{{ $category->name }}</div>
                                <div class="table-cell">{{ $category->created_at }}</div>
                            </div>
                        @endforeach
                    </div>
                  </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
