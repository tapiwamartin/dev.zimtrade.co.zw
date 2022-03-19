@extends('layouts.master')
@section('content')
<div class="row">

        <section class="row">
            <div class="col-12 col-lg-12">

                <a href="{{route('ticket.create')}}" class=" btn btn-outline-success  mb-2"> Create Inquiry</a>
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped small font-weight" id="table1" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>

                                    <th>Sector</th>
                                    <th>Assigned to</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th></th>


                                </tr>
                                </thead>

                                <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td>{{$ticket->id}}</td>
                                        <td>{{$ticket->subject}}</td>

                                        <td>{{$ticket->sector->name}}</td>
                                        <td>{{$ticket->agent->name}}</td>
                                        <td>{{$ticket->status->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($ticket->created_at)->diffForHumans()}}</td>
                                        <td>


                                                                <a  href="{{route('ticket.show',$ticket)}}">
                                                                    <i class="bi bi-eye small font-weight"></i>
                                                                    View
                                                                </a> &nbsp;
                                            @can('isAdmin')
                                                                <a  href="{{route('ticket.assign',$ticket)}}">
                                                                    <i class="bi bi-gear small font-weight"></i>
                                                                    Assign
                                                                </a>&nbsp;
                                            @endcan
                                                                <a  href="{{route('close.ticket',$ticket->id)}}">
                                                                    <i class="bi bi-check small font-weight"></i>
                                                                    Close
                                                                </a>




                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-uppercase text-danger text-center text">No Inquiries Found</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    @stop
