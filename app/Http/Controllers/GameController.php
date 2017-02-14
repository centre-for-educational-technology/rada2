<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Game;

use App\GameAnswer;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;

#use Illuminate\Support\Facades\Log;

use Auth;

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
        if ( $game->user_id ) {
            if ( !( Auth::check() && Auth::user()->id === $game->user_id ) ) {
                abort(403);
            }
        }
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
        $game = Game::find($request->get('game_id'));

        if ( $game->user_id ) {
            if ( !( Auth::guard('web')->check() && Auth::guard('web')->user()->id === $game->user_id ) ) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }
        }

        if ( $game->isComplete() ) {
            return response()->json(['error' => 'Game has already been marked as completed.'], 403);
        }

        $activity = $game->activity;

        $item = $activity->activityItems()->where('id', $request->get('question_id'))->first();

        $answer = new GameAnswer();
        $answer->correct = true;

        if ( $item->type === 2 || $item->type === 3 )
        {
            $chosenOptionIds = $request->get('options');
            if ( !is_array($chosenOptionIds) ) {
                $chosenOptionIds = [$chosenOptionIds];
            }
            $answer->answer = json_encode([
                'options' => $chosenOptionIds,
            ]);
            $correctOptionIds = [];
            foreach ( $item->options as $option ) {
                if ( $option->correct ) {
                    $correctOptionIds[] = $option->id;
                }
            }
            $answer->correct = ( count($correctOptionIds) === count($chosenOptionIds) && count( array_intersect($correctOptionIds, $chosenOptionIds) ) === count($correctOptionIds) );
        }
        else if ( $item->type === 4 || $item->type === 6 )
        {
            $answer->answer = json_encode([
                'text' => $request->get('text'),
            ]);
        }
        else if ( $item->type === 7 )
        {
            $validator = Validator::make(
                [
                    'file' => $request->file('image')
                ],
                [
                    'file' => 'required|image|mimes:jpeg,jpg,png',
                ]
            );

            if ( $validator->fails() ) {
                return response()->json(['error' => 'Missing or wrong image type.'], 403);
            }

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

            $answer->image = $fileName;
        }

        $answer->game()->associate( $game );
        $answer->activityItem()->associate( $item );

        $answer->save();

        if ( $game->answers()->count() === $activity->activityItems()->count() ) {
            $game->complete = true;
            $game->save();
        }

        return $answer->getGameData();
    }
}
