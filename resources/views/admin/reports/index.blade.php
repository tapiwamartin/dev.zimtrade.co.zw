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
                                <table class="table table-bordered" id="table1" >
                                    <thead>
                                        <tr>
                                            <th>Sector</th>
                                            <th>Closed</th>
                                            <th>Opened</th>
                                            <th>Re-opened</th>
                                            <th>Overdue</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                       @for($i=0;$i<sizeof($e);$i++)
                                        <tr>
                                            <td>{{$e[$i]['sector']}}</td>
                                            <td>{{$e[$i]['closed']}}</td>
                                            <td>{{$e[$i]['opened']}}</td>
                                            <td>{{$e[$i]['reopened']}}</td>
                                            <td>{{$e[$i]['overdue']}}</td>

                                        </tr>
                                        @endfor

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @stop
