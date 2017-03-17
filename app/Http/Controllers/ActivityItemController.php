<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use App\ActivityItem;

use App\Http\Requests\StoreActivityItem;

use App\ActivityItemOption;

use App\ActivityItemPair;

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
   * Process uploaded image as needed and move to a correct location.
   * @param  \App\Http\Requests\StoreActivity $request
   * @return string                                    Image file name
   */
  private function processUploadedOptionImage(&$request, $name, $path) {
      $originalExtension = $request->file($name)->getClientOriginalExtension();
      $fileName = sha1(uniqid('activity_item_image_', true)) . '.' . $originalExtension;

      $image = Image::make($request->file($name)->getRealPath());

      $image->resize(500, null, function($constraint) {
          $constraint->upsize();
          $constraint->aspectRatio();
      });
      $image->resize(null, 500, function($constraint) {
          $constraint->upsize();
          $constraint->aspectRatio();
      });

      if ( !File::isDirectory( public_path('uploads/images/' . $path) ) ) {
          File::makeDirectory( public_path('uploads/images/' . $path) );
      }

      $image->save(public_path('uploads/images/' . $path  . $fileName));


      return $fileName;
  }

  /**
   * [deleteRemovedOptions description]
   * @param  [type] $request         [description]
   * @param  [type] $current_options [description]
   * @return [type]                  [description]
   */
  private function deleteRemovedOptions(&$request, &$current_options) {
      foreach ( $current_options as $id => $option ) {
          if ( !in_array($id, $request->ids) ) {
              $option->deleteImage();
              $option->delete();
          }
      }
  }

  /**
   * [deleteRemovedPairs description]
   * @param  [type] $request       [description]
   * @param  [type] $current_pairs [description]
   * @return [type]                [description]
   */
  private function deleteRemovedPairs(&$request, &$current_pairs) {
      foreach ( $current_pairs as $id => $item ) {
          if ( !in_array($id, $request->ids ) ) {
              $item->deleteImage();
              $item->deleteImageMatch();
              $item->delete();
          }
      }
  }

  /**
   * Display a listing of ActivityItems.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('activity_items/index')->with('activity_items', ActivityItem::orderBy('id', 'desc')->with('user')->paginate( config('paginate.limit') ));
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

      if ( $item->isEmbeddedContent() && $request->{'embedded-content'} ) {
          $item->embedded_content = $request->{'embedded-content'};
      }

      $item->zoo = $request->zoo;
      $item->language = $request->language;
      $item->latitude = $request->latitude;
      $item->longitude = $request->longitude;

      $item->user()->associate( auth()->user() );

      $item->save();

      $path = $item->getStoragePath();

      // TODO It might make sense to move contents of these blocks to standalone
      // functions, as they act after item has alreayd been created
      if ( $item->isOneCorrectAnswer() ) {
          $options = [];
          $correct = -1;

          if ( $request->has('correct') ) {
              $correct = (int)$request->correct;
          }

          foreach ( $request->options as $key => $option ) {
              $tmp =  new ActivityItemOption;

              $tmp->option = $option;
              $tmp->correct = (int)( $key === $correct );
              if ( $request->hasFile('option-image-' . $key) ) {
                  $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
              }

              $options[] = $tmp;
          }

          $item->options()->saveMany($options);
      }

      if ( $item->isMultipleCorrectAnswers() ) {
          $options = [];
          $correct = [];

          if ( $request->has('correct') ) {
              $correct = $request->correct;
          }
          foreach ( $request->options as $key => $option ) {
              $tmp = new ActivityItemOption;

              $tmp->option = $option;
              $tmp->correct = (int)in_array($key, $correct);
              if ( $request->hasFile('option-image-' . $key) ) {
                  $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
              }

              $options[] = $tmp;
          }

          $item->options()->saveMany($options);
      }

      if ( $item->isMatchPairs() ) {
          $pairs = [];

          foreach ( $request->options as $key => $option ) {
              $tmp = new ActivityItemPair;

              $tmp->option = $option;
              $tmp->option_match = $request->matches[$key];
              if ( $request->hasFile('option-image-' . $key) ) {
                  $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
              }
              if ( $request->hasFile('option-match-image-' . $key) ) {
                  $tmp->image_match = $this->processUploadedOptionImage($request, 'option-match-image-' . $key, $path);
              }


              $pairs[] = $tmp;
          }

          $item->pairs()->saveMany($pairs);
      }

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

      return view('activity_items/edit')->with('activity_item', $activity_item);
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
      $activity_item->title = $request->title;
      $activity_item->description = $request->description;

      if ( $activity_item->isEmbeddedContent() ) {
          $activity_item->embedded_content = $request->input('embedded-content', '');
      }

      $activity_item->zoo = $request->zoo;
      $activity_item->language = $request->language;
      $activity_item->latitude = $request->latitude;
      $activity_item->longitude = $request->longitude;

      $activity_item->save();

      $path = $activity_item->getStoragePath();

      // TODO It might make sense to move contents of these blocks to standalone
      // functions, as they act after item has alreayd been created
      if ( $activity_item->isOneCorrectAnswer() ) {
          $current_options = $activity_item->options->getDictionary();
          $options = [];
          $correct = -1;


          if ( $request->has('correct') ) {
              $correct = (int)$request->correct;
          }

          foreach ( $request->options as $key => $option ) {
              if ( $request->ids[$key] ) {
                  $tmp = $current_options[$request->ids[$key]];

                  $tmp->option = $option;
                  $tmp->correct = (int)( $key === $correct );
                  if ( $request->hasFile('option-image-' . $key) ) {
                      if ( $tmp->image ) {
                          $tmp->deleteImage();
                          $tmp->image = null;
                      }
                      $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
                  }
                  $options[] = $tmp;
              } else {
                  $tmp =  new ActivityItemOption;

                  $tmp->option = $option;
                  $tmp->correct = (int)( $key === $correct );
                  if ( $request->hasFile('option-image-' . $key) ) {
                      $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
                  }

                  $options[] = $tmp;
              }
          }

          $this->deleteRemovedOptions($request, $current_options);

          $activity_item->options()->saveMany($options);
      }

      if ( $activity_item->isMultipleCorrectAnswers() ) {
          $current_options = $activity_item->options->getDictionary();
          $options = [];
          $correct = [];

          if ( $request->has('correct') ) {
              $correct = $request->correct;
          }
          foreach ( $request->options as $key => $option ) {
              if ( $request->ids[$key] ) {
                  $tmp = $current_options[$request->ids[$key]];

                  $tmp->option = $option;
                  $tmp->correct = (int)in_array($key, $correct);
                  if ( $request->hasFile('option-image-' . $key) ) {
                      if ( $tmp->image ) {
                          $tmp->deleteImage();
                          $tmp->image = null;
                      }
                      $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
                  }

                  $options[] = $tmp;
              } else {
                  $tmp = new ActivityItemOption;

                  $tmp->option = $option;
                  $tmp->correct = (int)in_array($key, $correct);
                  if ( $request->hasFile('option-image-' . $key) ) {
                      $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
                  }

                  $options[] = $tmp;
              }
          }

          $this->deleteRemovedOptions($request, $current_options);

          $activity_item->options()->saveMany($options);
      }

      if ( $activity_item->isMatchPairs() ) {
          $current_pairs = $activity_item->pairs->getDictionary();

          $pairs = [];

          foreach ( $request->options as $key => $option ) {
              if ( $request->ids[$key] ) {
                  $tmp = $current_pairs[$request->ids[$key]];

                  $tmp->option = $option;
                  $tmp->option_match = $request->matches[$key];

                  if ( $request->hasFile('option-image-' . $key) ) {
                      if ( $tmp->image ) {
                          $tmp->deleteImage();
                          $tmp->image = null;
                      }
                      $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
                  }
                  if ( $request->hasFile('option-match-image-' . $key) ) {
                      if ( $tmp->image_match ) {
                          $tmp->deleteImageMatch();
                          $tmp->image_match = null;
                      }
                      $tmp->image_match = $this->processUploadedOptionImage($request, 'option-match-image-' . $key, $path);
                  }

                  $pairs[] = $tmp;
              } else {
                  $tmp = new ActivityItemPair;

                  $tmp->option = $option;
                  $tmp->option_match = $request->matches[$key];
                  if ( $request->hasFile('option-image-' . $key) ) {
                      $tmp->image = $this->processUploadedOptionImage($request, 'option-image-' . $key, $path);
                  }
                  if ( $request->hasFile('option-match-image-' . $key) ) {
                      $tmp->image_match = $this->processUploadedOptionImage($request, 'option-match-image-' . $key, $path);
                  }

                  $pairs[] = $tmp;
              }
          }

          $this->deleteRemovedPairs($request, $current_pairs);

          $activity_item->pairs()->saveMany($pairs);
      }

      return redirect()->route('activity_item.show', [ 'id' => $activity_item->id ]);
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

      $path = $activity_item->getStoragePath();

      $activity_item->delete();

      if ( File::isDirectory( public_path('uploads/images/' . $path) ) ) {
          File::deleteDirectory( public_path('uploads/images/' . $path) );
      }

      return redirect()->route('activity_item.index');
  }

  /**
   * [answer description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function search(Request $request)
  {
      $query = ActivityItem::select('id', 'title', 'description', 'type', 'zoo', 'language');

      if ( $request->has('keywords') && trim($request->get('keywords')) ) {
          $query->where(function($query) use ($request) {
              $query->where('title', 'like', '%' . trim($request->get('keywords')) . '%')
                    ->orWhere('description', 'like', '%' . trim($request->get('keywords')) . '%');
          });
      }
      if ( $request->has('zoo') && (int)$request->get('zoo') !== 0 ) {
          $query->where('zoo', '=', (int)$request->get('zoo'));
      }
      if ( $request->has('questionType') && (int)$request->get('questionType') !== 0 ) {
          $query->where('type', '=', (int)$request->get('questionType'));
      }
      if ( $request->has('language') && $request->get('language') !== '0' ) {
          $query->where('language', '=', $request->get('language'));
      }
      if ( $request->has('difficultyLevel') ) {
          // TODO Implement once this is added to the model
      }
      if ( $request->has('playingTime') ) {
          // TODO Implement once this is added to the model
      }

      return $query->paginate( config('paginate.limit') );
  }
}
