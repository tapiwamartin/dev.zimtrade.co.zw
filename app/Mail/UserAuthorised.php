<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAuthorised extends Mailable
{
    use Queueable, SerializesModels;

    public  $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('zimhelpdesk@zimtrade.co.zw')
            ->markdown('emails.deposits.authorised', [
                'user'=>$this->user
            ]);
    }
}
