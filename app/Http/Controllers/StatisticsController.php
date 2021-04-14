<?php

namespace App\Http\Controllers;

use App\Google\Analytics;
use App\Repository\GameRepository;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Activity;
use App\ActivityItem;
use App\Game;
use App\DiscountVoucher;
use App\Options\QuestionTypeOptions;
use App\Options\LanguageOptions;
use Symfony\Component\HttpFoundation\Request;

class StatisticsController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin', ['except' => [
            'getGaRows'
        ]]);
    }

    /**
     * Display statistics page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionTypeOptions $questionTypeOptions, LanguageOptions $languageOptions)
    {
        $activitiesByLanguage = Activity::select('language', DB::raw('count(*) as count'))->groupBy('language')->get()->keyBy('language');
        $activityItemsByType = ActivityItem::select('activity_items.type', DB::raw('count(*) as count, SEC_TO_TIME(ROUND(AVG(TIMEDIFF(game_answers.answering_end_time, game_answers.created_at)), 0)) as time'))
            ->join('game_answers', 'game_answers.activity_item_id', '=', 'activity_items.id')
            ->groupBy('type')->get()->keyBy('type');
        $activityItemsByLanguage = ActivityItem::select('language', DB::raw('count(*) as count'))->groupBy('language')->get()->keyBy('language');
        $gamesByStatus = Game::select('complete', DB::raw('count(*) as count'))->groupBy('complete')->get()->keyBy('complete');
        $discountVouchersByStatus = DiscountVoucher::select('status', DB::raw('count(*) as count'))->groupBy('status')->get()->keyBy('status');
        $discountVouchersRedeemed = DB::table('discount_voucher_user')->count();

        return view('manage/statistics')->with([
            'users' => User::count(),
            'blockedUsers' => User::whereNotNull('blocked_at')->count(),
            'unverifiedUsers' => User::where('verified', 0)->count(),
            'activities' => Activity::count(),
            'activitiesByLanguage' => $activitiesByLanguage,
            'activityItems' => ActivityItem::count(),
            'activityItemsByType' => $activityItemsByType,
            'activityItemsByLanguage' => $activityItemsByLanguage,
            'games' => Game::count(),
            'gamesByStatus' => $gamesByStatus,
            'questionTypeOptions' => $questionTypeOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'discountVouchers' => DiscountVoucher::count(),
            'discountVouchersByStatus' => $discountVouchersByStatus,
            'discountVouchersRedeemed' => $discountVouchersRedeemed,
            'averagePositionsOfGames' => json_encode(GameRepository::getAveragePositionsOfGames()),
            'topGames' => GameRepository::getTopGames()
        ]);
    }

    public function getGaRows(Request $request)
    {
        $type = $request->get('type');
        $analytics = new Analytics();

        return response()->json([
            'name' => trans('pages.manage.statistics.'.$type),
            'rows' => $analytics->getRows($type)
        ]);
    }
}
