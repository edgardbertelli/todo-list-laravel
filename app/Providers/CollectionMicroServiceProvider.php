<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CollectionMicroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Collection::macro('toUpper', function () {
            return $this->map(function (string $value) {
                return Str::title($value);
            });
        });

        Collection::macro('toLocale', function (string $locale) {
            return $this->map(function (string $value) use ($locale) {
                return Lang::get($value, [], $locale);
            });
        });
    }
}
