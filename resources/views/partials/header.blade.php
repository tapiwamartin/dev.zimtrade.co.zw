@extends('layouts.master')
@section('content')

@can('isAuthorised')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <h3>Hi {{Auth::user()->name}}, {{Auth::user()->authorised(Auth::id())==null?" Your account is UnAuthorised we have notified the administrator!":""}} </h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                </div>
            </div>
        </div>
    </div>
@endcan
@stop
