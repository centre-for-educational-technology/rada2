<?php

namespace App\Http\Controllers;

use App\Services\AjapaikService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AjapaikController extends Controller
{

    public function photos(Request $request, AjapaikService $ajapaikService): JsonResponse
    {
        $photosApiUrl = $ajapaikService::photosApiUrl();

        try {
            $response = Http::get($photosApiUrl, $request->query());
        } catch (\Exception $e) {
            return response()->json(null, 500);
        }

        if (!$response->ok()) {
            return response()->json([
                'status' => $response->status(),
                'reasonPhrase' => $response->getReasonPhrase(),
            ], $response->status());
        }

        $data = $response->json();

        foreach (['next', 'previous',] as $key) {
            if (isset($data[$key]) && $data[$key]) {
                $data[$key] = str_replace($photosApiUrl, url()->current(), $data[$key]);
            }
        }

        return response()->json($data);
    }
}
