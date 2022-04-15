<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Events\CreatedContentEvent;
use App\Events\DeletedContentEvent;
use App\Events\UpdatedContentEvent;
use App\Events\Role\RoleUpdateEvent;
use Illuminate\Auth\Events\Registered;
use App\Events\Role\RoleAssignmentEvent;
use App\Listeners\AuditLog\LoginListener;
use App\Listeners\CreatedContentListener;
use App\Listeners\DeletedContentListener;
use App\Listeners\UpdatedContentListener;
use App\Events\AuditLog\AuditHandlerEvent;
use App\Listeners\Role\RoleUpdateListener;
use App\Listeners\Role\RoleAssignmentListener;
use App\Listeners\AuditLog\AuditHandlerListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AuditHandlerEvent::class   => [
            AuditHandlerListener::class
        ],
        Registered::class          => [
            SendEmailVerificationNotification::class,
        ],
        RoleUpdateEvent::class     => [
            RoleUpdateListener::class
        ],
        RoleAssignmentEvent::class => [
            RoleAssignmentListener::class,
        ],
        Login::class               => [
            LoginListener::class
        ],
        CreatedContentEvent::class => [
            CreatedContentListener::class
        ],
        UpdatedContentEvent::class => [
            UpdatedContentListener::class
        ],
        DeletedContentEvent::class => [
            DeletedContentListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
