<?php

namespace App\Http\Controllers;

use App\Mail\CommentCreated;
use App\Mail\InquiryClosed;
use App\Models\Comment;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware(['auth','verified','isAuthorised']);
    }



    public function getComments($ticketId)
    {
        $comment = Comment::with('user')->where(['ticketId'=>$ticketId])->orderBy('id','DESC')->paginate(5);
        return response()->json(['comments'=>$comment]);
    }
    public function index()
    {
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
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->userId = Auth::id();
        $comment->ticketId = $request->ticket;
        $comment->save();
        $ticket = Deposit::find($request->ticket);
      if(Auth::id() == $request->userId)
        {
            Mail::to($ticket->ticketOwner)->queue(new CommentCreated($comment,$ticket));
        }
        else
        {
            Mail::to($ticket->agent)->queue(new CommentCreated($comment,$ticket));
        }

        return response()->json(['data'=>'Comment Added Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
