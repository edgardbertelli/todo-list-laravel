<?php

namespace App\Providers;

use App\Events\CategoryCreated;
use App\Events\CategoryDestroyed;
use App\Events\CategoryStored;
use App\Listeners\LogCategory;
use App\Listeners\LogCreatedCategory;
use App\Listeners\LogDestroyedCategory;
use App\Listeners\LogStoredCategory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CategoryStored::class => [
            LogStoredCategory::class,
        ],
        CategoryDestroyed::class => [
            LogDestroyedCategory::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
