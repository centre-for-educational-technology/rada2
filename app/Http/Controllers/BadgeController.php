<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Badge;

use App\User;

use Auth;

use App\Services\OpenBadgesService;

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
        return [
            '@context' => $openBadgesService->getContextUri(),
            'id' => route('api.badge.issuer'),
            'type' => 'Issuer',
            'name' => 'Smart Zoos',
            'url' => 'https://smartzoos.eu/',
            'description' => 'Smart Zoos Project',
            'image' => asset('img/logos/logo-square.png'),
            'email' => 'info@smartzoos.eu',
        ];
    }

    /**
     * Respond with Badge data
     * @param  Badge  $badge Badge object
     * @return array         Badge data
     */
    public function badge(Badge $badge)
    {
        return $badge->getBadgeData();
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

        $assertionUrl = route('api.badge.user.assertion', ['badge' => $badge->id, 'user' => $user->id]);

        return [
            '@context' => $openBadgesService->getContextUri(),
            'id' => $assertionUrl,
            'type' => 'Assertion',
            'uid' => $openBadgesService->assertionUid($assertionUrl),
            'recipient' => [
                'identity' => $openBadgesService->hashRecipientIdentity($user->email),
                'type' => 'email',
                'hashed' => true,
            ],
            'badge' => route('api.badge.show', ['badge' => $badge->id]),
            'verify' => [
                'type' => 'hosted',
                'url' => $assertionUrl,
            ],
            'issuedOn' => $badge->created_at->toIso8601String(),
        ];
    }
}
