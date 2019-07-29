@extends('layouts.user.master')

@section('title','Transaction '.$transaction->id)

@section('content')
    Transaction data:  <br>
    {{$transaction}}
@endsection
