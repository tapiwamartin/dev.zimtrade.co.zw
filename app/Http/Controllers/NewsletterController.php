<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\newsletterFile;
use App\Models\Deposit;
use App\Models\User;
use App\Notifications\NewsLetterCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified','admin']);
    }
    public function index()
    {
        $newsletters = Newsletter::orderBy('id','desc')->get();

        return view('admin.newsletter.index')->withNewsletters($newsletters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsletter.create');
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

            $filename ="NewsLetter File";
            $path = $request->file('fileUpload')->store('newsletterFiles'.'/'.$newsletter->id);
            $newsletter->newsletterfile()->save(new newsletterFile(['newsletterId'=>$newsletter->id,'path'=>$path,'name'=>$filename]));
            $users =  User::where(['isAuthorised'=>1])->get();
            Notification::send($users,new NewsLetterCreated($newsletter));
        }
        else
        {
            $newsletter = new Newsletter;
            $newsletter->subject = $request->subject;
            $newsletter->description = $request->description;
            $newsletter->save();
            $agent = User::where(['id'=>1])->first();
            $users =  User::where(['isAuthorised'=>1])->get();
            Notification::send($users,new NewsLetterCreated($newsletter));
            //Mail::to($agent)->send(new InquiryOpened($ticket));
        }
        return redirect()->route('ticket.index');
        //return response()->json(['data'=>'Deposit Created Successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        return view('admin.newsletter.view')->withNewsletter($newsletter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
