<?php

namespace App\Http\Controllers;

use App\ExternalImageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ExternalImageController extends Controller
{
    /**
     * Fetches value from the cache or determines support and caches result for one hour.
     *
     * @return bool
     */
    private function dbSupportsStDistanceSphere(): bool
    {
        $keyName = 'supports_st_distance_sphere';

        if (Cache::has($keyName)) {
            return !!Cache::get($keyName);
        }

        try {
            DB::select('SELECT ST_Distance_Sphere(point(0, 0), point(0,0)) AS distance');
            Cache::put($keyName, true, now()->addHours(1));

            return true;
        } catch (\Exception $e) {
            if (empty(DB::select("SHOW FUNCTION STATUS WHERE name='CUSTOM_ST_Distance_Sphere'"))) {
                // Solution source: https://stackoverflow.com/a/60991531/2704169
                $fnQuery = <<<FNQUERY
CREATE FUNCTION CUSTOM_ST_Distance_Sphere(pt1 POINT, pt2 POINT)
RETURNS double(10,2) DETERMINISTIC

RETURN 6371000 * 2 * ASIN(
    SQRT(
        POWER(SIN((ST_Y(pt2) - ST_Y(pt1)) * pi()/180 / 2), 2) +
        COS(ST_Y(pt1) * pi()/180 ) *
        COS(ST_Y(pt2) * pi()/180) *
        POWER(SIN((ST_X(pt2) - ST_X(pt1)) * pi()/180 / 2), 2)
    )
)
FNQUERY;
                DB::statement($fnQuery);
            }

            Cache::put($keyName, false, now()->addHours(1));

            return false;
        }
    }

    /**
     * Returns JsonResponse with photos data for a location search based on distance.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function apiLocationBasedSearch(Request $request): JsonResponse
    {

        $validatedData = $this->validate($request, [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'distance' => 'required|integer',
        ]);

        $data = [
            'total' => 0,
            'results' => [],
        ];

        $query = ExternalImageResource::selectRaw(sprintf('id, latitude, longitude, title, description, provider, image_url, page_url, created_at, updated_at, %s(point(%f, %f), point(longitude, latitude)) AS distance_in_meters', $this->dbSupportsStDistanceSphere() ? 'ST_Distance_Sphere' : 'CUSTOM_ST_Distance_Sphere', (float) $validatedData['longitude'], (float) $validatedData['latitude']))
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->having('distance_in_meters', '<=', (int) $validatedData['distance'])
            ->orderBy('distance_in_meters', 'asc');

        $result = $query->paginate(config('paginate.limit'));

        $result->appends([
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'distance' => $validatedData['distance'],
        ]);

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
