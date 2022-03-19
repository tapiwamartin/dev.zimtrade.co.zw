@component('mail::message')
<b>Attention :</b> {{$ticket->agent->name}}
Inquiry #{{$ticket->id}} which has been assigned to you is now due. <br>
Kindly attend to the issue or perhaps close it  was completed.

@component('mail::button', ['url' =>route('ticket.show',$ticket->id)])
View Inquiry
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
