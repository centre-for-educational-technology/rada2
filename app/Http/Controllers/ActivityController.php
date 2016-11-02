<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Activity;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

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
        return view('activities/create');
    }

    /**
     * Store newly created activity in database.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|integer|in:1,2',
            'title' => 'required|max:255',
            //'description' => '',
            'difficulty_level_start' => 'required|integer|between:1,99',
            'difficulty_level_end' => 'required|integer|between:1,99',
            'playing_time' => 'integer|min:0',
            'language' => 'required|in:en,et,ru,fi,swe',
            'contact_information' => 'max:255',
            'featured_image' => 'image|mimes:jpeg,jpg,png',
            'zoo' => 'required|in:1,2,3',
        ]);

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
        // TODO Add permission check: author, connected zoo manager or main administrator
        if (!$activity->canEdit()) {
            return redirect()->route('activity.index');
        }

        return view('activities/edit')->with('activity', $activity);
    }

    /**
     * Update the specified activity in database.
     *
     * @param \Illuminate\Http\Request
     * @param \App\Activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        // TODO Add permission check: author, connected zoo manager or main administrator
        if (!$activity->canEdit()) {
            return redirect()->route('activity.index');
        }

        $this->validate($request, [
            'type' => 'required|integer|in:1,2',
            'title' => 'required|max:255',
            //'description' => '',
            'difficulty_level_start' => 'required|integer|between:1,99',
            'difficulty_level_end' => 'required|integer|between:1,99',
            'playing_time' => 'integer|min:0',
            'language' => 'required|in:en,et,ru,fi,swe',
            'contact_information' => 'max:255',
            'featured_image' => 'image|mimes:jpeg,jpg,png',
            'zoo' => 'required|in:1,2,3',
        ]);

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
        // TODO Add permission check: author, connected zoo manager or main administrator
        // This is probably more complicated. Some games should not be removed (maybe use the soft_removal feature)
    }
}
