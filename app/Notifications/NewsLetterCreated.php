<?php

namespace App\Notifications;

use App\Models\newsletterFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class NewsLetterCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $newsletter;
    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

  /*  public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content('News!');
    }*/

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if(newsletterFile::where(['newsletterId'=>$this->newsletter->id])->exists())
        {
            return (new MailMessage)
                ->line('NewsLetter:'.$this->newsletter->subject)
                ->attach(public_path($this->newsletter->newsletterfile->path))
                ->line('Thank you for using our application!');
        }
        return (new MailMessage)
                    ->line('NewsLetter:'.$this->newsletter->subject)
                    ->line('Body: '.$this->newsletter->description)
                    ->line('Thank you for using our application!');
    }


}
