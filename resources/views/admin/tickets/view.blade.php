@extends('layouts.master')

@section('content')
<style type="text/css">
    .comment::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.comment {
    overflow-y: auto;
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>
<div class="row">


                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold text-primary">Inquiry Overview</h3>
                                    @can('isAdmin')
                                    <h6>Service Level Agreement (SLA) Time : @if(!is_null($ticket->sla)){{$ticket->sla->hours}} day(s)@else<small class="text-danger">Not set</small>@endif</h6>
                                    @endcan
                                        <h6>Inquiry Created At  : {{$ticket->updated_at}}</h6>
                                    @can('isAdmin')
                                    <h6>Inquiry Assigned At : @if(!is_null($ticket->sla)){{\Carbon\Carbon::parse($ticket->updated_at)}} @else<small class="text-danger">Not set</small>@endif</h6>
                                    <h6>Inquiry Due By :     @if(!is_null($ticket->sla)){{\Carbon\Carbon::parse($ticket->updated_at)->addHours($ticket->sla->hours)}} @else<small class="text-danger">Not set</small>@endif</h6>
                                    @endcan
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">

                                        <h4 class="small font-weight">Requester</h4>
                                        <div class="small font-weight-bold mb-4">
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->ticketOwner->name}}</p>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-3">

                                            <h4 class="small font-weight">Email</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->ticketOwner->email}}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">

                                            <h4 class="small font-weight">Sector</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->sector->name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                            <h4 class="small font-weight">Inquiry Assigned To</h4>
                                            <div class="small font-weight-bold mb-4">

                                                <p>{{$ticket->agent->name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                            <h4 class="small font-weight">Inquiry Status</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->status->name}}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">

                                            <h4 class="small font-weight">Phone:</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <div class="small font-weight-bold mb-4">
                                                    <p>{{$ticket->ticketOwner->phonenumber}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                            <h4 class="small font-weight">Organisation</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->ticketOwner->organisation}}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">

                                            <h4 class="small font-weight">City</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->ticketOwner->city}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                            <h4 class="small font-weight">Country</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->agent->country}}</p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <h4 class="small font-weight">Inquiry Subject</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$ticket->subject}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <h4 class="small font-weight">Inquiry Description</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{!! $ticket->description !!}</p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="small font-weight">Attachment(s)</h4>
                                             @forelse($ticket->ticketFile as $attachment)
                                                <a href="{{route('download',$attachment->id)}}" style="text-decoration: none"><i
                                                        class="bi bi-file text-info fa-sm "></i>{{$attachment->name}}</a>
                                            @empty
                                                 <p class="text-danger">No attachments on this Inquiry</p>
                                            @endforelse
                                        </div>
                                    </div>


                                    <div class="mb-3">


                                        @if($ticket->status->id==1 || $ticket->status->id==3 || $ticket->status->id==4 )
                                        <a href="{{route('close.ticket',$ticket->id)}}" class="btn btn-outline-danger float-end">Close Inquiry</a>
                                            @else
                                              <a href="{{route('reOpen.ticket',$ticket->id)}}" class="btn btn-outline-info float-end">ReOpen-Inquiry</a>

                                                @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div  class="col-lg-12 mb-4" id="chat">
                          <chat :user="{{Auth::user()}}" :ticket="{{$ticket->id}}"></chat>
                        </div>



@endsection
