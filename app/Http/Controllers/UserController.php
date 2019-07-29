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
        $transactions = Auth::user()->transactions()->with('from', 'to')->get();

        $tips = $transactions->where('type', 'tip');
        $tipsCount = $tips->count();
        $tipsAmount = $tips->sum('amount');

        $deposits = $transactions->where('type', 'deposit');
        $depositsCount = $deposits->count();
        $depositedAmount = $deposits->sum('amount');

        $withdraws = $transactions->where('type', 'withdraw');
        $withdrawsCount = $withdraws->count();
        $withdrawnAmount = $withdraws->sum('amount');

        //TODO tip sender and receiver differentiation
        $balance = Auth::user()->wallets()->sum('balance');

        return view('user.home', compact('transactions', 'depositsCount', 'depositedAmount', 'withdrawsCount', 'withdrawnAmount', 'tipsCount', 'tipsAmount', 'balance'));
    }

    public function transaction(Transaction $transaction){
        return view('user.transaction', compact('transaction'));
    }

    public function showDeposit()
    {
        $address = Auth::user()->wallets()->get()->first()->public_address;
        $deposits = Auth::user()->transactions()->where('type', 'deposit')->with('from', 'to')->get();
        return view('user.deposit', compact('address', 'deposits'));
    }

    public function showWithdraw()
    {
        $maxAmount = floatval(Auth::user()->wallets()->get()->first()->balance);
        $withdraws = Auth::user()->transactions()->where('type', 'withdraw')->with('to')->get();
        return view('user.withdraw', compact('withdraws', 'maxAmount'));
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
        $localAddress = $wallet->publicAddress;
        $destinationAddress = $request->get('address');

        $iconService = new IconService(env('ICONSERVICE_URL_TESTNET'));
        $amount = $iconService->icxToHex(floatval($request->get('amount')));

        $result = $iconService->send($localAddress, $destinationAddress, $amount, "0x186a0",$privateKey, env('ICON_YEOUIDO_NID'));
        if(!isset($result->error)){
            //TODO get result, save transaction and update wallet balance
            Session::flash('success', $request->get('address'));
            return redirect(route('dashboard.withdraw'));
        }else{
            Session::flash('error', $request->get('address'));
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
