<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use mitsosf\IconSDK\IconService;
use mitsosf\IconSDK\Wallet;

class AddressController extends Controller
{
    public function createAddress()
    {
        $wallet = new Wallet();

        $address = new Address();
        $address->private = $wallet->getPrivateKey();
    }
}
