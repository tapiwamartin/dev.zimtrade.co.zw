<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryOpened extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void

     */
    public $ticket;

    public function __construct($ticket)
    {
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
                ->markdown('emails.deposits.opened', [
                    'ticket'=>$this->ticket,

                ]);
            //->line(Lang::get('If you did not create an account, no further action is required.'));
    }
}
