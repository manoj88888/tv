@component('mail::message')
# Hi !
{{ $msg }}.
@component('mail::button', ['url' => $url])
Renew
@endcomponent
<code> If you've already renewed your plan, Thank You! You may disregard this email </code>
Thanks,<br>
{{ config('app.name') }}
@endcomponent