<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Game;

use App\GameAnswer;

use App\ActivityItem;

use App\PlayerPosition;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;

use App\Services\ImageService;

use Auth;

use Illuminate\Support\Facades\Event;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('game.verify', ['except' => ['play', 'downloadPlayerPositions']]);
    }

    /**
     * Display game page for the specified activity.
     *
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function play(Game $game)
    {
        if ( !$game->activity ) {
            abort(404);
        }

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
     * Answer a question
     * @param  \Illuminate\Http\Request   $request      Request object
     * @param  \App\Services\ImageService $imageService ImageService instance
     * @param  \App\Game                  $game         Game object
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request, ImageService $imageService, Game $game)
    {
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
            $fileName = $imageService->generateUniqueFileName('game_answer_image_', $originalExtension);

            $directoryPath = $game->getStoragePath();
            $imageService->process($request->file('image')->getRealPath(), $directoryPath, $fileName, 800);

            $answer->image = $fileName;
        }

        $answer->game()->associate( $game );
        $answer->activityItem()->associate( $item );

        $answer->save();

        // Determine completion status and mark as completed
        $itemIds = $activity->belongsToMany(ActivityItem::class)->select('id')->pluck('id');
        $answeredItemIds = $game->answers()->select('activity_item_id')->pluck('activity_item_id');
        $unansweredItemIds = array_diff($itemIds->toArray(), $answeredItemIds->toArray());
        if ( count($unansweredItemIds) === 0 ) {
            $game->complete = true;
            $game->save();
            // XXX Create a special event type for this one
            Event::fire('game.complete', $game);
        }

        return $answer->getGameData();
    }

    /**
     * Log player position
     * @param  \Illuminate\Http\Request $request Request object
     * @param  \App\Game                $game    Game object
     * @return \Illuminate\Http\Response
     */
    public function logPlayerPosition(Request $request, Game $game)
    {
        $position = $request->get('position');

        if ( !$position )
        {
            return response()->json(['error' => 'Position data is missing.'], 400);
        }

        $playerPosition = new PlayerPosition();
        $playerPosition->game()->associate($game);
        $playerPosition->latitude = $position['coords']['latitude'];
        $playerPosition->longitude = $position['coords']['longitude'];
        $playerPosition->heading = $position['coords']['heading'];
        $playerPosition->timestamp = Carbon::createFromTimestamp((int)$position['timestamp'] / 1000);
        $playerPosition->created_at = Carbon::now();
        $playerPosition->save();

        return $playerPosition;
    }

    /**
     * Trigger download of CSV file with player positions
     * @param  \App\Game   $game Game object
     * @return \Illuminate\Http\Response
     */
    public function downloadPlayerPositions(Game $game)
    {
        $this->authorize('downloadPlayerPositions', $game->activity);

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=game-' . $game->id . '-player-positions.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        $columns = ['Latitude', 'Longitude', 'Heading', 'Timestamp',];
        $playerPositions = DB::table('player_positions')
                               ->select('latitude', 'longitude', 'heading', 'timestamp')
                               ->where('game_id', $game->id)
                               ->orderBy('timestamp', 'asc')
                               ->get();
        $callback = function() use ($playerPositions, $columns)
        {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            if ( $playerPositions->count() > 0 )
            {
                foreach ($playerPositions as $position)
                {
                    fputcsv($handle, [$position->latitude, $position->longitude, $position->heading, $position->timestamp,]);
                }
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
