@component('mail::message')

Hello {{ $userdata['firstname']}} {{ $userdata['lastname']}},<br>
{{$authuser['firstname']}} {{$authuser['lastname']}} has added your account you can login and change your password</br>
Your current password is {{$randompassword}}

@component('mail::button',['url'=> route('login')])
    Click Here To Login and Change Your Password
@endcomponent
<p>Or Copy and Paste the following link to your browser</p>
<p><a href="{{route('login')}}">{{route('login')}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

