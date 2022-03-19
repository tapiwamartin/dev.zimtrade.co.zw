<?php

namespace App\Http\Controllers;

use App\Models\ServiceLevelAgreement;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ServiceLevelAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceLevelAgreement = ServiceLevelAgreement::get();
        return view('admin.sla.index')->withServiceLevelAgreement($serviceLevelAgreement);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sla.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'hours' => 'required|integer|gt:0',

        ]);
        $serviceLevelAgreement = new ServiceLevelAgreement();
        $serviceLevelAgreement->name= $request->name;
        $serviceLevelAgreement->hours= $request->hours;
        $serviceLevelAgreement->save();
        return redirect()->route('sla.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceLevelAgreement  $serviceLevelAgreement
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceLevelAgreement $serviceLevelAgreement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceLevelAgreement  $serviceLevelAgreement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $serviceLevelAgreement= ServiceLevelAgreement::find($id);
        return view('admin.sla.update')->withServiceLevelAgreement($serviceLevelAgreement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceLevelAgreement  $serviceLevelAgreement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $serviceLevelAgreement =ServiceLevelAgreement::find($id);
        $serviceLevelAgreement->name= $request->name;
        $serviceLevelAgreement->hours= $request->hours;
        $serviceLevelAgreement->save();
        return redirect()->route('sla.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceLevelAgreement  $serviceLevelAgreement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $serviceLevelAgreement =ServiceLevelAgreement::find($id);
        $serviceLevelAgreement->delete();
        return redirect()->route('sla.index');
    }
}
