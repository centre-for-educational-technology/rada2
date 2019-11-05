<?php
/**
 * Created by PhpStorm.
 * Date: 05.08.19
 * Time: 13:07
 */

namespace App\Http\Controllers;

use App\ActivityItem;
use App\GameAnswer;
use App\Options\QuestionTypeOptions;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GradingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     *
     * @param QuestionTypeOptions $questionTypeOptions
     *
     * @param int $activity
     * @param int $page
     * @return Factory|View
     */
    public function index(Request $request, QuestionTypeOptions $questionTypeOptions, int $activity, int $page = 0)
    {
        $request->request->set('activity', $activity);
        return view('grading/index')->with([
            'answers' => $this->getAnswers($request),
            'questionTypes' => $questionTypeOptions->options(),
            'viewType' => 'list',
            'currentAnswerId' => 0,
            'currentPage' => $page
        ]);
    }

    /**
     * @param Request $request
     * @param QuestionTypeOptions $questionTypeOptions
     * @param int $activity
     * @param GameAnswer $answer
     * @return Factory|View
     */
    public function edit(Request $request, QuestionTypeOptions $questionTypeOptions, int $activity, GameAnswer $answer)
    {
        return view('grading/index')->with([
            'answers' => $this->getAnswers($request),
            'questionTypes' => $questionTypeOptions->options(),
            'viewType' => 'edit',
            'currentAnswerId' => $answer->id,
            'currentPage' => 0
        ]);
    }

    /**
     * @param ActivityItem $activityItem
     * @return array
     */
    public function getQuestionData(Request $request, ActivityItem $activityItem): array
    {
        /** @var Collection $data */
        $data = $activityItem->getQuestionData();
        if (is_array($data)) {
            return $data;
        }

        return $data->toArray();
    }

    /**
     * @param Request $request
     * @param int $activity
     * @param GameAnswer $answer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, int $activity, GameAnswer $answer)
    {
        $grade = $request->get('grade', null);
        if ($grade !== null) {
            $answer->grade = $grade;
            $answer->save();
        }
        return response()->json([
            'message' => trans('pages.grading.index.success'),
            'redirect' => url( route('grading.index', [
                'activity' => $activity
            ]))
        ]);
    }

    /**
     * @param Request $request
     *
     * @return array|Collection
     */
    public function getAnswers(Request $request)
    {
        $showGradedAnswers = (int) $request->get('show_graded', 1) > 0;
        $activityId = (int) $request->get('activity');
        /** @var User $user */
        $user = Auth::user();
        $answers = [];
        if ($user) {
            $query = DB::table('game_answers')
                ->leftJoin('games', 'game_answers.game_id', '=', 'games.id');
            if (Auth::user()->isAdmin() === false) {
                $query->leftJoin('activity_instructors', 'games.activity_id', '=', 'activity_instructors.activity_id');
            }
            $query->join('activity_items', 'game_answers.activity_item_id', '=', 'activity_items.id')
                ->join('activities', 'activities.id', '=', 'games.activity_id')
                ->leftJoin('users', 'users.id', '=', 'games.user_id')
                ->where(static function(Builder $query) use ($user) {
                    if (Auth::user()->isAdmin() === false) {
                        $query->where('activity_instructors.user_id', '=', $user->id)
                            ->orWhere('activities.user_id', '=', $user->id);
                    }
                })
                ->where('activities.id', '=', $activityId)
                ->where('game_answers.is_answered', '=', 1)
                ->where('activity_items.type', '!=', QuestionTypeOptions::INFORMATION)
                ->where('activity_items.type', '!=', QuestionTypeOptions::EMBEDDED_CONTENT)
                ->where('activity_items.type', '!=', QuestionTypeOptions::MATCH_PAIRS)
                ->where('activity_items.type', '!=', QuestionTypeOptions::ONE_CORRECT_ANSWER)
            ;
            if ($showGradedAnswers === false) {
                $query->where('game_answers.answer', 'is', 'NULL');
            }
            $query->select(
                'game_answers.id',
                'game_answers.answer',
                'game_answers.correct',
                'game_answers.is_answered',
                'game_answers.grade',
                'game_answers.created_at',
                'game_answers.image as answer_image',
                'activity_items.title',
                'activity_items.description',
                'activity_items.type',
                'activity_items.image',
                'activity_items.id AS activity_item_id',
                'activity_items.points AS max_points',
                'activity_items.missing_word',
                'activities.title AS activity_title',
                'activities.id as activity_id',
                'users.name AS user_name',
                'games.id as game_id',
                'games.nickname'
            );
            $query->orderBy('game_answers.id', 'asc');
            $query->groupBy('game_answers.id');
            $answers = $query->get();
        }

        return $answers;
    }

    /**
     * @param Request $request
     * @param GameAnswer $answer
     * @return array|Collection
     */
    public function getOtherGradedAnswers(Request $request, GameAnswer $answer)
    {
        $answers = [];
        $user = Auth::user();
        if ($user && $answer) {
            /** @var ActivityItem $activityItem */
            $activityItem = $answer->activityItem()->first();
            $query = DB::table('game_answers')
                ->select(
                    'game_answers.id',
                    'game_answers.answer',
                    'game_answers.grade',
                    'game_answers.image as answer_image',
                    'activity_items.type',
                    'users.name as user_name'
                )
                ->leftJoin('games', 'game_answers.game_id', '=', 'games.id')
                ->leftJoin('activities', 'activities.id', '=', 'games.activity_id')
                ->leftJoin('activity_items', 'activity_items.id', '=', 'game_answers.activity_item_id')
                ->leftJoin('activity_activity_item', 'game_answers.activity_item_id', '=', 'activity_activity_item.activity_item_id');
            if (Auth::user()->isAdmin() === false) {
                $query->leftJoin('activity_instructors', 'activity_activity_item.activity_id', '=', 'activity_instructors.activity_id');
            }
            $query->leftJoin('users', 'users.id', '=', 'games.user_id')
                ->whereIn('activity_activity_item.activity_id', DB::table('activities')
                    ->select('activities.id')
                    ->leftJoin('activity_activity_item', 'activity_activity_item.activity_id', '=', 'activities.id')
                    ->leftJoin('game_answers', 'game_answers.activity_item_id', '=', 'activity_activity_item.activity_item_id')
                    ->where('game_answers.id', '=', $answer->id))
                ->where('activity_activity_item.activity_item_id', '=', $answer->activity_item_id)
                ->where('game_answers.id', '!=', $answer->id)
                ->where('activity_items.type', '=', $activityItem->type)
                ->where(static function(Builder $query) use ($user) {
                    if (Auth::user()->isAdmin() === false) {
                        $query->where('activity_instructors.user_id', '=', $user->id)
                            ->orWhere('activities.user_id', '=', $user->id);
                    }
                })
                ->whereNotNull('game_answers.grade')
                ->whereNotNull('games.user_id')
                ->groupBy('game_answers.id')
                ->orderBy('game_answers.id', 'desc')
            ;
            $answers = $query->get();
        }
        return $answers;
    }
}