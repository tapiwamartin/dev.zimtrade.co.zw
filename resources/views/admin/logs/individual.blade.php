@extends('layouts.master')
@section('content')

<div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Action</th>
                                            <th>Subject</th>
                                            <th>Properties</th>
                                            <th>Transaction Created</th>



                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($activities as $activity)
                                        <tr>
                                            <td>{{$activity->id}}</td>
                                            <td>{{$activity->description}}</td>
                                            <td>
                                                {{$activity->subject_type}}</td>
                                            <td>
                                                @forelse($activity->properties['attributes'] as $property)
                                                 {{$property}}
                                                @empty
                                                <small class="text-danger">No Activity Found</small>
                                                @endforelse
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</td>



                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-danger text-center" colspan="5">No Logs Found</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @stop
