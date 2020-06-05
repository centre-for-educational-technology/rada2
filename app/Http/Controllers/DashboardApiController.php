<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Game;
use App\GameAnswer;

class DashboardApiController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth.basic');
      $this->middleware('api.access.verify');
  }

  private function getPage(Request $request) : int
  {
      $page = (int)$request->get('page');

      if ($page < 0)
      {
          abort(400, 'Malformed page parameter! Page value can not be less than zero.');
      }

      return $page;
  }

  private function getLimit(Request $request) : int
  {
      $limit = (int)$request->get('limit', 50);

      if (!($limit >= 1 && $limit <= 500))
      {
          abort(400, 'Malformed limit parameter! Allowed limit values are from 1 to 500.');
      }

      return $limit;
  }

  private function hasFrom(Request $request)
  {
      return $request->has('from');
  }

  private function hasUntil(Request $request)
  {
      return $request->has('until');
  }

  private function getFromTimestamp(Request $request) : int
  {
      return strtotime($request->get('from'));
  }

  private function getUntilTimestamp(Request $request) : int
  {
      return strtotime($request->get('until'));
  }

  private function validateFromAndUntil(Request $request) : void
  {
      if ($this->hasFrom($request))
      {
          $from = $this->getFromTimestamp($request);

          if ($from === FALSE)
          {
              abort(400, 'Malformed from parameter!');
          }
      }

      if ($this->hasUntil($request))
      {
          $until = $this->getUntilTimestamp($request);

          if ($until === FALSE)
          {
              abort(400, 'Malformed until parameter!');
          }
      }

      if (isset($from) && isset($until) && $from && $until)
      {
          if ($from > $until)
          {
              abort(400, 'From parameter value is less than until!');
          }
      }
  }

  private function getRangeStart(Request $request) : int
  {
      if ($request->has('page'))
      {
        return $this->getPage($request) * $this->getLimit($request);
      }

      return 0;
  }

  private function generateLinks(Request $request, int $total_pages) : array
  {
      $links = [];

      $links['self'] = $request->fullUrl();
      if ($this->getPage($request) > 0)
      {
          $links['prev'] = $request->fullUrlWithQuery([
              'page' => $this->getPage($request) - 1,
          ]);
      }
      if ($total_pages > 1 && $this->getPage($request) < ($total_pages - 1))
      {
          $links['next'] = $request->fullUrlWithQuery([
              'page' => $this->getPage($request) + 1,
          ]);
      }

      return $links;
  }

  public function all(Request $request)
  {
      $this->validateFromAndUntil($request);

      $range_start = $this->getRangeStart($request);
      $range_length = $this->getLimit($request);

      $counts = [];

      // Activities
      $activity_query = Activity::with('activityItems');

      if ($request->has('user_id'))
      {
          $activity_query->where('user_id', '=', (int)$request->get('user_id'));
      }

      if ($this->hasFrom($request) && $from = $this->getFromTimestamp($request))
      {
          $activity_query->where('created_at', '>=', $from);
      }

      if ($this->hasUntil($request) && $until = $this->getUntilTimestamp($request))
      {
          $activity_query->where('created_at', '<=', $until);
      }

      $activity_count_query = clone $activity_query;
      $counts[] = $activity_count_query->count();

      $activities = $activity_query->orderBy('id', 'asc')->skip($range_start)->take($range_length)->get();

      // Games
      $game_query = Game::query();

      if ($request->has('user_id'))
      {
          $game_query->where('user_id', '=', (int)$request->get('user_id'));
      }

      if ($this->hasFrom($request) && $from = $this->getFromTimestamp($request))
      {
          $game_query->where('created_at', '>=', $from);
      }

      if ($this->hasUntil($request) && $until = $this->getUntilTimestamp($request))
      {
          $game_query->where('created_at', '<=', $until);
      }

      $game_count_query = clone $game_query;
      $counts[] = $game_count_query->count();

      $games = $game_query->orderBy('created_at', 'asc')->skip($range_start)->take($range_length)->get();

      // Answers
      $answer_query = GameAnswer::query();

      if ($request->has('user_id'))
      {
          $answer_query->join('games', 'game_answers.game_id', '=', 'games.id');
          $answer_query->where('games.user_id', '=', (int)$request->get('user_id'));
      }

      if ($this->hasFrom($request) && $from = $this->getFromTimestamp($request))
      {
          $answer_query->where('game_answers.created_at', '>=', $from);
      }

      if ($this->hasUntil($request) && $until = $this->getUntilTimestamp($request))
      {
          $answer_query->where('game_answers.created_at', '<=', $until);
      }

      $answer_count_query = clone $answer_query;
      $counts[] = $answer_count_query->count();

      $answers = $answer_query->orderBy('game_answers.created_at', 'asc')->skip($range_start)->take($range_length)->get();

      $total_pages = ceil(max($counts) / $range_length);

      return [
          'meta' => [
              'totalPages' => $total_pages,
          ],
          'activities' => $activities,
          'games' => $games,
          'answers' => $answers,
          'links' => $this->generateLinks($request, $total_pages),
      ];
  }
}
