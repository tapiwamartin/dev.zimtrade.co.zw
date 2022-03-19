<?php

namespace App\Http\Controllers;

use App\Mail\InquiryAssigned;
use App\Models\Sector;
use App\Models\ServiceLevelAgreement;
use App\Models\Ticket;
use App\Models\TicketFile;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\RoleUser;
use App\Models\DepartmentUser;
use App\Models\User;
use App\Models\Comment;
use App\Mail\InquiryOpened;
use App\Mail\InquiryClosed;
use App\Mail\InquiryReopened;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Swift_TransportException;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified','isAuthorised'],['except'=>'index','create','store','show']);
    }
    public function index()
    {

        if(!Auth::user()->hasRole(1))
        {
             $tickets = Ticket::where(['userId'=>Auth::id()])->orWhere(['agentId'=>Auth::id()])->orderBy('id','DESC')->get();

        return view('admin.tickets.index')->withTickets($tickets);
        }
        else
        {

             $tickets = Ticket::orderBy('id','DESC')->get();

              return view('admin.tickets.index')->withTickets($tickets);

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$activeDepartments = DepartmentUser::pluck('departmentId');
        $departments = Department::whereIn('id',$activeDepartments)->get();*/
        $sectors = Sector::get();
        return view('admin.tickets.create')->withSectors($sectors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//    dd($request);


         if($request->hasFile('fileUpload'))
         {

             $ticket = new Ticket;
             $ticket->subject = $request->subject;
             $ticket->description = $request->description;
             $ticket->userId = Auth::id();
             $ticket->statusId =1;
             $ticket->sectorId = $request->sectorId;
             $ticket->agentId=$this->getAdmin();
             $ticket->save();
             $filename ="ticketFile";
             $path = $request->file('fileUpload')->store('ticketFiles'.'/'.$ticket->id);
             $ticket->ticketFile()->save(new TicketFile(['ticketId'=>$ticket->id,'path'=>$path, 'name'=>$filename]));
             Mail::to($ticket->agent)->queue(new InquiryOpened($ticket));

         }
         else
         {
             $ticket = new Ticket;
             $ticket->subject = $request->subject;
             $ticket->description = $request->description;
             $ticket->userId = Auth::id();
             $ticket->statusId =1;
             $ticket->sectorId = $request->sectorId;
             $ticket->agentId=$this->getAdmin();
             $ticket->save();
             Mail::to($ticket->agent)->queue(new InquiryOpened($ticket));

         }
          return redirect()->route('ticket.index');
         //return response()->json(['data'=>'Ticket Created Successfully']);


     }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
         //$comments = Comment::where(['userId'=>Auth::id()])->where(['ticketId'=>$ticket->id])->get();

        return view('admin.tickets.view')->withTicket($ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }


    public function closeTicket($ticketId)
    {
      $ticket= Ticket::where(['id'=>$ticketId])->first();

        $agent = User::where(['id'=>$ticket->userId])->first();
        $ticket->update(['statusId'=>2]);
        //$url = route('ticket.show',$ticket->id);
        Mail::to($ticket->agent)->queue(new InquiryClosed($ticket));
         return redirect()->route('ticket.show',$ticketId);
    }
     public function reOpenTicket($ticketId)
     {
         $ticket = Ticket::where(['id' => $ticketId])->first();

         $agent = User::where(['id' => $ticket->userId])->first();
         $ticket->update(['statusId' => 3]);

         //$url = route('ticket.show',$ticket->id);
         Mail::to($ticket->agent)->queue(new InquiryReopened($ticket));

         return redirect()->route('ticket.show', $ticketId);

     }
    public function assignTicketForm(Ticket $ticket)
    {


        $ticket = Ticket::where(['id'=>$ticket->id])->first();
        $users =  User::has('roles')->where(['isAuthorised'=>1])->get();
        $serviceLevelAgreement = ServiceLevelAgreement::get();
        return view('admin.tickets.assign')->withTicket($ticket)->withUsers($users)->withServiceLevelAgreement($serviceLevelAgreement);

        //$ticket->update(['agent_id'=>]);

    }

    public function assignTicket(Request $request)
    {

        $agent = User::find($request->user_id);
        $ticket = Ticket::where(['id'=>$request->ticket_id])->first();
        if(!RoleUser::where(['userId'=>$request->user_id])->exists())
        {
            Alert::error('Error','Please Assign a role to '.$agent->name);
            return redirect()->route('ticket.assign',$ticket->id);
        }
        if($ticket->statusId == 2)
        {
            Alert::error('Error','Ticket Already Closed');
            return redirect()->route('ticket.index');
        }
        elseif ($ticket->agentId==$request->user_id)
        {
            Alert::error('Error','Inquiry Already Assigned to '.$agent->name);
            return redirect()->route('ticket.assign',$ticket->id);
        }

        $ticket->update(['agentId'=>$request->user_id,'slaId'=>$request->sla_id]);
        Mail::to($agent)->queue(new InquiryAssigned($ticket));
        Alert::success('Success','Inquiry successfully assigned to '.$agent->name);
        return redirect()->route('ticket.assign',$ticket->id);
    }

    private function getAdmin()
    {
        $adminRoles = RoleUser::where(['roleId'=>1])->pluck('userId');
        $admins = User::whereIn('id',$adminRoles)->withCount('tickets')->orderBy('tickets_count','ASC')->first();

        return $admins->id;
    }

}
