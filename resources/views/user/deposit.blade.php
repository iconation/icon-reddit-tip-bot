@extends('layouts.user.master')

@section('title', 'Deposit')

@section('content')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <div class="row">
                <div class="card mb-8">
                    <div class="card-header">
                        Deposit funds here:
                    </div>
                    <div class="card-body">{{$address}}</div>
                </div>
                <div class="mb-2"></div>
            </div>
            <div class="row"  style="margin-top: 20%">
                <div class="card mb-8">
                    <div class="card-header">
                        Balance:
                    </div>
                    <div class="card-body"><h3>{{$balance}} ICX</h3></div>
                </div>
                <div class="mb-2"></div>
            </div>
        </div>
        <div class="col-md-2" style="text-align: center;margin-top: 12%"><h4>- or -</h4></div>
        <div class="col-md-4">
            <div class="card mb-8">
                <div class="card-header">
                    Scan QR code:
                </div>
                <div class="card-body" style="text-align: center">{!!QrCode::size(300)->generate($address)!!}</div>
            </div>
            <div class="mb-2"></div>
        </div>
        <div class="col-md-1"></div>
    </div>
@endsection