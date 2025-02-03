@extends('auth.master')  
  
@section('master.content')

<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<form method="POST" action="{{ route('auth.login.two.factor.submit') }}">
    @csrf

    <input type="hidden" name="client_id" value="{{ encrypt($UserFound->_id) }}" />
    <input type="hidden" name="remember" value="{{ $remember }}" />

    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Enter your 2FA</h3>
    </div>
    <div class="uk-margin">
        <span>Please open your authenticator and key-in the 6-digit code to proceed.</span>
    </div>

    @if (!empty($incorrect2FA))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">Your 2FA credential was incorrect, please try again.</span>
        </div>
    @endif

    @if (\Session::has('auth-2fa-invalid'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">{!! \Session::get('auth-2fa-invalid') !!}</span>
        </div>
    @endif

    @if (\Session::has('auth-2fa-empty'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">{!! \Session::get('auth-2fa-empty') !!}</span>
        </div>
    @endif

    <div class="uk-margin">
        <input id="code" class="uk-input" type="text" name="code" inputmode="numeric" placeholder="6-digit-code" autofocus x-ref="code" autocomplete="one-time-code" required />
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Submit</button>
    </div>
    <div class="uk-margin uk-text-center">
        <a href="{{ route('auth.login') }}">
            <span class="uk-text-muted">Back to login</span>
        </a>
    </div>
</form>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

@endsection