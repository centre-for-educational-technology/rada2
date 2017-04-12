<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreActivity;

use App\Activity;
use App\ActivityItem;
use App\Game;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use Auth;

use App\Options\ZooOptions;
use App\Options\ActivityTypeOptions;
use App\Options\LanguageOptions;
use App\Options\QuestionTypeOptions;

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
        $this->middleware('auth', ['except' => ['index', 'show', 'start']]);
    }

    /**
     * Process uploaded image as needed and move to a correct location.
     * @param  \App\Http\Requests\StoreActivity $request
     * @return string                                    Image file name
     */
    private function processFeaturedImage(&$request) {
        $originalExtension = $request->file('featured_image')->getClientOriginalExtension();
        $fileName = sha1(uniqid('featured_image_', true)) . '.' . $originalExtension;

        $image = Image::make($request->file('featured_image')->getRealPath());

        $image->resize(800, null, function($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        });
        $image->resize(null, 800, function($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        });

        $image->save(public_path('uploads/images/' . $fileName));

        return $fileName;
    }

    /**
     * Display a listing of activities..
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ActivityTypeOptions $activityTypeOptions, ZooOptions $zooOptions, LanguageOptions $languageOptions)
    {
        $search = [
            'search-text' => $request->has('search-text') ? $request->get('search-text') : '',
            'activity-type' => $request->has('activity-type') ? $request->get('activity-type') : '',
            'difficulty-level' => $request->has('difficulty-level') ? $request->get('difficulty-level') : Activity::getDifficultyLevelMinimum() . ';' . Activity::getDifficultyLevelMaximum(),
            'zoo' => $request->has('zoo') ? $request->get('zoo') : '',
            'language' => $request->has('language') ? $request->get('language') : '',
            'search-submitted' => ( $request->has('search-submitted') && (int) $request->get('search-submitted') === 1 ) ? true : false,
        ];

        $query = Activity::orderBy('id', 'desc')->with('user');

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
            $parts = explode(';', $request->get('difficulty-level'), 2);

            if ( count($parts) === 2 && ( (int)$parts[0] <= (int)$parts[1] ) )
            {
                $query->where('difficulty_level_start', '<=', (int)$parts[1]);
                $query->where('difficulty_level_end', '>=', (int)$parts[0]);
            }
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
            'difficultyLevelMinimum' => Activity::getDifficultyLevelMinimum(),
            'difficultyLevelMaximum' => Activity::getDifficultyLevelMaximum(),
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ZooOptions $zooOptions, ActivityTypeOptions $activityTypeOptions, LanguageOptions $languageOptions, QuestionTypeOptions $questionTypeOptions)
    {
        $this->authorize('create', Activity::class);

        return view('activities/create')->with([
            'zooOptions' => $zooOptions->options(),
            'activityTypeOptions' => $activityTypeOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'questionTypeOptions' => $questionTypeOptions->options(),
            'difficultyLevelMinimum' => Activity::getDifficultyLevelMinimum(),
            'difficultyLevelMaximum' => Activity::getDifficultyLevelMaximum(),
        ]);
    }

    /**
     * Store newly created activity in database.
     *
     * @param \App\Http\Requests\StoreActivity;
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivity $request)
    {
        $activity = new Activity;

        $activity->type = $request->type;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->difficulty_level_start = $request->difficulty_level_start;
        $activity->difficulty_level_end = $request->difficulty_level_end;
        $activity->playing_time = $request->playing_time;
        $activity->language = $request->language;
        $activity->contact_information = $request->contact_information;
        if ( $request->hasFile('featured_image') )
        {
            $fileName = $this->processFeaturedImage($request);
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
    public function edit(Activity $activity, ZooOptions $zooOptions, ActivityTypeOptions $activityTypeOptions, LanguageOptions $languageOptions, QuestionTypeOptions $questionTypeOptions)
    {
        $this->authorize('update', $activity);

        return view('activities/edit')->with([
            'activity' => $activity,
            'zooOptions' => $zooOptions->options(),
            'activityTypeOptions' => $activityTypeOptions->options(),
            'languageOptions' => $languageOptions->options(),
            'questionTypeOptions' => $questionTypeOptions->options(),
            'difficultyLevelMinimum' => Activity::getDifficultyLevelMinimum(),
            'difficultyLevelMaximum' => Activity::getDifficultyLevelMaximum(),
        ]);
    }

    /**
     * Update the specified activity in database.
     *
     * @param \App\Http\Requests\StoreActivity;
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function update(StoreActivity $request, Activity $activity)
    {
        $activity->type = $request->type;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->difficulty_level_start = $request->difficulty_level_start;
        $activity->difficulty_level_end = $request->difficulty_level_end;
        $activity->playing_time = $request->playing_time;
        $activity->language = $request->language;
        $activity->contact_information = $request->contact_information;
        if ( $request->hasFile('featured_image') ) {
            $originalFeaturedImage = $activity->featured_image;

            $fileName = $this->processFeaturedImage($request);
            $activity->featured_image = $fileName;

            if ( $originalFeaturedImage ) {
                File::delete(public_path('uploads/images/' . $originalFeaturedImage));
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

        $activity->delete();
        $activity->deleteFeaturedImage();

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
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function results(Activity $activity)
    {
        $this->authorize('viewResults', $activity);

        return view('activities/results')->with('activity', $activity);
    }
}
