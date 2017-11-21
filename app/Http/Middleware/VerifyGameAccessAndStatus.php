<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\Game;

class VerifyGameAccessAndStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $game = Game::find($request->get('game_id'));

        if ( !$game )
        {
            return response()->json(['error' => 'Not Found.'], 404);
        }

        if ( $game->user_id )
        {
            if ( !( Auth::guard('web')->check() && Auth::guard('web')->user()->id === $game->user_id ) ) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }
        }

        if ( $game->isComplete() )
        {
            return response()->json(['error' => 'Game has already been marked as completed.'], 403);
        }

        app()->instance(Game::class, $game);

        return $next($request);
    }
}
