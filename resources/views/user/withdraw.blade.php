@extends('layouts.user.master')

@section('title', 'Withdraw')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
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
                        @if(Session::has('success'))
                            <div class="alert alert-success">You have successfully withdrawn funds to {{Session::get('success')}}!</div>
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
    <div class="row" style="margin-top: 5%">
        <!-- DataTales Example -->
        <div class="card shadow col-md-12">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Withdrawals</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>Tx</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Tx</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($withdraws as $withdraw)
                            <tr>
                                <td>{{$withdraw->id}}</td>
                                <td>{{$withdraw->to->public_address}}</td>
                                <td>{{$withdraw->amount}} ICX</td>
                                <td>{{$withdraw->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection