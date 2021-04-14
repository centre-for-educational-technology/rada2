<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\User;
use App\Role;

use Auth;

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

        User::created(function($user)
        {
            // Assign administrator role to initial user account
            if ( $user->id === 1 ) {
                $adminRole = Role::getAdminRole();
                $user->roles()->attach($adminRole->id);
            }
        });

        Event::listen('game.complete', function($game)
        {
            $properties = [
                'activity_id' => $game->activity_id,
                'complete' => $game->complete,
            ];

            if ( $game->user ) {
                $properties['user_id'] = $game->user_id;
            }

            activity()
                ->causedBy($game->user)
                ->performedOn($game)
                ->withProperties($properties)
                ->log('complete');
        });

        Event::listen('game.complete', function($game)
        {
            if ( $game->user && $game->activity->discountVoucher && $game->activity->discountVoucher->canBeAwarded() )
            {
                if ( $game->answers()->where('correct', '<>', 1)->count() === 0 )
                {
                    $game->user->awardDiscountVoucher($game->activity->discountVoucher, $game);
                }
            }
        });
    }
}
