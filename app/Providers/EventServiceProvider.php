<?php

namespace App\Providers;

use App\Events\CategoryCreated;
use App\Events\CategoryDeleted;
use App\Events\ChecklistCreated;
use App\Events\ChecklistDeleted;
use App\Listeners\LogCreatedCategory;
use App\Listeners\LogCreatedChecklist;
use App\Listeners\LogDeletedCategory;
use App\Listeners\LogDeletedChecklist;
use App\Listeners\LogNewUser;
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
            LogNewUser::class,
        ],
        CategoryCreated::class => [
            LogCreatedCategory::class,
        ],
        CategoryDeleted::class => [
            LogDeletedCategory::class,
        ],
        ChecklistCreated::class => [
            LogCreatedChecklist::class,
        ],
        ChecklistDeleted::class => [
            LogDeletedChecklist::class,
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
