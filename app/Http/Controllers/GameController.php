<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Game;

use App\GameAnswer;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    /**
     * Display game page for the specified activity.
     *
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function play(Game $game)
    {
        return view('activities/play')->with([
            'game_data' => $game->getGameData(),
        ]);
    }

    /**
     * [answer description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function answer(Request $request)
    {
        // TODO Make sure that complete games could not be played
        // TODO Needs checks for user if one is authenticated
        $game = Game::find($request->get('game_id'));

        $activity = $game->activity;

        $item = $activity->activityItems()->where('id', $request->get('question_id'))->first();

        $answer = new GameAnswer();

        if ( $item->type === 1 || $item->type === 5 )
        {
            $answer->correct = true;
        } else if ( $item->type === 2 || $item->type === 3 )
        {
            $options = $request->get('options');
            if ( !is_array($options) ) {
                $options = [$options];
            }
            $answer->answer = json_encode([
                'options' => $options,
            ]);
            $correctOptionsIds = [];
            foreach ( $item->options as $option ) {
                if ( $option->correct ) {
                    $correctOptionsIds[] = $option->id;
                }
            }
            $answer->correct = ( count(array_intersect($correctOptionsIds, $options)) === count($correctOptionsIds) && count($correctOptionsIds) === count($options) );
        } else if ( $item->type === 4 || $item->type === 6 )
        {
            // Store textual answer and mark as correct
            $answer->correct = true;
            $answer->answer = json_encode([
                'text' => $request->get('text'),
            ]);
        } else if ( $item->type === 7 )
        {
            $originalExtension = $request->file('image')->getClientOriginalExtension();
            $fileName = sha1(uniqid('game_answer_image', true)) . '.' . $originalExtension;

            $image = Image::make($request->file('image')->getRealPath());

            $image->resize(800, null, function($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });
            $image->resize(null, 800, function($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });

            $directoryPath = public_path( 'uploads/images/' . $game->id . '/' );

            if ( !File::isDirectory($directoryPath) ) {
                File::makeDirectory( $directoryPath );
            }

            $image->save( $directoryPath . $fileName );

            $answer->correct = true;
            $answer->image = $fileName;
        } else
        {
            // TODO Fail with some meaningul message
        }

        $answer->game()->associate( $game );
        $answer->activityItem()->associate( $item );

        $answer->save();

        // Mark the game as complete
        if ( $game->answers()->count() === $activity->activityItems()->count() ) {
            $game->complete = true;
            $game->save();
        }

        return $answer->getGameData();
    }
}
