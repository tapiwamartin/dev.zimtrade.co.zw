@extends('layouts.master')
@section('content')
   <div class="container">
    <div class="card">
        <div class="card-body">
            <img src="{{asset('images/logo.png')}}" style="height: 60px; display: block;
                 margin: 0 auto;">
        </div>

        <h6 class="text-center">ZimTrade Daily Report</h6>
        <div class="text-center offset-md-4">
            <div id="piechart">
            </div>
        </div>
        <div class="col-md-12">
            @forelse($agents as $agent)
            <table class="table table-striped table-responsive-sm mb-3 text-sm">
                <tr><u><b class="text-uppercase">{{$agent->name}}</b></u></tr>
                <th class="col-1">Inquiry#</th>
                <th class="col-3">Created time</th>
                <th class="col-4">Subject</th>
                <th class="col-2">Sector</th>
                <th class="col-2">Origin</th>
                <th class="col-2">Status</th>
                @forelse($agent->tickets as $ticket)
                <tr>

                    <td>{{$ticket->id}}</td>
                    <td>{{$ticket->created_at}}</td>
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->sector->name}}</td>
                    <td>{{$ticket->ticketOwner->organisation}}</td>
                    <td>{{$ticket->status->name}}</td>

                </tr>
                @empty
                    <tr>
                        <td class="text-center text-danger" colspan="6">NO INQUIRIES ASSIGNED TO THIS AGENT</td>
                    </tr>
                @endforelse

            </table>
            @empty
            @endforelse
        </div>

    </div>
   </div>
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

           var piechart_options = {title:'',
               width:400,
               height:300};
           var piechart = new google.visualization.PieChart(document.getElementById('piechart'));
           piechart.draw(data, piechart_options);

           var barchart_options = {title:'Barchart: Tickets based on their statuses',
               width:400,
               height:300,
               legend: 'none'};
           var barchart = new google.visualization.BarChart(document.getElementById('barchart'));
           barchart.draw(data, barchart_options);
       }
   </script>
@stop
