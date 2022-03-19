@component('mail::message')
<b>Hello :</b> {{$user->name}}
Your Account has been Authorised, kindly login and get started!<br>
@component('mail::button', ['url' =>route('login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
