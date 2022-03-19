@extends('layouts.master')
@section('content')
<div class="row">
    <div class="page-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
{{--                        <h3>Hi {{Auth::user()->name}}, </h3>--}}
                        <p class="text-subtitle text-muted"></p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <h6><i class="bi bi-receipt"></i>Assigned Opened
                            <span class="badge bg-info">{{Auth::user()->hasRole(1)?getOpened():getAssignedTicketsOpened(Auth::id())}}</span></h6>
                        <h6><i class="bi bi-receipt"></i>Opened Tickets
                            <span class="badge bg-info">{{Auth::user()->hasRole(1)?getOpened():getOpenTickets(Auth::id())}}</span></h6>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <h6><i class="bi bi-receipt"></i>Assigned Closed
                            <span class="badge bg-info">{{Auth::user()->hasRole(1)?getClosed():getAssignedTicketsClosed(Auth::id())}}</span></h6>
                        <h6><i class="bi bi-receipt-cutoff"></i>Closed Tickets
                            <span class="badge bg-info">{{Auth::user()->hasRole(1)?getClosed():getClosedTickets(Auth::id())}}</span></h6>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <h6><i class="bi bi-receipt"></i>Assigned Reopened
                            <span class="badge bg-info">{{Auth::user()->hasRole(1)?getReopened():getAssignedTicketsReopened(Auth::id())}}</span></h6>
                        <h6><i class="bi bi-receipt"></i>Reopened Tickets
                            <span class="badge bg-info">{{Auth::user()->hasRole(1)?getReopened():getReopenedTickets(Auth::id())}}</span></h6>
                    </div>
                </div>
            </div>

            @can('isAdmin')
                <div class="col-md-3">
                    <div class="card ">
                        <div class="card-body">
                            <h6><i class="bi bi-people"></i>UnAuthorised Users
                                <span class="badge bg-info">{{Auth::user()->hasRole(1)?getTotalUsersUnAuthorised():''}}</span> </h6>
                            <h6><i class="bi bi-people"></i>Authorised Users
                                <span class="badge bg-info">{{Auth::user()->hasRole(1)?getTotalUsersAuthorised():''}}</span> </h6>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
                <a href="{{route('newsletter.create')}}" class=" btn btn-outline-success  mb-2"> Create NewsLetter</a>
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered small font-weight " id="table1" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Created</th>
                                    <th></th>


                                </tr>
                                </thead>

                                <tbody>
                                @forelse($newsletters as $newsletter)
                                    <tr>
                                        <td>{{$newsletter->id}}</td>
                                        <td>{{$newsletter->subject}}</td>
                                        <td>{{\Carbon\Carbon::parse($newsletter->created_at)->diffForHumans()}}</td>
                                        <td>


                                                                <a  href="{{route('newsletter.show',$newsletter)}}">
                                                                    <i class="bi bi-eye small font-weight"></i>
                                                                    View NewsLetter
                                                                </a> &nbsp;





                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-uppercase text-danger text-center text">No Newsletters Found</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    @stop
