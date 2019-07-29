@extends('layouts.user.master')

@section('title', 'Withdraw')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card mb-8">
                <div class="card-header">
                    Enter address to withdraw funds to:
                </div>
                <div class="card-body">
                    <form class="form-group" action="{{route('dashboard.withdraw')}}" method="POST">
                        <input id="address" name="address" class="form-control" placeholder="ICX address"
                               style="margin-bottom: 3%">
                        @csrf
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input id="amount" name="amount" class="form-control" placeholder="Amount in ICX (use . for decimal point)"
                               style="margin-bottom: 3%">
                        <p style="font-size: 12px;color: red;">Avail. balance: {{$balance-0.001 < 0 ? 0 : $balance-0.001}} ICX</p>
                        @csrf
                        @error('amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if(Session::has('success'))
                            <div class="alert alert-success">You have successfully withdrawn {{Session::get('amount')}} ICX to {{Session::get('success')}}!</div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control btn btn-success" type="submit" name="Withdraw" id="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mb-2"></div>
        </div>
    </div>
@endsection