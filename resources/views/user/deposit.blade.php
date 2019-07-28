@extends('layouts.user.master')

@section('title', 'Deposit')

@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card mb-8">
                <div class="card-header">
                    Deposit funds here:
                </div>
                <div class="card-body">{{$address}}</div>
            </div>
            <div class="mb-2"></div>
        </div>
    </div>
    <div class="row" style="margin-top: 5%">
        <!-- DataTales Example -->
        <div class="card shadow col-md-12">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Deposits</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>Tx</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Tx</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($deposits as $deposit)
                            <tr>
                                <td>{{$deposit->id}}</td>
                                <td>{{$deposit->from->public_address}}</td>
                                <td>{{$deposit->to->public_address}}</td>
                                <td>{{$deposit->amount}} ICX</td>
                                <td>{{$deposit->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection