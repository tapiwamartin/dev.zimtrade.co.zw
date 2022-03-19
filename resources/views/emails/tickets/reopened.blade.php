@component('mail::message')
# Hi {{$ticket->agent->name}}
Inquiry #{{$ticket->id}} has been reopened

@component('mail::button', ['url' =>route('ticket.show',$ticket->id)])
View Inquiry
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
