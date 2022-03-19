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
<!--                <p>This Section redirects you to a page to log your issue.</p>-->
                <h6><i class="bi bi-receipt"></i>&nbsp;<a href="{{route('ticket.create')}}" style="text-decoration:none;">Create Inquiry</a></h6>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <h6><i class="bi bi-receipt"></i>Assigned Opened
                    <span class="badge bg-info">{{Auth::user()->hasRole(1)?getOpened():getAssignedTicketsOpened(Auth::user()->agentId)}}</span></h6>
                <h6><i class="bi bi-receipt"></i>Opened Inquiries
                    <span class="badge bg-info">{{Auth::user()->hasRole(1)?getOpened():getOpenTickets(Auth::id())}}</span></h6>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <h6><i class="bi bi-receipt"></i>Assigned Closed
                    <span class="badge bg-info">{{Auth::user()->hasRole(1)?getClosed():getAssignedTicketsClosed(Auth::user()->agentId)}}</span></h6>
                <h6><i class="bi bi-receipt-cutoff"></i>Closed Inquiries
                    <span class="badge bg-info">{{Auth::user()->hasRole(1)?getClosed():getClosedTickets(Auth::id())}}</span></h6>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <h6><i class="bi bi-receipt"></i>Assigned Reopened
                    <span class="badge bg-info">{{Auth::user()->hasRole(1)?getReopened():getAssignedTicketsReopened(Auth::user()->agentId)}}</span></h6>
                <h6><i class="bi bi-receipt"></i>Reopened Inquiries
                    <span class="badge bg-info">{{Auth::user()->hasRole(1)?getReopened():getReopenedTickets(Auth::id())}}</span></h6>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <h6><i class="bi bi-receipt"></i>Assigned Overdue
                   <span class="badge bg-danger">{{Auth::user()->hasRole(1)?getOverdue():getAssignedTicketsOverdue(Auth::user()->agentId)}}</span></h6>
                <h6><i class="bi bi-receipt"></i>Overdue Inquiries
                    <span class="badge bg-danger">{{Auth::user()->hasRole(1)?getOverdue():getOverDueTickets(Auth::id())}}</span></h6>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Inquiries Statistics</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div id="piechart_div" class="col-md-6"></div>
                        <div id="barchart_div" class="col-md-6"></div>
                    </div>

                    <div class="row">

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endcan

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load Charts and the corechart and barchart packages.
        google.charts.load('current', {'packages':['corechart']});

        // Draw the pie chart and bar chart when Charts is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
              var closed = {!! json_encode(getClosed()) !!};
                var opened = {!! json_encode(getOpened()) !!};
                var reopened = {!! json_encode(getReopened()) !!};
                var overdue = {!! json_encode(getOverdue()) !!};

                var data = new google.visualization.DataTable();
            data.addColumn('string', 'Inquiries');
            data.addColumn('number', 'Inquiries');
            data.addRows([
                ['Closed',closed ],
                ['OverDue', overdue],
                ['ReOpened', reopened],
                ['Opened', opened],

            ]);

            var piechart_options = {title:'Inquiries based on their statuses',
                width:400,
                height:300};
            var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
            piechart.draw(data, piechart_options);

            var barchart_options = {title:'Inquiries based on their statuses',
                width:400,
                height:300,
                legend: 'none'};
            var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
            barchart.draw(data, barchart_options);
        }
    </script>


@endcan
@stop
