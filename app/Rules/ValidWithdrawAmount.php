<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use mitsosf\IconSDK\IconService;

class ValidWithdrawAmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match('/^-?(?:\d+|\d*\.\d+)$/',$value)){
            return false;
        }
        $value = floatval($value);
        $transactionFee = 0.001;

        $iconservice = new IconService(env('ICONSERVICE_URL_TESTNET'));
        $balance = $iconservice->hexToIcx($iconservice->icx_getBalance(Auth::user()->wallets()->first()->public_address)->result);

        $maxAmount = $balance-$transactionFee;
        if ($value <= 0 || $value > $maxAmount) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid ICX withdraw amount';
    }
}
