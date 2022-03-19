<?php
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

function getOpenTickets($id)
{
	$tickets = Ticket::where(['userId'=>$id])->where(['statusId'=>1])->count();

     return $tickets;
}

function getClosedTickets($id)
{
	$tickets = Ticket::where(['userId'=>$id])->where(['statusId'=>2])->count();

     return $tickets;
}
function getReopenedTickets($id)
{
    $tickets = Ticket::where(['userId'=>$id])->where(['statusId'=>3])->count();

    return $tickets;
}

function getOverDueTickets($id)
{
    $tickets = Ticket::where(['userId'=>$id])->where(['statusId'=>4])->count();

    return $tickets;
}

function getAssignedTicketsClosed($id)
{
    $tickets = Ticket::where(['agentId'=>$id])->where(['statusId'=>2])->count();

    return $tickets;
}
function getAssignedTicketsOpened($id)
{
    $tickets = Ticket::where(['agentId'=>$id])->where(['statusId'=>1])->count();

    return $tickets;
}
function getAssignedTicketsReopened($id)
{
    $tickets = Ticket::where(['agentId'=>$id])->where(['statusId'=>3])->count();

    return $tickets;
}

function getAssignedTicketsOverdue($id)
{
    $tickets = Ticket::where(['agentId'=>$id])->where(['statusId'=>4])->count();

    return $tickets;
}
/*overal tickets opened in the system*/
function openTickets()
{
	$tickets = Ticket::where(['statusId'=>1])->count();

	return $tickets;
}

function closedTickets()
{
	$tickets = Ticket::where(['statusId'=>2])->count();

	return $tickets;
}



function getTotalUsersAuthorised()
{
	return User::where(['isAuthorised'=>1])->count();
}

function getOpenTicketsMonthly()
{
	  $total = array();
	  $intended = Ticket::select(DB::raw('count(*) as tickets'))
                                                  ->where(['statusId'=>1])
                                                  ->groupBy('created_at')
                                                  ->orderBy('tickets','asc')
                                                  ->get();

      foreach ($intended as $key => $value) {
      	  $total[]=$value['tickets'];
      }

      return $total;


}

function  getMonth()
{
	 $month = array();
	  $intended = Ticket::select(DB::raw('count(*) as tickets,created_at'))
                                                  ->where(['statusId'=>1])
                                                  ->groupBy('created_at')
                                                  ->orderBy('tickets','asc')
                                                  ->get();

      foreach ($intended as $key => $value) {
      	  $month[]=Carbon::parse($value['created_at'])->day;
      }

      return $month;
}

function getClosed()
{

 return  Ticket::where(['statusId'=>2])->count();
}


function getOpened()
{
   return  Ticket::where(['statusId'=>1])->count();
}



function getReopened()
{

  return Ticket::where(['statusId'=>3])->count();

}

function getOverdue()
{

    return Ticket::where(['statusId'=>4])->count();

}

function greeting()
{

}

function getTotalUsersUnAuthorised()
{
    return User::where(['isAuthorised'=>0])->count();
}









 ?>
