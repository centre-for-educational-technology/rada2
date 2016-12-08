<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ActivityItem;

use App\Http\Requests\StoreActivityItem;

class ActivityItemController extends Controller
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
   * Display a listing of ActivityItems.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('activity_items/index')->with('activity_items', ActivityItem::all());
  }

  /**
   * Show the form for creating a new ActivityItem.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $this->authorize('create', ActivityItem::class);

      return view('activity_items/create');
  }

  /**
   * Store newly created activity in database.
   *
   * @param \App\Http\Requests\StoreActivityItem';
   * @return \Illuminate\Http\Response
   */
  public function store(StoreActivityItem $request)
  {
      $item = new ActivityItem;

      $item->title = $request->title;
      $item->description = $request->description;
      $item->type = $request->type;
      $item->question = ''; // TODO This one should be filled with JSON-encoded string
      $item->zoo = $request->zoo;
      $item->language = $request->language;
      $item->latitude = $request->latitude;
      $item->longitude = $request->longitude;

      $item->user()->associate( auth()->user() );

      $item->save();

      return redirect()->route('activity_item.show', [ 'id' => $item->id ]);
  }

  /**
   * Display the specified ActivityItem.
   *
   * @param \App\Activity
   * @return \Illuminate\Http\Response
   */
  public function show(ActivityItem $activity_item)
  {
      // XXX This seems to fail for guests
      //$this->authorize('view', $activity_item);

      return view('activity_items/show')->with('activity_item', $activity_item);
  }

  /**
   * Show the form for editing the specified activity.
   *
   * @param \App\ActivityItem
   * @return \Illuminate\Http\Response
   */
  public function edit(ActivityItem $activity_item)
  {
      $this->authorize('update', $activity_item);

      return response('Not implemented', 501);
      //return view('activity_items/edit')->with('activity_item', $activity_item);
  }

  /**
   * Update the specified activity in database.
   *
   * @param \App\Http\Requests\StoreActivityItem;
   * @param \App\ActivityItem
   * @return \Illuminate\Http\Response
   */
  public function update(StoreActivityItem $request, ActivityItem $activity_item)
  {
      return response('Not implemented', 501);
      //return redirect()->route('activity.show', [ 'id' => $activity->id ]);
  }

  /**
   * Remove the specified activity from database.
   *
   * @param \App\ActivityItem
   * @return \Illuminate\Http\Response
   */
  public function destroy(ActivityItem $activity_item)
  {
      $this->authorize('delete', $activity_item);

      return response('Not implemented', 501);
  }
}
