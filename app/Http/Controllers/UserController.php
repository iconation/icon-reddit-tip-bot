<?php

namespace App\Http\Controllers;

use App\Rules\ValidAddress;
use App\Rules\ValidWithdrawAmount;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use mitsosf\IconSDK\IconService;
use mitsosf\IconSDK\Wallet;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function home()
    {
        $tips = Auth::user()->transactions()->with('from', 'to')->where('type', 'tip')->get();
        $tipsCount = $tips->count();
        $tipsAmount = $tips->sum('amount');

        $iconservice = new IconService(env('ICONSERVICE_URL_TESTNET'));
        $balance = $iconservice->hexToIcx($iconservice->icx_getBalance(Auth::user()->wallets()->first()->public_address)->result);

        return view('user.home', compact( 'tipsCount', 'tipsAmount', 'balance'));
    }

    public function transaction(Transaction $transaction)
    {
        return view('user.transaction', compact('transaction'));
    }

    public function showDeposit()
    {
        $address = Auth::user()->wallets()->get()->first()->public_address;


        $iconservice = new IconService(env('ICONSERVICE_URL_TESTNET'));
        $balance = $iconservice->hexToIcx($iconservice->icx_getBalance(Auth::user()->wallets()->first()->public_address)->result);

        return view('user.deposit', compact('address', 'balance'));
    }

    public function showWithdraw()
    {
        $iconservice = new IconService(env('ICONSERVICE_URL_TESTNET'));
        $balance = $iconservice->hexToIcx($iconservice->icx_getBalance(Auth::user()->wallets()->first()->public_address)->result);

        return view('user.withdraw', compact('withdraws', 'balance'));
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'address' => ['required', new ValidAddress()],
            'amount' => ['required', new ValidWithdrawAmount()]
        ]);

        //Do withdraw logic
        $wallet = Auth::user()->wallets()->get()->first();
        $privateKey = $wallet->getPrivateKey();
        $localAddress = $wallet->public_address;
        $destinationAddress = $request->get('address');

        $iconService = new IconService(env('ICONSERVICE_URL_TESTNET'));
        $amount = $iconService->icxToHex(floatval($request->get('amount')));

        $result = $iconService->send($localAddress, $destinationAddress, $amount, "0x186a0", $privateKey, env('ICON_YEOUIDO_NID'));
        if (!isset($result->error)) {
            //TODO get result, save transaction and update wallet balance
            Session::flash('success', $request->get('address'));
            Session::flash('amount', $request->get('amount'));
            return redirect(route('dashboard.withdraw'));
        } else {
            Session::flash('error', 'The transaction could not be completed. If the problem persists, please contact the Iconation team at htps://iconation.team');
            return redirect(route('dashboard.withdraw'));
        }

    }

    public function settings()
    {
        return view('user.settings');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

}
