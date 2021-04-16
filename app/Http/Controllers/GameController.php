<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityFlashExercise;
use App\ActivityInstructor;
use App\HT2Labs\XApi\LrsService;
use App\HT2Labs\XApi\StatementData;
use App\Http\Resources\PublicAnswerResource;
use App\Jobs\ProcessLrsRequest;
use App\Options\QuestionTypeOptions;
use App\Repository\GameRepository;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Game;

use App\GameAnswer;

use App\ActivityItem;

use App\PlayerPosition;

use App\DiscountVoucher;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
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
            'getGameData',
            'startStopGame',
            'getPlayerPositions',
            'addRating',
            'getAllMessages',
            'addNewMessage',
            'deleteMessage',
            'startQuestion',
            'apiPublicAnswers',
        ]]);
    }

    /**
     * Display game page for the specified activity.
     *
     * @param \App\Activity
     *
     * @return \Illuminate\Http\Response
     */
    public function play(Request $request, Game $game)
    {
        if (!$game->activity) {
            abort(404);
        }

        if ($game->user_id) {
            if (!(Auth::check() && Auth::user()->id === $game->user_id)) {
                abort(403);
            }
        }

        $exitUrl = route('activity.index');
        if ($request->has('exit_url')) {
            if (Str::startsWith($request->get('exit_url'), url('/'))) {
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

        if ($game->user_id) {
            if (!(Auth::check() && Auth::user()->id === $game->user_id)) {
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
     *
     * @param \Illuminate\Http\Request   $request      Request object
     * @param \App\Services\ImageService $imageService ImageService instance
     * @param \App\Game                  $game         Game object
     *
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

            $answer->game()->associate($game);
            $answer->activityItem()->associate($item);
        }
        $answer->correct = true;
        $answer->is_answered = true;
        $answer->answering_end_time = new Carbon('now');

        if ($item->type === QuestionTypeOptions::ONE_CORRECT_ANSWER || $item->type === QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS) {
            $chosenOptionIds = $request->get('options');
            if (!is_array($chosenOptionIds)) {
                $chosenOptionIds = [$chosenOptionIds];
            }
            $answer->answer = json_encode([
                'options' => $chosenOptionIds,
            ]);
            $correctOptionIds = [];
            foreach ($item->options as $option) {
                if ($option->correct) {
                    $correctOptionIds[] = $option->id;
                }
            }
            $answer->correct = (count($correctOptionIds) === count($chosenOptionIds) && count(array_intersect($correctOptionIds, $chosenOptionIds)) === count($correctOptionIds));
        } else if ($item->type === QuestionTypeOptions::FREEFORM_ANSWER || $item->type === QuestionTypeOptions::EMBEDDED_CONTENT || $item->type === QuestionTypeOptions::MISSING_WORD) {
            $answer->answer = json_encode([
                'text' => $request->get('text'),
            ]);

            if ($item->type === QuestionTypeOptions::MISSING_WORD) {
                $answer->correct = \mb_strtoupper(\preg_replace('/\s+/', '', $request->get('text'))) === \mb_strtoupper(\preg_replace('/\s+/', '', $item->missing_word));
            }
        } else if ($item->type === QuestionTypeOptions::PHOTO) {
            $validator = Validator::make(
                [
                    'file' => $request->file('image')
                ],
                [
                    'file' => 'required|image|mimes:jpeg,jpg,png',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['error' => 'Missing or wrong image type.'], 403);
            }

            $originalExtension = $request->file('image')->getClientOriginalExtension();
            $fileName = $imageService->generateUniqueFileName('game_answer_image_', $originalExtension);

            $directoryPath = $game->getStoragePath();
            $imageService->process($request->file('image')->getRealPath(), $directoryPath, $fileName, 800);

            $answer->image = $fileName;
        }

        if (($answer->correct || $item->type === QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS) && $item->points !== null) {
            $points = $item->calculateTotalPoints($answer);
            if ($points !== false) {
                $answer->grade = $points;
            } else {
                $answer->grade = 0;
            }
        }

        $answer->save();

        // Determine completion status and mark as completed
        $itemIds = $activity->belongsToMany(ActivityItem::class)->select('id')->pluck('id');
        $answeredItemIds = $game->answers()->where('is_answered', '<>', 0)->select('activity_item_id')->pluck('activity_item_id');
        $unansweredItemIds = array_diff($itemIds->toArray(), $answeredItemIds->toArray());
        if (count($unansweredItemIds) === 0) {
            $game->complete = true;
            $game->save();
        }

        $this->sendQuestionAnswerToLrs($game, $item);

        return $answer->getGameData();
    }

    public function sendQuestionAnswerToLrs(Game $game, ActivityItem $item)
    {
        $answer = GameAnswer::where('game_id', $game->id)->where('activity_item_id', $item->id)->first();
        $name = $game->getUserName();
        $email = $game->getUserEmail();
        $actor = new StatementData\Actor($name, $email);
        $verb = new StatementData\Verb(StatementData\Verb::TYPE_ANSWERED);
        $activity = $game->activity()->first();
        $object = new StatementData\ObjectData(StatementData\ObjectData::TYPE_ACTIVITY, url(route('activity.show', [
            'activity' => $activity->id
        ])), $activity->title);
        $context = new StatementData\Context(url(route('game.play', [
            'game' => $game->id
        ])));
        $max = $item->points !== null ? json_decode($item->points, true) : 0;
        if (is_array($max)) {
            $max = array_sum($max);
        }
        $raw = $answer->grade ?? 0;
        $scaled = $raw > 0 && $max > 0 ? $raw / $max : 0;
        $result = new StatementData\Result(true, $answer->correct, new StatementData\Score(0, (int)$max, (int)$raw, $scaled));
        $statementData = new StatementData($actor, $verb, $object, null, $context, $result);

        ProcessLrsRequest::dispatch($statementData);

        if ($game->complete === true) {
            $this->sendGameCompletedToLrs($game);
        }

        return response()->json([]);
    }

    public function sendGameCompletedToLrs(Game $game)
    {
        $name = $game->getUserName();
        $email = $game->getUserEmail();
        $actor = new StatementData\Actor($name, $email);
        /** @var Activity $activity */
        $activity = $game->activity;
        $verb = new StatementData\Verb(StatementData\Verb::TYPE_COMPLETED);
        $object = new StatementData\ObjectData(StatementData\ObjectData::TYPE_ACTIVITY, url('game.play', [
            'game' => $game->id
        ]), $activity->title);
        $max = 0;
        /** @var ActivityItem $_item */
        foreach ($activity->activityItems()->getResults() as $_item) {
            $points = $_item->points !== null ? json_decode($_item->points, true) : 0;
            if (is_array($points)) {
                $max += (int)array_sum($points);
            } else {
                $max += (int)$points;
            }
        }
        $raw = 0;
        $success = true;
        /** @var GameAnswer $_answer */
        foreach ($game->answers()->getResults() as $_answer) {
            if (!$_answer->correct) {
                $success = false;
            }
            $raw += (int)($_answer->grade ?? 0);
        }
        $scaled = $raw > 0 && $max > 0 ? $raw / $max : 0;
        $result = new StatementData\Result(true, $success, new StatementData\Score(0, $max, $raw, $scaled));
        $statementData = new StatementData($actor, $verb, $object, null, null, $result);

        ProcessLrsRequest::dispatch($statementData);

        return response()->json([]);
    }

    /**
     * @param Request $request
     * @param Game    $game
     *
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
            $answer->game()->associate($game);
            $answer->activityItem()->associate($activityItem);
            $answer->grade = 0;
        }
        $answer->correct = false;
        $answer->is_answered = false;
        $answer->answering_start_time = $date;

        $this->setEmptyAnswer($request, $activity, $answer);

        $answer->save();

        return $answer->getGameData();
    }

    protected function setEmptyAnswer(Request $request, Activity $activity, GameAnswer $answer)
    {
        /** @var ActivityItem $item */
        $item = $activity->activityItems()->where('id', $request->get('question_id'))->first();
        if ($answer->answer === null || empty($answer->answer)) {
            if ($item->type === QuestionTypeOptions::ONE_CORRECT_ANSWER || $item->type === QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS) {
                $answer->answer = json_encode([
                    'options' => [],
                ]);
            } else if ($item->type === QuestionTypeOptions::FREEFORM_ANSWER || $item->type === QuestionTypeOptions::EMBEDDED_CONTENT || $item->type === QuestionTypeOptions::MISSING_WORD) {
                $answer->answer = json_encode([
                    'text' => '',
                ]);
            } else {
                $answer->answer = '';
            }
        }
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
        $answer->answering_end_time = new Carbon('now');
        $answer->grade = 0;

        $this->setEmptyAnswer($request, $activity, $answer);

        $answer->save();

        // Determine completion status and mark as completed
        $itemIds = $activity->belongsToMany(ActivityItem::class)->select('id')->pluck('id');
        $answeredItemIds = $game->answers()->where('is_answered', '<>', 0)->select('activity_item_id')->pluck('activity_item_id');
        $unansweredItemIds = array_diff($itemIds->toArray(), $answeredItemIds->toArray());
        if (count($unansweredItemIds) === 0) {
            $game->complete = true;
            $game->save();
        }

        $this->sendQuestionAnswerToLrs($game, $item);

        return $answer->getGameData();
    }

    public function startQuestion(Request $request, Game $game, int $id)
    {
        $request->request->set('question_id', $id);
        $answer = GameAnswer::firstOrNew([
            'game_id' => $game->id,
            'activity_item_id' => $id
        ]);

        // This prevents already existing answers from being reset
        if ($answer->id && $answer->isAnswered()) {
            return $answer->getGameData();
        }

        if (!$answer->id) {
            /** @var ActivityItem $activityItem */
            $activityItem = $game->activity->activityItems()->where('id', $id)->first();
            $answer->game()->associate($game);
            $answer->activityItem()->associate($activityItem);
            $answer->grade = 0;
        }
        $answer->correct = false;
        $answer->is_answered = false;
        $this->setEmptyAnswer($request, $game->activity, $answer);
        $answer->save();

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
            $tenMinutesAgo = Carbon::now()->subMinutes(10);
            $fiveMinutesAgo = Carbon::now()->subMinutes(5);
            $games = Game::where('activity_id', $activity->id)->where('id', '<>', $game->id)->orderBy('created_at', 'DESC')->get();
            /** @var Game $game */
            foreach ($games as $_game) {
                /** @var User $player */
                $player = User::find($_game->user_id);
                $positions = PlayerPosition::where('game_id', $_game->id)
                    ->orderBy('created_at', 'DESC')
                    ->take(1)
                    ->get();
                /** @var PlayerPosition $position */
                foreach ($positions as $position) {
                    $answers = GameAnswer::where('game_id', $_game->id)->where('is_answered', 1)->get();
                    $completedTasks = [];
                    /** @var GameAnswer $answer */
                    foreach ($answers as $answer) {
                        /** @var ActivityItem $activityItem */
                        $activityItem = ActivityItem::find($answer->activity_item_id);
                        $completedTasks[] = [
                            'title' => $activityItem->title,
                            'id' => $activityItem->id,
                            'url' => route('manage.game-statistics', [
                                'game' => $game->id,
                                'segmentType' => 'tasks',
                                'player' => $answer->game_id,
                                'task' => $activityItem->id
                            ])
                        ];
                    }
                    $players[] = [
                        'game_id' => $position->game_id,
                        'lat' => $position->latitude,
                        'lng' => $position->longitude,
                        'status' => Carbon::parse($position->created_at) > $fiveMinutesAgo ? 'active' : (Carbon::parse($position->created_at) > $tenMinutesAgo ? 'inactive' : 'hidden'),
                        'name' => $player ? $player->name : $_game->nickname,
                        'completed_tasks' => $completedTasks
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
     *
     * @param \Illuminate\Http\Request $request Request object
     * @param \App\Game                $game    Game object
     *
     * @return \Illuminate\Http\Response
     */
    public function logPlayerPosition(Request $request, Game $game)
    {
        $position = $request->get('position');

        if (!$position) {
            return response()->json(['error' => 'Position data is missing.'], 400);
        }

        $playerPosition = new PlayerPosition();
        $playerPosition->game()->associate($game);
        $playerPosition->latitude = $position['coords']['latitude'];
        $playerPosition->longitude = $position['coords']['longitude'];
        if (isset($position['coords']['heading'])) {
            $heading = (int)$position['coords']['heading'];
            if ($heading >= 0 && $heading < 360) {
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
     *
     * @param \Illuminate\Http\Request $request Request object
     * @param \App\Game                $game    Game object
     *
     * @return \Illuminate\Http\Response
     */
    public function voucher(Request $request, Game $game)
    {
        if ($game->user_id) {
            if (!(Auth::check() && Auth::user()->id === $game->user_id)) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }
        }

        if (!$game->user) {
            return response()->json(['error' => 'Forbidden.'], 403);
        }

        $responseData = [
            'hasVoucher' => false,
        ];
        $discountVoucher = $game->user->belongsToMany(DiscountVoucher::class)
            ->where('game_id', '=', $game->id)
            ->first();

        if ($discountVoucher) {
            $responseData['hasVoucher'] = true;
            $responseData['voucher'] = [
                'title' => $discountVoucher->title,
            ];
        }

        return response()->json($responseData);
    }

    /**
     * Trigger download of CSV file with player positions
     *
     * @param \App\Game $game Game object
     *
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
        $callback = function () use ($playerPositions, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            if ($playerPositions->count() > 0) {
                foreach ($playerPositions as $position) {
                    fputcsv($handle, [$position->latitude, $position->longitude, $position->heading, $position->timestamp,]);
                }
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * @param Request $request
     * @param Game    $game
     *
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
                ->where('games.activity_id', '=', $game->activity_id)
                ->whereNull('game_answers.grade')
                ->where('game_answers.is_answered', '=', 1)
                ->where('activity_items.type', '!=', QuestionTypeOptions::INFORMATION)
                ->where('activity_items.type', '!=', QuestionTypeOptions::EMBEDDED_CONTENT)
                ->where('activity_items.type', '!=', QuestionTypeOptions::MATCH_PAIRS)
                ->where('activity_items.type', '!=', QuestionTypeOptions::ONE_CORRECT_ANSWER)
                ->where('activity_items.type', '!=', QuestionTypeOptions::MULTIPLE_CORRECT_ANSWERS);
            $count = $query->count();
        }

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * @param Request $request
     * @param Game    $game
     *
     * @return JsonResponse
     */
    public function startStopFlashExercise(Request $request, Game $game)
    {
        $activityId = $game->activity_id;
        $activityItemId = $request->get('questionId');
        $active = $request->get('active');

        if ((int)$activityId <= 0 || (int)$activityItemId <= 0) {
            return response()->json([
                'error' => 'Invalid data'
            ]);
        }

        $query = DB::table(ActivityFlashExercise::TABLE_NAME)
            ->select(['id'])
            ->where('activity_id', '=', $activityId)
            ->where('activity_item_id', '=', $activityItemId)
            ->where('active', '=', 1);
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
     *
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

        if ((int)$activityId <= 0) {
            return response()->json([
                'error' => 'Invalid data'
            ]);
        }

        $query = DB::table(ActivityFlashExercise::TABLE_NAME)
            ->select(['activity_item_id'])
            ->where('activity_id', '=', $activityId)
            ->where('active', '=', 1);
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
     *
     * @return JsonResponse
     */
    public function getGameData(Game $game)
    {
        return response()->json([
            'flash_exercise' => $this->getFlashExerciseData($game),
            'start_stop' => [
                'started' => $this->isGameStarted($game)
            ],
            'messages' => GameRepository::getNewMessages($game->activity)
        ]);
    }

    public function monitoring(Request $request, Game $game)
    {
        if (!$game->activity) {
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

    public function startStopGame(Request $request, Game $game)
    {
        /** @var Activity $activity */
        $activity = $game->activity;
        if ($activity) {
            $activity->started = $request->query->get('start');
            $activity->save();
        }

        return response()->json([]);
    }

    public function getPlayerPositions(Game $game)
    {
        $playerPositions = GameRepository::getPlayerPositions($game);
        $playerAnswers = GameRepository::getPlayerAnswers($game);

        return response()->json([
            'positions' => $playerPositions,
            'answers' => $playerAnswers
        ]);
    }

    public function addRating(Game $game, int $rating)
    {
        $game->rating = $rating;
        $game->save();

        return response()->json([]);
    }

    public function getAllMessages(Game $game)
    {
        return GameRepository::getMessages($game->activity);
    }

    public function addNewMessage(Request $request, Game $game)
    {
        $message = $request->get('message');
        GameRepository::addNewMessage($game->activity, $message);
    }

    public function deleteMessage(Request $request, Game $game, int $id)
    {
        GameRepository::deleteMessage($id);
    }

    /**
     * Returns JsonResponse with previous public answers data for a single task.
     * Checks if game is currently running, being a public path and provided task belonging to a game.
     *
     * @param Game $game
     * @param ActivityItem $activityItem
     *
     * @return JsonResponse
     */
    public function apiPublicAnswers(Game $game, ActivityItem $activityItem): JsonResponse
    {
        $activity = $game->activity;
        $hasActivityItem = $activity->activityItems->contains(function ($item) use ($activityItem) {
            return $item->id === $activityItem->id;
        });

        if (!$activity->isStarted() || !$activity->isPublicPath() || !$hasActivityItem) {
            return response()->json([], 403);
        }

        $result = GameAnswer::select('game_answers.*')
            ->join('activity_items', 'game_answers.activity_item_id', '=', 'activity_items.id')
            ->where('game_answers.activity_item_id', '=', $activityItem->id)
            ->where(function($query) {
                $query->where('activity_items.type', '=', QuestionTypeOptions::FREEFORM_ANSWER)
                    ->orWhere('activity_items.type', '=', QuestiontypeOptions::PHOTO);
            })
            ->where('game_answers.is_answered', '<>', 0)
            ->with(['game.user'])
            ->orderBy('game_answers.updated_at', 'asc')
            ->paginate(config('paginate.limit'));

        return self::jsonResponseWithPagination($result, PublicAnswerResource::class);
    }
}
