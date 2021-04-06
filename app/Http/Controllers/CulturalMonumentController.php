<?php

namespace App\Http\Controllers;

use App\ExternalImageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CulturalMonumentController extends Controller
{
    public function photos(Request $request): JsonResponse
    {
        $data = [
            'total' => 0,
            'results' => [],
        ];

        if ($request->has('search')) {
            $search = trim($request->get('search'));

            $result = ExternalImageResource::where('title', 'like', '%' . $search . '%')->paginate(config('paginate.limit'));
        } else {
            $result = ExternalImageResource::paginate(config('paginate.limit'));
        }

        $data['results'] = $result->items();
        $data['total'] = $result->total();
        $data['previous'] = $result->previousPageUrl();
        $data['next'] = $result->nextPageUrl();

        return response()->json($data);
    }
}
