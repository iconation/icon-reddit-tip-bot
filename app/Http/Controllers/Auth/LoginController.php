<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $oauthUser = Socialite::driver($provider)->user();

            //Check if user exists
        $user = User::where('username', $oauthUser->nickname)->first();

        if ($user === null) {  //If user doesn't exist
            $user = new User();
            $user->role_id = 1;
            $user->username = $oauthUser->nickname;
            $user->email = $oauthUser->email;
            $user->save();
        }
        else{
            $user->api_token = Str::random(80);
            $user->update();
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
