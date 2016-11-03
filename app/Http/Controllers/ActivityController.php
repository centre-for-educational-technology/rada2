<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Activity;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use App\Http\Requests\StoreActivity;

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
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of activities..
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activities/index')->with('activities', Activity::all());
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
            $originalExtension = $request->file('featured_image')->getClientOriginalExtension();
            $fileName = sha1(uniqid('featured_image_', true)) . '.' . $originalExtension;
            $activity->featured_image = $fileName;
        }
        $activity->zoo = $request->zoo;

        $activity->user()->associate( auth()->user() );

        $activity->save();

        if ( $request->hasFile('featured_image') ) {
            // XXX This could fail
            // Might want to remove entry from the database in that case
            $image = Image::make($request->file('featured_image')->getRealPath());
            // TODO Might only need to resize big images
            // Current ssolution resizes smaller images to bigger dimensions
            $image->resize(800, 800)->save(public_path('uploads/images/' . $activity->featured_image));
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
        $this->authorize('view', $activity);

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
            File::delete(public_path('uploads/images/' . $activity->featured_image));

            $originalExtension = $request->file('featured_image')->getClientOriginalExtension();
            $fileName = sha1(uniqid('featured_image_', true)) . '.' . $originalExtension;
            $activity->featured_image = $fileName;
        }
        $activity->zoo = $request->zoo;

        $activity->user()->associate( auth()->user() );

        $activity->save();

        if ( $request->hasFile('featured_image') ) {
            // XXX This could fail
            // Might want to remove entry from the database in that case
            $image = Image::make($request->file('featured_image')->getRealPath());
            // TODO Might only need to resize big images
            // Current ssolution resizes smaller images to bigger dimensions
            $image->resize(800, 800)->save(public_path('uploads/images/' . $activity->featured_image));
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
    }
}
