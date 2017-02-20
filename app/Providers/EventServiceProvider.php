<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\User;
use App\Role;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
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

        User::created(function($user) {
            // Assign administrator role to initial user account
            if ( $user->id === 1 ) {
                $adminRole = Role::getAdminRole();
                $user->roles()->attach($adminRole->id,['zoo' => null]);
            }
        });
    }
}
