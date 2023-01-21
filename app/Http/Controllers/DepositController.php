<?php

namespace App\Http\Controllers;

use App\Mail\InquiryAssigned;
use App\Models\Currency;
use App\Models\Narration;
use App\Models\Region;
use App\Models\ServiceLevelAgreement;
use App\Models\Deposit;
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

class DepositController extends Controller
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
             $deposits = Deposit::where(['userId'=>Auth::id()])->orWhere(['agentId'=>Auth::id()])->orderBy('id','DESC')->get();

        return view('admin.deposits.index')->withDeposits($deposits);
        }
        else
        {

             $deposits = Deposit::orderBy('id','DESC')->get();

              return view('admin.deposits.index')->withDeposits($deposits);

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
        $regions = Region::get();
        $narrations = Narration::get();
        $currencies = Currency::get();

        return view('admin.deposits.create')->withRegions($regions)
            ->withNarrations($narrations)
            ->withCurrencies($currencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
             $deposit = new Deposit;
             $deposit->amount = $request->amount;
             $deposit->regionId = $request->regionId;
             $deposit->userId = Auth::id();
             $deposit->narrationId =1;
             $deposit->currencyId = $request->currencyId;
             $deposit->transactionDate=$request->transactionDate;
             $deposit->save();

          return redirect()->route('deposit.index');



     }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
         //$comments = Comment::where(['userId'=>Auth::id()])->where(['ticketId'=>$ticket->id])->get();

        return view('admin.deposits.view')->withDeposit($deposit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $ticket)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $ticket)
    {
        //
    }


    public function closeTicket($ticketId)
    {
      $ticket= Deposit::where(['id'=>$ticketId])->first();

        $agent = User::where(['id'=>$ticket->userId])->first();
        $ticket->update(['statusId'=>2]);
        //$url = route('ticket.show',$ticket->id);
        Mail::to($ticket->agent)->queue(new InquiryClosed($ticket));
         return redirect()->route('ticket.show',$ticketId);
    }
     public function reOpenTicket($ticketId)
     {
         $ticket = Deposit::where(['id' => $ticketId])->first();

         $agent = User::where(['id' => $ticket->userId])->first();
         $ticket->update(['statusId' => 3]);

         //$url = route('ticket.show',$ticket->id);
         Mail::to($ticket->agent)->queue(new InquiryReopened($ticket));

         return redirect()->route('ticket.show', $ticketId);

     }
    public function assignTicketForm(Deposit $ticket)
    {


        $ticket = Deposit::where(['id'=>$ticket->id])->first();
        $users =  User::has('roles')->where(['isAuthorised'=>1])->get();
        $serviceLevelAgreement = ServiceLevelAgreement::get();
        return view('admin.deposits.assign')->withTicket($ticket)->withUsers($users)->withServiceLevelAgreement($serviceLevelAgreement);

        //$ticket->update(['agent_id'=>]);

    }

    public function assignTicket(Request $request)
    {

        $agent = User::find($request->user_id);
        $ticket = Deposit::where(['id'=>$request->ticket_id])->first();
        if(!RoleUser::where(['userId'=>$request->user_id])->exists())
        {
            Alert::error('Error','Please Assign a role to '.$agent->name);
            return redirect()->route('ticket.assign',$ticket->id);
        }
        if($ticket->statusId == 2)
        {
            Alert::error('Error','Deposit Already Closed');
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
        $admins = User::whereIn('id',$adminRoles)->withCount('deposits')->orderBy('tickets_count','ASC')->first();

        return $admins->id;
    }

}
