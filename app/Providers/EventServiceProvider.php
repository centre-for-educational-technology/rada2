<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\User;
use App\Role;
use App\Badge;
use App\SocialAccount;
use App\Activity;
use App\Game;

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
                $user->roles()->attach($adminRole->id,['zoo' => null]);
            }
        });

        User::created(function($user)
        {
            $badge = Badge::getBadgeByType('register');
            $user->awardBadge($badge);
        });

        SocialAccount::created(function($account)
        {
            $badge = Badge::getBadgeByType('social');
            $account->user->awardBadge($badge);
        });

        Activity::created(function($activity)
        {
            $noviceBadge = Badge::getBadgeByType('novice_creator');
            $activity->user->awardBadge($noviceBadge);

            $count = Activity::where('user_id', '=', $activity->user->id)->count();

            if ( $count >= 5 )
            {
                $seasonedBadge = Badge::getBadgeByType('seasoned_creator');
                $activity->user->awardBadge($seasonedBadge);
            }
            if ( $count >= 10 )
            {
                $veteranBadge = Badge::getBadgeByType('veteran_creator');
                $activity->user->awardBadge($veteranBadge);
            }
            if ( $count >= 25 )
            {
                $proBadge = Badge::getBadgeByType('pro_creator');
                $activity->user->awardBadge($proBadge);
            }
        });

        // XXX This one could benefit from own Event class
        Event::listen('game.complete', function($game)
        {
            if ( $game->user )
            {
                $noviceBadge = Badge::getBadgeByType('novice_gamer');
                $game->user->awardBadge($noviceBadge);

                $count = Game::where('user_id', '=', $game->user->id)->where('complete', '=', 1)->count();

                if ( $count >= 5 )
                {
                    $seasonedBadge = Badge::getBadgeByType('seasoned_gamer');
                    $activity->user->awardBadge($seasonedBadge);
                }
                if ( $count >= 10 )
                {
                    $veteranBadge = Badge::getBadgeByType('veteran_gamer');
                    $activity->user->awardBadge($veteranBadge);
                }
                if ( $count >= 25 )
                {
                    $proBadge = Badge::getBadgeByType('pro_gamer');
                    $activity->user->awardBadge($proBadge);
                }

                activity()
                    ->causedBy($game->user)
                    ->performedOn($game)
                    ->withProperties(['activity_id' => $game->activity_id, 'user_id' => $game->user_id, 'complete' => $game->complete,])
                    ->log('complete');
            } else {
                activity()
                    ->performedOn($game)
                    ->withProperties(['activity_id' => $game->activity_id, 'complete' => $game->complete,])
                    ->log('complete');
            }
        });

        Event::listen('game.complete', function($game)
        {
            if ( Auth::check() && $game->activity->discountVoucher && $game->activity->discountVoucher->canBeAwarded() )
            {
                $user = Auth::user();

                if ( $game->answers()->where('correct', '<>', 1)->count() === 0 )
                {
                    $user->awardDiscountVoucher($game->activity->discountVoucher);
                }
            }
        });
    }
}
