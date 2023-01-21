<?php
use App\Models\Deposit;
use App\Models\User;
use Carbon\Carbon;

function getOpenTickets($id)
{
	$tickets = Deposit::where(['userId'=>$id])->where(['statusId'=>1])->count();

     return $tickets;
}

function getClosedTickets($id)
{
	$tickets = Deposit::where(['userId'=>$id])->where(['statusId'=>2])->count();

     return $tickets;
}
function getReopenedTickets($id)
{
    $tickets = Deposit::where(['userId'=>$id])->where(['statusId'=>3])->count();

    return $tickets;
}

function getOverDueTickets($id)
{
    $tickets = Deposit::where(['userId'=>$id])->where(['statusId'=>4])->count();

    return $tickets;
}

function getAssignedTicketsClosed($id)
{
    $tickets = Deposit::where(['agentId'=>$id])->where(['statusId'=>2])->count();

    return $tickets;
}
function getAssignedTicketsOpened($id)
{
    $tickets = Deposit::where(['agentId'=>$id])->where(['statusId'=>1])->count();

    return $tickets;
}
function getAssignedTicketsReopened($id)
{
    $tickets = Deposit::where(['agentId'=>$id])->where(['statusId'=>3])->count();

    return $tickets;
}

function getAssignedTicketsOverdue($id)
{
    $tickets = Deposit::where(['agentId'=>$id])->where(['statusId'=>4])->count();

    return $tickets;
}
/*overal deposits opened in the system*/
function openTickets()
{
	$tickets = Deposit::where(['statusId'=>1])->count();

	return $tickets;
}

function closedTickets()
{
	$tickets = Deposit::where(['statusId'=>2])->count();

	return $tickets;
}



function getTotalUsersAuthorised()
{
	return User::where(['isAuthorised'=>1])->count();
}

function getOpenTicketsMonthly()
{
	  $total = array();
	  $intended = Deposit::select(DB::raw('count(*) as deposits'))
                                                  ->where(['statusId'=>1])
                                                  ->groupBy('created_at')
                                                  ->orderBy('deposits','asc')
                                                  ->get();

      foreach ($intended as $key => $value) {
      	  $total[]=$value['deposits'];
      }

      return $total;


}

function  getMonth()
{
	 $month = array();
	  $intended = Deposit::select(DB::raw('count(*) as deposits,created_at'))
                                                  ->where(['statusId'=>1])
                                                  ->groupBy('created_at')
                                                  ->orderBy('deposits','asc')
                                                  ->get();

      foreach ($intended as $key => $value) {
      	  $month[]=Carbon::parse($value['created_at'])->day;
      }

      return $month;
}

function getClosed()
{

 return  Deposit::where(['statusId'=>2])->count();
}


function getOpened()
{
   return  Deposit::where(['statusId'=>1])->count();
}



function getReopened()
{

  return Deposit::where(['statusId'=>3])->count();

}

function getOverdue()
{

    return Deposit::where(['statusId'=>4])->count();

}

function greeting()
{

}

function getTotalUsersUnAuthorised()
{
    return User::where(['isAuthorised'=>0])->count();
}









 ?>
