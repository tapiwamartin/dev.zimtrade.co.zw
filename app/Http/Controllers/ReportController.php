<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use App\Models\Sector;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class ReportController extends Controller
{

    public function  __construct()
    {
        $this->middleware(['auth','verified','admin']);
    }
    public function daily()
    {
        $report = array();
        $daily = Carbon::now();
        $reportType ="Inquiries Report as at".' '.CarbonImmutable::now()->calendar();
        $sectors= Sector::get();
        $status = Status::get();

        for($i=0; $i<sizeof($sectors);$i++)
        {

            $countClosed = Ticket::where(['statusId' => 2, 'sectorId' => $sectors[$i]->id])->whereDate('created_at', Carbon::parse($daily)->toDateString())->count();
            $countOpened = Ticket::where(['statusId' => 1, 'sectorId' => $sectors[$i]->id])->whereDate('created_at', Carbon::parse($daily)->toDateString())->count();
            $countReOpened = Ticket::where(['statusId' => 3, 'sectorId' => $sectors[$i]->id])->whereDate('created_at', Carbon::parse($daily)->toDateString())->count();
            $countOverdue = Ticket::where(['statusId' => 4, 'sectorId' => $sectors[$i]->id])->whereDate('created_at', Carbon::parse($daily)->toDateString())->count();
            $report[] = array(["sector" => $sectors[$i]->name, "closed" => $countClosed, "opened" => $countOpened, "reopened" => $countReOpened,"overdue"=>$countOverdue]);

        }

        $data = collect($report);
        $e = $data->flatten(1);

        return view('admin.reports.index')->with('e',$e)->withReportType($reportType);




    }

    public function weekly()
    {
        $daily = Carbon::now()->addDay();
        $weekDate = Carbon::now()->subDays(8);
        $reportType ="Inquiries Report as from".' '.Carbon::parse($weekDate)->toDateString().' '.'to'.' '.Carbon::parse($daily)->toDateString();
        $sector = Sector::get();
        $report = array();
        $range = collect(CarbonPeriod::create($weekDate,$daily));


        for($i=0; $i<sizeof($sector);$i++) {
            $countClosed = Ticket::where(['statusId'=>2 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($weekDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();

            $countOpened = Ticket::where(['statusId'=>1 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($weekDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();
            $countReOpened = Ticket::where(['statusId'=>3 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($weekDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();
            $countOverdue = Ticket::where(['statusId'=>4 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($weekDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();
            $report[]= array(["sector"=>$sector[$i]->name,"closed"=>$countClosed,"opened"=>$countOpened,"reopened"=>$countReOpened,"overdue"=>$countOverdue]);
        }
        $data = collect($report);
        $e = $data->flatten(1);

        return view('admin.reports.index')->with('e',$e)->withReportType($reportType);


    }
    public function monthly()
    {
        $daily = Carbon::now();
        $monthDate = Carbon::now()->subMonth()->subDay();
        $reportType ="Inquiries Report as from".' '.Carbon::parse($monthDate)->toDateString().' '.'to'.' '.Carbon::parse($daily)->toDateString();
        $range = collect(CarbonPeriod::create($monthDate,$daily));

        $sector = Sector::get();
        $report= array();
        $range = collect(CarbonPeriod::create($monthDate,$daily));


        for($i=0; $i<sizeof($sector);$i++) {


            $countClosed = Ticket::where(['statusId'=>2 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($monthDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();

            $countOpened = Ticket::where(['statusId'=>1 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($monthDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();
            $countReOpened = Ticket::where(['statusId'=>3 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($monthDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();
            $countOverdue = Ticket::where(['statusId'=>4 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($monthDate)->toDateString(),Carbon::parse($daily)->toDateString()])->count();

            $report[]= array(["sector"=>$sector[$i]->name,"closed"=>$countClosed,"opened"=>$countOpened,"reopened"=>$countReOpened,"overdue"=>$countOverdue]);

        }

        //return $report;
        $data = collect($report);
        $e = $data->flatten(1);
        // return Carbon::now();
        return view('admin.reports.index')->with('e',$e)->withReportType($reportType);

    }

    public function  range()
    {
      return view('admin.reports.range');
    }

    public function rangeReport(Request $request)
    {

        $startDate= $request->startDate;
        $endDate = $request->endDate;

        $reportType ="Inquiries Report as from".' '.Carbon::parse($startDate)->toDateString().' '.'to'.' '.Carbon::parse($endDate)->toDateString();
        //$range = collect(CarbonPeriod::create($request->startDate,$request->endDate));

        $sector = Sector::get();
        $report= array();



        for($i=0; $i<sizeof($sector);$i++) {


            $countClosed = Ticket::where(['statusId'=>2 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($startDate)->toDateString(),Carbon::parse($endDate)->toDateString()])->count();

            $countOpened = Ticket::where(['statusId'=>1 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($startDate)->toDateString(),Carbon::parse($endDate)->toDateString()])->count();
            $countReOpened = Ticket::where(['statusId'=>3 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($startDate)->toDateString(),Carbon::parse($endDate)->toDateString()])->count();
            $countOverdue = Ticket::where(['statusId'=>4 ,'sectorId' => $sector[$i]->id])->whereBetween('created_at',[Carbon::parse($startDate)->toDateString(),Carbon::parse($endDate)->toDateString()])->count();

            $report[]= array(["sector"=>$sector[$i]->name,"closed"=>$countClosed,"opened"=>$countOpened,"reopened"=>$countReOpened,"overdue"=>$countOverdue]);

        }

        //return $report;
        $data = collect($report);
        $e = $data->flatten(1);
        // return Carbon::now();
        return view('admin.reports.index')->with('e',$e)->withReportType($reportType);

    }

    /*Emailed Reports*/

    public function dailyReport()
    {

        $agents = User::has('roles')->get();
        return view('admin.reports.report')->withAgents($agents);
    }



}
