@extends('layouts.master')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
             @if(Route::CurrentRouteName()=='dashboard')
                <h3>Hi {{Auth::user()->name}} {{Auth::user()->authorised(Auth::id())==null?" Your account is UnAuthorised we have notified the administrator!":""}} </h3>
                <p class="text-subtitle text-muted"></p>
                @endif
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">

            </div>
        </div>
    </div>

@can('isAuthorised')
<div class="row">
    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <img src="{{asset('images/deposit.png')}}" style="height: 100px; display: block;
    margin: 0 auto;">
                <h6>&nbsp;<a class="text-center" href="{{route('deposit.create')}}" style="text-decoration:none;" >Record Amount</a></h6>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <img src="{{asset('images/statement.png')}}" style="height: 100px; display: block;
    margin: 0 auto;">
                <h6>&nbsp;<a href="{{route('deposit.create')}}" style="text-decoration:none;" class="text-center">View Balance</a></h6>

            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <img src="{{asset('images/statement.png')}}" style="height: 100px; display: block;
    margin: 0 auto;">
                <h6>&nbsp;<a href="{{route('deposit.create')}}" style="text-decoration:none;" class="text-center">View Statement</a></h6>

            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <img src="{{asset('images/statement.png')}}" style="height: 100px; display: block;
    margin: 0 auto;">
                <h6><a href="{{route('deposit.create')}}" style="text-decoration:none;" class="text-center">View Regions</a></h6>

            </div>
        </div>
    </div>





@endcan
@stop
