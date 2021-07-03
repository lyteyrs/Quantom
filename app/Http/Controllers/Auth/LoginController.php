<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleRedirect()
    {
        $googleuser = Socialite::driver('google')->user();

        $user1 = User::where('social_id', $googleuser->getId())->first();

        if (!$user1) {
            $user1 = User::create([
                'email' => $googleuser->getEmail(),
                'name' => $googleuser->getName(),
                'social_id' => $googleuser->getId(),
            ]);

        }
        Auth::login($user1, true);

        return $this->redirectTo;
    }

    public function facebook()
    {
        return Socialite::driver('google')->redirect();
    }

    public function facebookRedirect()
    {
        $fbUser = Socialite::driver('facebook')->user();

        $user2 = User::where('social_id', $fbUser->getId())->first();

        if (!$user2) {
            $user2 = User::create([
                'email' => $fbUser->getEmail(),
                'name' => $fbUser->getName(),
                'social_id' => $fbUser->getId(),
            ]);
        }

        Auth::login($user2, true);

        return $this->redirectTo;
    }
}