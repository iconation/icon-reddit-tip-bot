<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mitsosf\IconSDK\IconService;

class TransactionController extends Controller
{
    public function sendTransaction(){
        $iconServiceUrl = env('APP_ENV', 'local') === 'production' ? env('ICONSERVICE_URL') : env('ICONSERVICE_URL_TESTNET');
        $iconService = new IconService($iconServiceUrl);
        //TODO
    }
}
