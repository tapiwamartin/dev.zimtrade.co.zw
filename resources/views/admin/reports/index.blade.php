@extends('layouts.master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <h3>{{$reportType}}</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                </div>
            </div>
        </div>
    </div>
<div class="card shadow col-md-12  mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                @foreach($regions as $region)
                                <table class="table table-bordered" id="table1" >
                                    <tr><u><b class="text-uppercase">{{$region->name}}</b></u></tr>
                                    <thead>
                                        <tr>
                                            <th>Re</th>
                                            <th>Closed</th>
                                            <th>Opened</th>
                                            <th>Re-opened</th>
                                            <th>Overdue</th>

                                        </tr>
                                    </thead>

                                    <tbody>


                                        @foreach($region->deposits as $deposit)
                                            <tr>
                                                <td>{{$deposit->user->email}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @stop
