@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>User Activity Logs </h3>
                        <p class="text-subtitle text-muted"></p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">

                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>Properties</th>
                            <th>Transaction Created</th>



                        </tr>
                        </thead>

                        <tbody>
                        @forelse($activities as $activity)
                            <tr>
                                <td>{{$activity->id}}</td>
                                <td>

                                    {{$activity->description}} {{substr(strrchr($activity->subject_type, '\\'),1)}}</td>
                                <td>
                                    @forelse($activity->properties['attributes'] as $property)
                                        {{$property}}
                                    @empty
                                        <small class="text-danger">No Activity Found</small>
                                    @endforelse
                                </td>
<!--                                <td>{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</td>-->



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
