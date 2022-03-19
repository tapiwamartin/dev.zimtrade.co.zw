@extends('layouts.master')

@section('content')
<style type="text/css">
    .comment::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.comment {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>
<div class="row">
    <div class="page-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Hi {{Auth::user()->name}}, </h3>
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
<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Newsletter Overview</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">

                                            <h4 class="small font-weight">Newsletter Subject</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$newsletter->subject}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <h4 class="small font-weight">Newsletter Description</h4>
                                            <div class="small font-weight-bold mb-4">
                                                <p>{{$newsletter->description}}</p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="small font-weight">Attachment(s)</h4>
                                             @forelse($newsletter->newsletterFile as $attachment)
                                                <a href="{{route('news.download',$attachment->id)}}" style="text-decoration: none"><i
                                                        class="bi bi-file text-info fa-sm "></i>{{$attachment->name}}</a>
                                            @empty
                                                 <p class="text-danger">No attachments on this Newsletter</p>
                                            @endforelse
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>


                </div>
                    </div>
@endsection
