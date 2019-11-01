<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Badge;
use App\Game;
use App\Activity;

use Illuminate\Support\Facades\Log;

class AwardBadges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badge:award';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Awards badges to users';

    /**
     * Collection of badges, keyed by "type"
     *
     * @var Collection
     */
    protected $badges;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ( !isset($this->badges) )
        {
            $this->badges = Badge::all()->keyBy('type');
        }

        $this->info('Evaluating Users and Awarding Badges');

        $usersChecked = 0;

        foreach ( User::cursor() as $user )
        {
            $usersChecked++;

            // Register badge to any user
//            $user->awardBadge( $this->badges->get('register') );

            // Social Login badge to any user wth Social Accounts connected
            if ( count($user->social_accounts) )
            {
//                $user->awardBadge( $this->badges->get('social') );
            }

            // Award Gamer badges based on completed Games count
            $completeGamesCount = Game::where('user_id', '=', $user->id)->where('complete', '=', 1)->count();

            if ( $completeGamesCount >= 1 )
            {
//                $user->awardBadge( $this->badges->get('novice_gamer') );
            }
            if ( $completeGamesCount >= 5 )
            {
//                $user->awardBadge( $this->badges->get('seasoned_gamer') );
            }
            if ( $completeGamesCount >= 10)
            {
//                $user->awardBadge( $this->badges->get('veteran_gamer') );
            }
            if ( $completeGamesCount >= 25)
            {
//                $user->awardBadge( $this->badges->get('pro_gamer') );
            }

            // Award Creator badges based on created Activities count
            $activitiesCount = Activity::where('user_id', '=', $user->id)->count();

            if ( $activitiesCount >= 1 )
            {
//                $user->awardBadge( $this->badges->get('novice_creator') );
            }
            if ( $activitiesCount >= 5 )
            {
//                $user->awardBadge( $this->badges->get('seasoned_creator') );
            }
            if ( $activitiesCount >= 10)
            {
//                $user->awardBadge( $this->badges->get('veteran_creator') );
            }
            if ( $activitiesCount >= 25)
            {
//                $user->awardBadge( $this->badges->get('pro_creator') );
            }
        }

        if ( $usersChecked > 0 )
        {
            $this->info('Checked ' . $usersChecked . ' users.');
        }
    }
}
