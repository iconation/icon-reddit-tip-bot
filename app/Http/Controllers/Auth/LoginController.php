<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Wallet;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use mitsosf\IconSDK\Wallet as WalletGenerator;

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
        //If user doesn't grant permissions
        if (request()->get('error') === 'access_denied') {
            return redirect(route('home'));
        }

        $oauthUser = Socialite::driver($provider)->user();

        //Check if user exists
        $user = User::where('username', $oauthUser->nickname)->first();
        if ($user === null) {  //If user doesn't exist
            $user = new User();
            $user->username = $oauthUser->nickname;
            $user->role_id = 1;
            $user->api_token = Str::random(80);
            $user->save();

            $generatedWallet = new WalletGenerator();
            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->private_key = encrypt($generatedWallet->getPrivateKey());
            $wallet->public_key = encrypt($generatedWallet->getPublicKey());
            $wallet->public_address = $generatedWallet->getPublicAddress();
            $wallet->save();
        } else {
            $user->api_token = Str::random(80);
            $user->update();
        }

        Auth::login($user);

        return redirect(route('dashboard'));
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
