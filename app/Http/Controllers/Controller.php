<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function jsonResponseWithPagination(LengthAwarePaginator &$result, string $resourceClass = null): JsonResponse
    {
        $data = [
            'total' => 0,
            'results' => [],
        ];

        $data['results'] = $resourceClass ? $resourceClass::collection($result->items()) : $result->items();
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
