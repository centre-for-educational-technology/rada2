<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\User;

use Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->scopes(['public_profile', 'email'])->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        // TODO Need to handle exceptions
        $socialiteUser = Socialite::driver('facebook')->user();

        $user = User::findOrCreateSocialite($socialiteUser);

        Auth::login($user, true);

        return redirect('home');
    }
}
