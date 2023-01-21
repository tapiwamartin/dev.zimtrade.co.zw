<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $comment;
    public $ticket;

    public function __construct($comment,$ticket)
    {
        $this->comment= $comment;
        $this->ticket= $ticket;
        // $this->url= $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('zimhelpdesk@zimtrade.co.zw')
            ->markdown('emails.deposits.comment', [
                'ticket'=>$this->comment,
                'comment'=>$this->ticket

            ]);
    }
}
