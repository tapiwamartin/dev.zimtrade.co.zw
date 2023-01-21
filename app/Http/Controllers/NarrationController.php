<?php

namespace App\Http\Controllers;

use App\Models\Narration;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NarrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware(['auth','admin','verified']);
    }

    public function index()
    {
        $narrations = Narration::get();

        return view('admin.narrations.index')->withNarrations($narrations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.narrations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $narration = new Narration;

        $narration->name = $request->name;

        $narration->save();
        Alert::success('Success','Successfully added narration');
      return redirect()->route('narration.index')->with(['success'=>"Narration Created Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Narration $narration
     * @return \Illuminate\Http\Response
     */
    public function show(Narration $narration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Narration  $narration
     * @return \Illuminate\Http\Response
     */
    public function edit(Narration $narration)
    {
        return view('admin.narrations.update')->withNarration($narration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Narration $narration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Narration $narration)
    {
        $narration = Narration::find($narration)->first();

        $narration->name = $request->name;

        $narration->save();
        Alert::success('Success','Successfully updated narration');
        return redirect()->route('narration.index')->with(['success'=>"Narration Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Narration $narration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Narration $narration)
    {
        $narration->find($narration->id);
        $narration->delete();
        Alert::success('Success','Narration Deleted');
        return redirect()->route('narration.index')->with(['success'=>"Narration Deleted Successfully"]);
    }
}
