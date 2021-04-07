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

            $query->where('title', 'like', '%' . $search . '%');
        }

        $result = $query->paginate(config('paginate.limit'));

        $data['results'] = $result->items();
        $data['total'] = $result->total();
        $data['previous'] = $result->previousPageUrl();
        $data['next'] = $result->nextPageUrl();

        return response()->json($data);
    }
}
