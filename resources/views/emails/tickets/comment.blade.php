@component('mail::message')
# Hi {{$ticket->ticketOwner->name}}
Inquiry #{{$ticket->id}} has been responded to. Kindly Click the link below to view more.<br/>
<b>OverView:</b> {{$ticket->subject}}<br>
<b>Comment</b><br>
{{$comment->comment}}

@component('mail::button', ['url' =>route('ticket.show',$ticket->id)])
View Inquiry
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
