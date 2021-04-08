<?php

namespace App\Http\Controllers;

use App\ExternalImageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MuinasController extends Controller
{
    public function photos(Request $request): JsonResponse
    {
        $data = [
            'total' => 0,
            'results' => [],
        ];

        $query = ExternalImageResource::where('provider', '=', 'muinas');

        if ($request->has('search')) {
            $search = trim($request->get('search'));

            $query->whereRaw('MATCH (title, description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$search]);
        }

        $result = $query->paginate(config('paginate.limit'));

        $data['results'] = $result->items();
        $data['total'] = $result->total();

        $previousPageUrl = $result->previousPageUrl();
        $nextPageUrl = $result->nextPageUrl();

        if ($previousPageUrl) {
            $data['previous'] = $previousPageUrl;
        }

        if ($nextPageUrl) {
            $data['next'] = $nextPageUrl;
        }

        return response()->json($data);
    }
}
