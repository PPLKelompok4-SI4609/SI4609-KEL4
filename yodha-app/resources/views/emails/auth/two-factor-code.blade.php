@component('mail::message')
# FloodRescue Authentication

@if(isset($user) && is_object($user))
Hello {{ $user->name }},
@else
Hello,
@endif

Your two-factor authentication code is:

@component('mail::panel')
@if(isset($user) && is_object($user))
{{ $user->two_factor_code }}
@endif
@endcomponent

This code will expire in 10 minutes.

If you didn't request this code, please ignore this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent