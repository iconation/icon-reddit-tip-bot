<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function home()
    {
        return view('user.home');
    }

    public function showDeposit()
    {
        return 'Deposit';
    }

    public function showWithdraw()
    {
        return 'Withdraw';
    }

    public function deposit()
    {

    }

    public function withdraw()
    {

    }

    public function settings()
    {
        return 'Settings';
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

}
