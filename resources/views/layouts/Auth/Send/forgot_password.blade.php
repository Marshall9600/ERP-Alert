<x-mail::message>
    <h1>Forgot Your Password? Let's Reset It</h1>
    <p>
        Dear {{ $details['clientName'] }},
        <br>
        <br>
        We have send you a link for resetting your password, please use the link below to proceed.
        <br>
        <br>
        <br>
        <a class="button-blue" href="{{ $details['domain'] }}/auth/reset_password/{{ $details['token'] }}/{{ $details['time'] }}/{{ $details['clientID'] }}" target="_blank">
            Click here to reset your password.
        </a>
        <br>
        <br>
        <br>
        Your may request this forgot password from {{ env('ADMIN_URL') }} if your reset password failed.
        <br>
        <br>
        If you have any question regarding this matter, please do let us know by calling {{ env('HELP_PHONE') }} or email us at {{ env('HELP_EMAIL') }}.
    </p>
    <h4>&#91;THIS IS AN AUTORESPONSE, PLEASE DO NOT REPLY TO THIS EMAIL&#93;</h4>
</x-mail::message>