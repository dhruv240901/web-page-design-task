@component('mail::message')

Hello {{ $userdata->firstname}} {{ $userdata->lastname}},<br>
{{auth()->user()->firstname}}  {{auth()->user()->lastname}} has added your account you can login and reset your password</br>
Your current password is {{$randompassword}}

@component('mail::button',['url'=> route('reset-password')])
    Click Here To Login and Reset Your Password
@endcomponent
<p>Or Copy and Paste the following link to your browser</p>
<p><a href="{{route('reset-password')}}">{{route('reset-password')}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
