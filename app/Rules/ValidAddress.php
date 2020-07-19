<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use mitsosf\IconSDK\Wallet;

class ValidAddress implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $wallet = new Wallet();
        return $wallet->isPublicAddress($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have to use a valid ICX address';
    }
}
