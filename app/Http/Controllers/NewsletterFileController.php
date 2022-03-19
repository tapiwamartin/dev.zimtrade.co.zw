<?php

namespace App\Http\Controllers;

use App\Mail\InquiryOpened;
use App\Models\Newsletter;
use App\Models\newsletterFile;
use App\Models\TicketFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class NewsletterFileController extends Controller
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
        if($request->hasFile('fileUpload'))
        {

            $newsletter = new Newsletter;
            $newsletter->subject = $request->subject;
            $newsletter->description = $request->description;


            $newsletter->save();


            $path = $request->file('fileUpload')->store('newsletterFiles'.'/'.$newsletter->id);
            $newsletter->ticketFile()->save(new newsletterFile(['ticketId'=>$newsletter->id,'path'=>$path]));
            $agent = User::where(['id'=>1])->first();
            //Mail::to($agent)->send(new InquiryOpened($newsletter));
        }
        else
        {
            $newsletter = new Newsletter;
            $newsletter->subject = $request->subject;
            $newsletter->description = $request->description;
            $newsletter->save();
            $agent = User::where(['id'=>1])->first();

            //Mail::to($agent)->send(new InquiryOpened($ticket));
        }
        return redirect()->route('ticket.index');
        //return response()->json(['data'=>'Ticket Created Successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\newsletterFile  $newsletterFile
     * @return \Illuminate\Http\Response
     */
    public function show(newsletterFile $newsletterFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\newsletterFile  $newsletterFile
     * @return \Illuminate\Http\Response
     */
    public function edit(newsletterFile $newsletterFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\newsletterFile  $newsletterFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, newsletterFile $newsletterFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\newsletterFile  $newsletterFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(newsletterFile $newsletterFile)
    {
        //
    }
    public  function download($newsletterFile)
    {
        $path = newsletterFile::find($newsletterFile);


        return Storage::download($path->path);

    }
}
