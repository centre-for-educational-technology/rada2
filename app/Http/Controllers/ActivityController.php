<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Activity;

use App\ActivityItem;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use App\Http\Requests\StoreActivity;

use App\Game;

use Auth;

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
    public function index()
    {
        return view('activities/index')->with('activities', Activity::orderBy('id', 'desc')->with('user')->paginate( config('paginate.limit') ));
    }

    /**
     * Show the form for creating a new activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Activity::class);

        return view('activities/create');
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
        if ( $request->hasFile('featured_image') ) {
            $fileName = $this->processFeaturedImage($request);
            $activity->featured_image = $fileName;
        }
        $activity->zoo = $request->zoo;

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
    public function edit(Activity $activity)
    {
        $this->authorize('update', $activity);

        return view('activities/edit')->with('activity', $activity);
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
        $activity->zoo = $request->zoo;

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
    public function resultsIndex()
    {
        $this->authorize('viewResultsList', Activity::class);

        $zooIds = [];
        if ( Auth::user()->isAdmin() )
        {
            $zooIds = array_keys(Activity::getZooOptions());
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
            'zoos' => array_map(function($id) { return Activity::getZoo($id); }, $zooIds),
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
