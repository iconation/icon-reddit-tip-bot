@extends('layouts.user.master')

@section('title','Dashboard')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Balance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$balance}} ICX</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tips</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tipsAmount}} ICX ({{$tipsCount}})
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('dashboard.deposit.show')}}">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Deposits (total)
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$depositedAmount}}ICX
                                            ({{$depositsCount}})
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Withdrawals (total)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$withdrawnAmount}} ICX
                                ({{$withdrawsCount}})
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- DataTales Example -->
        <div class="card shadow col-md-12">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>Tx</th>
                            <th>Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Tx</th>
                            <th>Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Date</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->type}}</td>
                                <td>{{$transaction->from->public_address}}</td>
                                <td>{{$transaction->to->public_address}}</td>
                                <td>{{$transaction->date}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
