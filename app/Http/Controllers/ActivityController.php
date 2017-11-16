<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreActivity;

use App\Activity;
use App\ActivityItem;
use App\Game;
use App\DiscountVoucher;

use Auth;

use App\Options\ZooOptions;
use App\Options\ActivityTypeOptions;
use App\Options\LanguageOptions;
use App\Options\QuestionTypeOptions;
use App\Options\DifficultyLevelOptions;
use App\Services\ImageService;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
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
        $this->middleware('auth', ['except' => ['index', 'show', 'start', 'qrCode']]);
    }

    /**
     * Process uploaded image as needed and move to a correct location.
     * @param  \App\Services\ImageService       $imageService
     * @param  \App\Http\Requests\StoreActivity $request
     * @return string                                    Image file name
     */
    private function processFeaturedImage(&$imageService, &$request) {
        $originalExtension = $request->file('featured_image')->getClientOriginalExtension();
        $fileName = $imageService->generateUniqueFileName('featured_image_', $originalExtension);

        $imageService->process($request->file('featured_image')->getRealPath(), null, $fileName, 800);

        return $fileName;
    }

    /**
     * Returns options to use with select field for discount voucher.
     * @param boolean $onlyActive Only return active discount vouchers
     * @return array An aerray with an additional empty option at the top
     */
    private function getDiscountVoucherOptions($onlyActive = true)
    {
        $discountVoucherOptions = [ 'NULL' => '',];

        $query = DiscountVoucher::orderBy('created_at', 'asc');

        if ( $onlyActive )
        {
            $query->where('status', '=', 1);
        }

        $vouchers = $query->get();

        if ( $vouchers )
        {
            foreach ( $vouchers as $voucher )
            {
                $discountVoucherOptions[$voucher->id] = $voucher->title;

                if ( !(boolean) $voucher->status )
                {
                    $discountVoucherOptions[$voucher->id] .= ' (' . trans('general.discount-voucher-status.inactive') . ')';
                }
            }
        }

        return $discountVoucherOptions;
    }

    /**
     * Determines if passed id should be treated as an empty field
     * @param  string  $id Dicount voucher identifier
     * @return boolean
     */
    private function isEmptyDiscountVoucher($id)
    {
        return $id === 'NULL';
    }

    /**
     * Returns date object if parsing succeeded
     * @param  string                   $parameterName Parameter name
     * @param  \Illuminate\Http\Request $request       Request object
     * @return mixed                                   Carbon date object or NULL
     */
    private function getParsedDateFromRequest($parameterName, &$request)
    {
        $dateObject = NULL;

        if ( $request->has($parameterName) && $request->get($parameterName) )
        {
            try {
                $dateObject = Carbon::parse($request->get($parameterName));
            }
            catch (\Exception $e)
            {
                // Parsing failed, nothing to be done
            }
        }

        return $dateObject;
    }

    /**
     * Returns the browser input friendly DateTime string
     * @param  \Carbon\Carbon $date Date object
     * @return string               DateTime string suitable for datetime-local input
     */
    private function toBrowserInputFriendlyDateTime(Carbon $date)
    {
        return "{$date->toDateString()}T{$date->toTimeString()}";
    }

    /**
     * Display a listing of activities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ActivityTypeOptions $activityTypeOptions, ZooOptions $zooOptions, LanguageOptions $languageOptions, DifficultyLevelOptions $difficultyLevelOptions)
    {
        $search = [
            'search-text' => $request->has('search-text') ? $request->get('search-text') : '',
            'activity-type' => $request->has('activity-type') ? $request->get('activity-type') : '',
            'difficulty-level' => $request->has('difficulty-level') ? $request->get('difficulty-level') : '',
            'zoo' => $request->has('zoo') ? $request->get('zoo') : '',
            'language' => $request->has('language') ? $request->get('language') : '',
            'search-submitted' => ( $request->has('search-submitted') && (int) $request->get('search-submitted') === 1 ) ? true : false,
        ];

        $query = Activity::orderBy('id', 'desc')->with(['user', 'discountVoucher',]);

        if ( $request->has('search-text') && trim($request->get('search-text')) )
        {
            $query->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . trim($request->get('search-text')) . '%')->orWhere('description', 'like', '%' . trim($request->get('search-text')) . '%');
            });
        }

        if ( $request->has('activity-type') && (int)$request->get('activity-type') !== 0 )
        {
            $query->where('type', '=', (int)$request->get('activity-type'));
        }

        if ( $request->has('difficulty-level') ) {
            $query->where('difficulty_level', '=', (int)$request->get('difficulty-level'));
        }

        if ( $request->has('zoo') && (int)$request->get('zoo') !== 0 )
        {
            $query->where('zoo', '=', (int)$request->get('zoo'));
        }

        if ( $request->has('language') && $request->get('language') !== '0' )
        {
            $query->where('language', '=', $request->get('language'));
        }

        $activities = $query->paginate( config('paginate.limit') );

        if ( $search['search-submitted'] ) {
            $activities->appends($search);
            $activities->fragment('search-results');
        }

        return view('activities/index')->with([
            'activities' => $activities,
            'activityTypeOptions' => $activityTypeOptions->options(),
            'zooOptions' => $zooOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'difficultyLevelOptions' => $difficultyLevelOptions->options(),
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ZooOptions $zooOptions, ActivityTypeOptions $activityTypeOptions, LanguageOptions $languageOptions, QuestionTypeOptions $questionTypeOptions, DifficultyLevelOptions $difficultyLevelOptions)
    {
        $this->authorize('create', Activity::class);

        return view('activities/create')->with([
            'zooOptions' => $zooOptions->options(),
            'activityTypeOptions' => $activityTypeOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'questionTypeOptions' => $questionTypeOptions->options(),
            'difficultyLevelOptions' => $difficultyLevelOptions->options(),
            'activity_items' => old('activity_items') ? ActivityItem::find(old('activity_items')) : [],
            'discountVoucherOptions' => $this->getDiscountVoucherOptions(true),
        ]);
    }

    /**
     * Store newly created activity in database.
     *
     * @param \App\Http\Requests\StoreActivity
     * @param \App\Services\ImageService
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivity $request, ImageService $imageService)
    {
        $activity = new Activity;

        $activity->type = $request->type;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->difficulty_level = $request->difficulty_level;
        $activity->playing_time = $request->playing_time;
        $activity->language = $request->language;
        $activity->contact_information = $request->contact_information;
        if ( $request->hasFile('featured_image') )
        {
            $fileName = $this->processFeaturedImage($imageService, $request);
            $activity->featured_image = $fileName;
        }
        $activity->zoo = $request->zoo;

        if ( $request->has('proximity_check') )
        {
            if ( $request->has('proximity_radius') && (int)$request->proximity_radius )
            {
                $activity->proximity_radius = (int)$request->proximity_radius;
            }
        } else {
            $activity->proximity_check = false;
        }

        $activity->user()->associate( auth()->user() );

        if ( auth()->user()->can('addDiscountVoucher', Activity::class) && $request->has('discount_voucher') ) {
            $voucherId = $request->discount_voucher;

            if ( !$this->isEmptyDiscountVoucher($voucherId) )
            {
                $voucher = DiscountVoucher::find($request->discount_voucher);

                if ( $voucher ) {
                    $activity->discountVoucher()->associate($voucher);
                }
            }
        }

        $activity->save();

        if ( $request->has('activity_items') ) {
            $items = [];
            foreach( $request->activity_items as $index => $item ) {
                $items[$item] = [ 'position' => $index + 1 ];

            }

            if ( $items && count($items) > 0 ) {
                $activity->activityItems()->attach($items);
            }
        }

        return redirect()->route('activity.show', [ 'id' => $activity->id ]);
    }

    /**
     * Display the specified activity.
     *
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        // XXX This seems to fail for guests
        //$this->authorize('view', $activity);

        return view('activities/show')->with('activity', $activity);
    }

    /**
     * Show the form for editing the specified activity.
     *
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity, ZooOptions $zooOptions, ActivityTypeOptions $activityTypeOptions, LanguageOptions $languageOptions, QuestionTypeOptions $questionTypeOptions, DifficultyLevelOptions $difficultyLevelOptions)
    {
        $this->authorize('update', $activity);

        return view('activities/edit')->with([
            'activity' => $activity,
            'zooOptions' => $zooOptions->options(),
            'activityTypeOptions' => $activityTypeOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'questionTypeOptions' => $questionTypeOptions->options(),
            'difficultyLevelOptions' => $difficultyLevelOptions->options(),
            'activity_items' => old('activity_items') ? ActivityItem::find(old('activity_items')) : $activity->activityItems,
            'discountVoucherOptions' => $this->getDiscountVoucherOptions(false),
        ]);
    }

    /**
     * Update the specified activity in database.
     *
     * @param \App\Http\Requests\StoreActivity
     * @param \App\Activity
     * @param \App\Services\ImageService
     * @return \Illuminate\Http\Response
     */
    public function update(StoreActivity $request, Activity $activity, ImageService $imageService)
    {
        $activity->type = $request->type;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->difficulty_level = $request->difficulty_level;
        $activity->playing_time = $request->playing_time;
        $activity->language = $request->language;
        $activity->contact_information = $request->contact_information;
        if ( $request->hasFile('featured_image') ) {
            $originalFeaturedImage = $activity->featured_image;

            $fileName = $this->processFeaturedImage($imageService, $request);
            $activity->featured_image = $fileName;

            if ( $originalFeaturedImage ) {
                $imageService->delete($originalFeaturedImage);
            }
        }
        if ( auth()->user()->can('changeZoo', $activity) )
        {
            $activity->zoo = $request->zoo;
        }

        if ( $request->has('proximity_check') )
        {
            $activity->proximity_check = true;
            if ( $request->has('proximity_radius') && (int)$request->proximity_radius )
            {
                $activity->proximity_radius = (int)$request->proximity_radius;
            } else {
                $activity->proximity_radius = null;
            }
        } else {
            $activity->proximity_check = false;
            $activity->proximity_radius = null;
        }

        if ( auth()->user()->can('changeDiscountVoucher', $activity) && $request->has('discount_voucher') ) {
            $voucherId = $request->discount_voucher;

            if ( $this->isEmptyDiscountVoucher($voucherId) )
            {
                if ( $activity->discountVoucher )
                {
                    $activity->discountVoucher()->dissociate();
                }
            } else {
                $voucher = DiscountVoucher::find($voucherId);

                if ( $voucher ) {
                    if ( $activity->discountVoucher ) {
                        $activity->discountVoucher()->dissociate();
                    }

                    $activity->discountVoucher()->associate($voucher);
                }
            }
        }

        $activity->save();

        if ( $request->has('activity_items') ) {
            $items = [];
            foreach( $request->activity_items as $index => $item ) {
                $items[$item] = [ 'position' => $index + 1 ];

            }

            $activity->activityItems()->sync($items);
        } else {
            $activity->activityItems()->detach();
        }

        return redirect()->route('activity.show', [ 'id' => $activity->id ]);
    }

    /**
     * Remove the specified activity from database.
     *
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $this->authorize('delete', $activity);

        if ( $activity->games->count() > 0 )
        {
            $activity->delete();
        } else {
            $activity->forceDelete();
            $activity->deleteFeaturedImage();
        }

        return redirect()->route('activity.index');
    }

    /**
     * [start description]
     * @param  Activity $activity [description]
     * @return [type]             [description]
     */
    public function start(Activity $activity)
    {
        $game = null;

        if ( Auth::check() ) {
            $game = Game::where([
                'activity_id' => $activity->id,
                'user_id' => auth()->user()->id
            ])->first();
        }

        if ( !$game ) {
            $game = new Game;

            if ( Auth::check() )
            {
                $game->user()->associate( auth()->user() );
            }
            $game->activity()->associate($activity);
            $game->save();
        }

        return redirect()->route('game.play', [ 'id' => $game->id ]);
    }

    /**
     * Display a listing of activities with results.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultsIndex(ZooOptions $zooOptions)
    {
        $this->authorize('viewResultsList', Activity::class);

        $zooIds = [];
        if ( Auth::user()->isAdmin() )
        {
            $zooIds = array_keys($zooOptions->options());
        }
        else if ( Auth::user()->roles )
        {
            foreach ( Auth::user()->roles as $role ) {
                if ( $role->pivot->zoo && !in_array( $role->pivot->zoo, $zooIds ) ) {
                    $zooIds[] = (int)$role->pivot->zoo;
                }
            }
        }

        return view('activities/results-index')->with([
            'activities' => Activity::whereIn('zoo', $zooIds)->orderBy('id', 'desc')->paginate( config('paginate.limit') ),
            'zoos' => array_map(function($id) use ($zooOptions) { return $zooOptions->value($id); }, $zooIds),
        ]);
    }

    /**
     * Display the results for specified activity.
     *
     * @param Illuminate\Http\Request $request  Request object
     * @param \App\Activity           $activity Activity object
     * @return \Illuminate\Http\Response
     */
    public function results(Request $request, Activity $activity)
    {
        $this->authorize('viewResults', $activity);

        $search = [
            'incognito' => ( $request->has('incognito') && (int)$request->incognito === 0 ) ? false : true,
            'incomplete' => ( $request->has('incomplete') && (int)$request->incomplete === 0 ) ? false : true,
            'from' => ( $request->has('from') && $request->from ) ? $this->getParsedDateFromRequest('from', $request) : '',
            'until' => ( $request->has('until') && $request->until ) ? $this->getParsedDateFromRequest('until', $request) : '',
        ];

        $gamesQuery = $activity->games()->orderBy('created_at', 'desc');

        if ( !$search['incognito'] )
        {
            $gamesQuery->whereNotNull('user_id');
        }

        if ( !$search['incomplete'] )
        {
            $gamesQuery->where('complete', '=', 1);
        }

        if ( $search['from'] && $search['until'] )
        {
            $gamesQuery->where(function($gamesQuery) use ($search) {
                $gamesQuery->where('created_at', '>=', $search['from'])->where('created_at', '<=', $search['until']);
            });
        }
        else if ( $search['from'] )
        {
            $gamesQuery->where('created_at', '>=', $search['from']);
        }
        else if ( $search['until'] )
        {
            $gamesQuery->where('created_at', '<=', $search['until']);
        }

        $games = $gamesQuery->paginate( config('paginate.limit') );

        // Turn dates into strings, make sure the result is suitable from the borowser input
        if ( $search['from'] )
        {
            $search['from'] = $this->toBrowserInputFriendlyDateTime($search['from']);
        }
        if ( $search['until'] )
        {
            $search['until'] = $this->toBrowserInputFriendlyDateTime($search['until']);
        }

        if ( !$search['incomplete'] || !$search['incognito'] || $search['from'] || $search['until'] )
        {
            $games->appends($search);
        }

        return view('activities/results')->with([
            'activity' => $activity,
            'games' => $games,
            'filters' => $search,
        ]);
    }

    /**
     * Responds with activity QR Code formatted as SVG.
     * @param  \App\Activity $activity Activity model
     * @return \Illuminate\Http\Response
     */
    public function qrCode(Activity $activity)
    {
        $url = route('activity.show', ['id' => $activity->id]);
        $qrCode = QrCode::size(500)->errorCorrection('H')->generate($url);

        return [
            'qrcode' => $qrCode,
        ];
    }
}
