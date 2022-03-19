<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Alert;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()

    {
        $this->middleware(['auth', 'admin', 'verified']);
    }
    public function index()
    {
        $sectors = Sector::get();
        return view('admin.sectors.index')->withSectors($sectors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.sectors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sector = new Sector;
        $sector->name=$request->name;
        $sector->save();
        Alert::success('Success', 'Sector added successfully');
        return redirect()->route('sector.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        $sector = Sector::find($sector->id);
        return view('admin.sectors.update')->withSector($sector);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        $sector = Sector::find($sector);
        $sector->name=$request->name;
        $sector->save();
        return redirect()->route('sector.index')->with(['success'=>'Sector successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        $sector = Sector::find($sector->id);
        $sector->delete();
        return redirect()->route('sector.index')->with(['success'=>'Sector successfully deleted']);


    }
}
