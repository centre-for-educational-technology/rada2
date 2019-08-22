<?php
/**
 * Created by PhpStorm.
 * Date: 05.08.19
 * Time: 13:07
 */

namespace App\Http\Controllers;

use App\ActivityInstructor;
use App\GameAnswer;
use App\Options\QuestionTypeOptions;
use App\User;
use Illuminate\Contracts\View\Factory;
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
     * @param int $page
     * @return Factory|View
     */
    public function index(Request $request, QuestionTypeOptions $questionTypeOptions, int $page = 0)
    {
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
     * @param GameAnswer $answer
     * @return Factory|View
     */
    public function edit(Request $request, QuestionTypeOptions $questionTypeOptions, GameAnswer $answer)
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
     * @param Request $request
     * @param GameAnswer $answer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, GameAnswer $answer)
    {
        return redirect(url('grading.edit', [
            'answer' => $answer
        ]));
    }

    /**
     * @param Request $request
     *
     * @return array|Collection
     */
    public function getAnswers(Request $request)
    {
        $showGradedAnswers = (int) $request->get('show_graded', 1) > 0;
        /** @var User $user */
        $user = Auth::user();
        $answers = [];
        if ($user) {
            $query = DB::table('game_answers')
                ->leftJoin('games', 'game_answers.game_id', '=', 'games.id')
                ->leftJoin('activity_instructors', 'games.activity_id', '=', 'activity_instructors.activity_id')
                ->leftJoin('activity_items', 'game_answers.activity_item_id', '=', 'activity_items.id')
                ->leftJoin('activities', 'activities.id', '=', 'games.activity_id')
                ->leftJoin('users', 'users.id', '=', 'games.user_id')
                ->where('activity_instructors.user_id', '=', $user->id)
                ->where('game_answers.is_answered', '=', 1)
            ;
            if ($showGradedAnswers === false) {
                $query->where('game_answers', 'is', 'NULL');
            }
            $query->select(
                'game_answers.id',
                'game_answers.answer',
                'game_answers.image',
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
                'activities.title AS activity_title',
                'activities.id as activity_id',
                'users.name AS user_name',
                'games.id as game_id'
            );
            $query->orderBy('game_answers.id', 'asc');
            $answers = $query->get();
        }

        return $answers;
    }
}