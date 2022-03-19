@component('mail::message')
# Hi {{$ticket->agent->name}}
Inquiry #{{$ticket->id}} has been assigned to you. Log in to view.

@component('mail::button', ['url' =>route('ticket.show',$ticket->id)])
View Inquiry
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
