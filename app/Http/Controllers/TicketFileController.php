<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketFile  $ticketFile
     * @return \Illuminate\Http\Response
     */
    public function show(TicketFile $ticketFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketFile  $ticketFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketFile $ticketFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketFile  $ticketFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketFile $ticketFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketFile  $ticketFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketFile $ticketFile)
    {
        //
    }


    public  function download($ticketFile)
    {
        $path = TicketFile::find($ticketFile);


        return Storage::download($path->path);

    }
}
