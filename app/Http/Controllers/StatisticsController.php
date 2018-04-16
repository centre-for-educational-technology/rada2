<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Activity;
use App\ActivityItem;
use App\Game;
use App\DiscountVoucher;

use App\Options\ZooOptions;
use App\Options\QuestionTypeOptions;
use App\Options\LanguageOptions;

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
        $this->middleware('auth.admin');
    }

    /**
     * Display statistics page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ZooOptions $zooOptions, QuestionTypeOptions $questionTypeOptions, LanguageOptions $languageOptions)
    {
        $activitiesByZoo = Activity::select('zoo', DB::raw('count(*) as count'))->groupBy('zoo')->get()->keyBy('zoo');
        $activitiesByLanguage = Activity::select('language', DB::raw('count(*) as count'))->groupBy('language')->get()->keyBy('language');
        $activityItemsByType = ActivityItem::select('type', DB::raw('count(*) as count'))->groupBy('type')->get()->keyBy('type');
        $activityItemsByZoo = ActivityItem::select('zoo', DB::raw('count(*) as count'))->groupBy('zoo')->get()->keyBy('zoo');
        $activityItemsByLanguage = ActivityItem::select('language', DB::raw('count(*) as count'))->groupBy('language')->get()->keyBy('language');
        $gamesByStatus = Game::select('complete', DB::raw('count(*) as count'))->groupBy('complete')->get()->keyBy('complete');
        $discountVouchersByStatus = DiscountVoucher::select('status', DB::raw('count(*) as count'))->groupBy('status')->get()->keyBy('status');
        $discountVouchersRedeemed = DB::table('discount_voucher_user')->count();

        return view('manage/statistics')->with([
            'users' => User::count(),
            'blockedUsers' => User::whereNotNull('blocked_at')->count(),
            'unverifiedUsers' => User::where('verified', 0)->count(),
            'activities' => Activity::count(),
            'activitiesByZoo' => $activitiesByZoo,
            'activitiesByLanguage' => $activitiesByLanguage,
            'activityItems' => ActivityItem::count(),
            'activityItemsByType' => $activityItemsByType,
            'activityItemsByZoo' => $activityItemsByZoo,
            'activityItemsByLanguage' => $activityItemsByLanguage,
            'games' => Game::count(),
            'gamesByStatus' => $gamesByStatus,
            'zooOptions' => $zooOptions->options(),
            'questionTypeOptions' => $questionTypeOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'discountVouchers' => DiscountVoucher::count(),
            'discountVouchersByStatus' => $discountVouchersByStatus,
            'discountVouchersRedeemed' => $discountVouchersRedeemed,
        ]);
    }
}
