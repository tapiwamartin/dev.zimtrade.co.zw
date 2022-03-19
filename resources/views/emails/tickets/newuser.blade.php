@component('mail::message')
<b>Attention :</b>Administrator
A new user has created an account. Kindly Have a look an apply appropriate action.<br>
The following are the details of the user.<br>
<b>Name: </b> {{$user->name}}<br>
<b>Organisation: </b> {{$user->organisation}}<br>
<b>City: </b> {{$user->city}}<br>
<b>Country: </b> {{$user->country}}<br>

@component('mail::button', ['url' =>route('user.index',$user->id)])
View User
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
