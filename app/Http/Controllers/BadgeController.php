<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Badge;

use App\User;

use Auth;

use App\Services\OpenBadgesService;

use Illuminate\Support\Facades\DB;

class BadgeController extends Controller
{
    /**
     * Display listing of Badges
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('badges/index')->with([
            'badges' => Badge::orderBy('position', 'asc')->get(),
        ]);
    }

    /**
     * Respond with Issuer data
     * @param  OpenBadgesService $openBadgesService OpenBadgesService object
     * @return array                                Issuer data
     */
    public function issuer(OpenBadgesService $openBadgesService)
    {
        return $openBadgesService->issuerData();
    }

    /**
     * Respnds with public key
     * @param  OpenBadgesService $openBadgesService OpenBadgesService object
     * @return string                               Key text with correct Content-Type header
     */
    public function publicKey(OpenBadgesService $openBadgesService)
    {
        return response($openBadgesService->getPublicKey())
            ->header('Content-Type', 'application/x-pem-file');
    }

    /**
     * Respond with Badge data
     * @param  Badge  $badge Badge object
     * @return array         Badge data
     */
    public function badge(OpenBadgesService $openBadgesService, Badge $badge)
    {
        return $openBadgesService->badgeData($badge);
    }

    /**
     * Respond with Assertion data
     * @param  OpenBadgesService $openBadgesService OpenBadgesService object
     * @param  Badge             $badge             Badge object
     * @param  User              $user              User object Assertion belongs to
     * @return array                               Assertion data
     */
    public function assertion(OpenBadgesService $openBadgesService, Badge $badge, User $user)
    {
        $hasBadge = $user->hasBadge($badge);

        if ( !$user->hasBadge($badge) )
        {
            return response()->json(['error' => 'Not Found.'], 404);
        }

        return $openBadgesService->assertionData($badge, $user);
    }

    /**
     * Responds with signed assertions and badges for current user
     * @param  OpenBadgesService $openBadgesService OpenBadgesService object
     * @return array                                Array with Badge ID and Assertion JWS
     */
    public function mine(OpenBadgesService $openBadgesService) {
        if ( !Auth::guard('web')->check() ) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $signedAssertions = [];
        $user = Auth::user();
        $badges = $user->badges;

        if ( $badges && count($badges) > 0 )
        {
            foreach ( $badges as $badge )
            {
                $signedAssertions[] = [
                    'badge' => $badge->id,
                    'assertion' => $openBadgesService->assertionSignature($badge, $user),
                ];
            }
        }

        return $signedAssertions;
    }

    /**
     * Marks assertions as sent
     * @param  Request $request Request object
     * @return array            Array ob affected badges
     */
    public function sent(Request $request)
    {
        if ( !Auth::guard('web')->check() ) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $badges = $request->get('badges');

        if ( $badges && count($badges) > 0 )
        {
            DB::table('badge_user')
                ->where('user_id', Auth::user()->id)
                ->whereIn('badge_id', $badges)
                ->update(['sent' => 1]);

            return $badges;
        }

        return [];
    }
}
