<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityFlashExercise;
use App\ActivityInstructor;
use App\Options\QuestionTypeOptions;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Game;

use App\GameAnswer;

use App\ActivityItem;

use App\PlayerPosition;

use App\DiscountVoucher;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

use App\Services\ImageService;

use Auth;

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
        $this->middleware('game.verify', ['except' => [
            'play',
            'stopped',
            'monitoring',
            'voucher',
            'downloadPlayerPositions',
            'getCountOfUngradedAnswers',
            'startStopFlashExercise',
            'getActiveFlashExercise',
            'getGameData'
        ]]);
    }

    /**
     * Display game page for the specified activity.
     *
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function play(Request $request, Game $game)
    {
        if ( !$game->activity ) {
            abort(404);
        }

        if ( $game->user_id ) {
            if ( !( Auth::check() && Auth::user()->id === $game->user_id ) ) {
                abort(403);
            }
        }

        $exitUrl = route('activity.index');
        if ( $request->has('exit_url') )
        {
            if ( Str::startsWith( $request->get('exit_url'), url('/') ) )
            {
                $exitUrl = $request->get('exit_url');
            }
        }

        return view('activities/play')->with([
            'game_data' => $game->getGameData(),
            'exit_url' => $exitUrl,
        ]);
    }

    public function stopped(Request $request, Game $game)
    {
        if (!$game->activity) {
            abort(404);
        }

        if ( $game->user_id ) {
            if ( !( Auth::check() && Auth::user()->id === $game->user_id ) ) {
                abort(403);
            }
        }

        return view('activities.stopped')->with([
            'game_data' => $game->getGameData(),
            'game_url' => route('game.play', [
                'game' => $game->id
            ])
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
        /** @var Activity $activity */
        $activity = $game->activity;

        /** @var ActivityItem $item */
        $item = $activity->activityItems()->where('id', $request->get('question_id'))->first();

        $answer = GameAnswer::where('game_id', $game->id)->where('activity_item_id', $item->id)->first();
        if (!$answer) {
            $answer = new GameAnswer();

            $answer->game()->associate( $game );
            $answer->activityItem()->associate( $item );
        }
        $answer->correct = true;
        $answer->is_answered = true;

        if ( $item->type === QuestionTypeOptions::ONE_CORRECT_ANSWER || $item->type === QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS )
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
        else if ( $item->type === QuestionTypeOptions::FREEFORM_ANSWER || $item->type === QuestionTypeOptions::EMBEDDED_CONTENT || $item->type === QuestionTypeOptions::MISSING_WORD )
        {
            $answer->answer = json_encode([
                'text' => $request->get('text'),
            ]);

            if ($item->type === QuestionTypeOptions::MISSING_WORD) {
                $answer->correct = \mb_strtoupper(\preg_replace('/\s+/', '', $request->get('text'))) === \mb_strtoupper(\preg_replace('/\s+/', '', $item->missing_word));
            }
        }
        else if ( $item->type === QuestionTypeOptions::PHOTO )
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

        if (($answer->correct ||  $item->type === QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS) && $item->points !== null) {
            $points = $item->calculateTotalPoints($answer);
            if ($points !== false) {
                $answer->grade = $points;
            }
        }

        $answer->save();

        // Determine completion status and mark as completed
        $itemIds = $activity->belongsToMany(ActivityItem::class)->select('id')->pluck('id');
        $answeredItemIds = $game->answers()->select('activity_item_id')->pluck('activity_item_id');
        $unansweredItemIds = array_diff($itemIds->toArray(), $answeredItemIds->toArray());
        if ( count($unansweredItemIds) === 0 ) {
            $game->complete = true;
            $game->save();
        }

        return $answer->getGameData();
    }

    /**
     * @param Request $request
     * @param Game $game
     * @return array
     */
    public function startAnsweringTimer(Request $request, Game $game)
    {
        $activity = $game->activity;
        $date = Carbon::now('UTC');
        $date->setTimezone('Europe/Tallinn');
        $answer = GameAnswer::firstOrNew([
            'game_id' => $game->id,
            'activity_item_id' => $request->get('question_id')
        ]);
        if (!$answer->id) {
            /** @var ActivityItem $activityItem */
            $activityItem = $activity->activityItems()->where('id', $request->get('question_id'))->first();
            $answer->game()->associate( $game );
            $answer->activityItem()->associate( $activityItem );
        }
        $answer->correct = false;
        $answer->is_answered = false;
        $answer->answering_start_time = $date;
        $answer->answer = json_encode([
            'options' => [],
        ]);

        $answer->save();

        return $answer->getGameData();
    }

    public function closeQuestion(Request $request, Game $game)
    {
        /** @var Activity $activity */
        $activity = $game->activity;

        /** @var ActivityItem $item */
        $item = $activity->activityItems()->where('id', $request->get('question_id'))->first();
        $answer = GameAnswer::where('game_id', $game->id)->where('activity_item_id', $item->id)->first();
        $answer->correct = false;
        $answer->is_answered = true;
        $answer->answer = json_encode([
            'options' => [],
        ]);
        $answer->save();

        // Determine completion status and mark as completed
        $itemIds = $activity->belongsToMany(ActivityItem::class)->select('id')->pluck('id');
        $answeredItemIds = $game->answers()->select('activity_item_id')->pluck('activity_item_id');
        $unansweredItemIds = array_diff($itemIds->toArray(), $answeredItemIds->toArray());
        if ( count($unansweredItemIds) === 0 ) {
            $game->complete = true;
            $game->save();
        }

        return $answer->getGameData();
    }

    public function getPositionOfPlayersWhoPlayMyActivity(Request $request, Game $game)
    {
        if ($game->user_id === null) {
            return 'false';
        }

        $players = [];
        /** @var Activity $activity */
        $activity = $game->activity;
        $instructors = $activity->getInstructors()->filter(static function (ActivityInstructor $instructor) use ($game) {
            return $instructor->user_id === $game->user_id;
        });
        $instructor = $instructors->count() > 0 ? $instructors->first() : null;
        if ($activity->user_id === $game->user_id || $instructor !== null || auth()->user()->isAdmin()) {
            $tenMinutesAgo = Carbon::now()->subMinutes(10)->toDateTimeString();
            $fiveMinutesAgo = Carbon::now()->subMinutes(5);
            $games = Game::where('activity_id', $activity->id)->where('complete', 0)->where('id', '<>', $game->id)->get();
            /** @var Game $game */
            foreach ($games as $_game) {
                /** @var User $player */
                $player = User::find($_game->user_id);
                $positions = PlayerPosition::where('game_id', $_game->id)
                    ->where('created_at', '>', $tenMinutesAgo)
                    ->orderBy('created_at', 'DESC')
                    ->take(1)
                    ->get();
                /** @var PlayerPosition $position */
                foreach ($positions as $position) {
                    $players[] = [
                        'game_id' => $position->game_id,
                        'lat' => $position->latitude,
                        'lng' => $position->longitude,
                        'status' => Carbon::parse($position->created_at) > $fiveMinutesAgo ? 'active' : 'inactive',
                        'name' => $player ? $player->name : '-'
                    ];
                }
            }
        } else {
            return 'false';
        }

        return $players;
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
        if ( isset($position['coords']['heading']) )
        {
            $heading = (int)$position['coords']['heading'];
            if ( $heading >= 0 && $heading < 360 )
            {
                $playerPosition->heading = $heading;
            }
        }
        $playerPosition->timestamp = Carbon::createFromTimestamp((int)$position['timestamp'] / 1000);
        $playerPosition->created_at = Carbon::now();
        $playerPosition->save();

        return $playerPosition;
    }

    /**
     * Answer a question
     * @param  \Illuminate\Http\Request   $request      Request object
     * @param  \App\Game                  $game         Game object
     * @return \Illuminate\Http\Response
     */
    public function voucher(Request $request, Game $game)
    {
        if ( $game->user_id ) {
            if ( !( Auth::check() && Auth::user()->id === $game->user_id ) ) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }
        }

        if ( !$game->user )
        {
            return response()->json(['error' => 'Forbidden.'], 403);
        }

        $responseData = [
            'hasVoucher' => false,
        ];
        $discountVoucher = $game->user->belongsToMany(DiscountVoucher::class)
            ->where('game_id', '=', $game->id)
            ->first();

        if ( $discountVoucher )
        {
            $responseData['hasVoucher'] = true;
            $responseData['voucher'] = [
                'title' => $discountVoucher->title,
            ];
        }

        return response()->json($responseData);
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

    /**
     * @param Request $request
     * @param Game $game
     * @return JsonResponse|Collection|null
     */
    public function getCountOfUngradedAnswers(Request $request, Game $game)
    {
        $count = null;

        if ($game && Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin() === false) {
                /** @var Activity $activity */
                $activity = Activity::find($game->activity_id);
                if ($activity->user_id !== $user->id && $activity->isInstructor($user) === false) {
                    return response()->json([
                        'count' => $count
                    ]);
                }
            }
            $query = DB::table('game_answers')
                ->leftJoin('games', 'games.id', '=', 'game_answers.game_id')
                ->leftJoin('activity_items', 'game_answers.activity_item_id', '=', 'activity_items.id')
                ->leftJoin('activity_activity_item', 'activity_activity_item.activity_item_id', '=', 'activity_items.id')
                ->where('activity_activity_item.activity_id', '=', $game->activity_id)
                ->where('games.activity_id', '=', 'activity_activity_item.activity_id')
                ->whereNull('game_answers.grade')
                ->where('game_answers.is_answered', '=', 1)
                ->where('activity_items.type', '!=', QuestionTypeOptions::INFORMATION)
                ->where('activity_items.type', '!=', QuestionTypeOptions::EMBEDDED_CONTENT)
            ;
            $count = $query->count();
        }

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * @param Request $request
     * @param Game $game
     * @return JsonResponse
     */
    public function startStopFlashExercise(Request $request, Game $game)
    {
        $activityId = $game->activity_id;
        $activityItemId = $request->get('questionId');
        $active = $request->get('active');

        if ((int) $activityId <= 0 || (int) $activityItemId <= 0) {
            return response()->json([
                'error' => 'Invalid data'
            ]);
        }

        $query = DB::table(ActivityFlashExercise::TABLE_NAME)
            ->select(['id'])
            ->where('activity_id','=', $activityId)
            ->where('activity_item_id', '=', $activityItemId)
            ->where('active', '=', 1)
        ;
        $data = $query->get();
        if ($data->count() > 0) {
            $activityFlashExercise = ActivityFlashExercise::find($data->first()->id);
        } else {
            $activityFlashExercise = new ActivityFlashExercise();
            $activityFlashExercise->activity_id = $activityId;
            $activityFlashExercise->activity_item_id = $activityItemId;
            $activityFlashExercise->user_id = $game->user_id;
            $activityFlashExercise->created_at = Carbon::now();
        }
        $activityFlashExercise->active = $active;
        $activityFlashExercise->updated_at = Carbon::now();
        $activityFlashExercise->save();

        return response()->json([
            'id' => $activityFlashExercise->id,
            'active' => $activityFlashExercise->active
        ]);
    }

    /**
     * @param Game $game
     * @return array
     * @return JsonResponse
     */
    public function getActiveFlashExercise(Game $game)
    {
        return response()->json($this->getFlashExerciseData($game));
    }

    protected function getFlashExerciseData(Game $game): array
    {
        $activityId = $game->activity_id;

        if ((int) $activityId <= 0) {
            return response()->json([
                'error' => 'Invalid data'
            ]);
        }

        $query = DB::table(ActivityFlashExercise::TABLE_NAME)
            ->select(['activity_item_id'])
            ->where('activity_id','=', $activityId)
            ->where('active', '=', 1)
        ;
        $data = $query->get();
        if ($data->count() > 0) {
            return ['id' => $data->first()->activity_item_id];
        }

        return [];
    }

    protected function isGameStarted(Game $game)
    {
        /** @var Activity $activity */
        $activity = $game->activity;

        return $activity->started;
    }

    /**
     * @param Game $game
     * @return JsonResponse
     */
    public function getGameData(Game $game)
    {
        return response()->json([
            'flash_exercise' => $this->getFlashExerciseData($game),
            'start_stop' => [
                'started' => $this->isGameStarted($game)
            ]
        ]);
    }

    public function monitoring(Request $request, Game $game)
    {
        if ( !$game->activity ) {
            abort(404);
        }

        if ($game->user_id && !(Auth::check() && Auth::user()->id === $game->user_id)) {
            abort(403);
        }

        $exitUrl = route('activity.show', [
            'activity' => $game->activity->id
        ]);

        return view('activities/monitoring')->with([
            'game_data' => $game->getGameData(),
            'exit_url' => $exitUrl,
        ]);
    }
}
