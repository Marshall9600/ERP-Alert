@extends('auth.master')  
  
@section('master.content')

<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<form method="POST" action="{{ route('two-factor.login') }}">
    @csrf
    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Enter your 2FA</h3>
    </div>
    <div class="uk-margin">
        <span>Please open your authenticator and key-in the 6-digit code to proceed.</span>
    </div>
    <div class="uk-margin">
        <input id="code" class="uk-input" type="text" name="code" inputmode="numeric" placeholder="6-digit-code" autofocus x-ref="code" autocomplete="one-time-code" />
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Sign in</button>
    </div>
    <div class="uk-margin uk-text-center">
        <a href="{{ route('auth.login') }}">
            <span class="uk-text-muted">Back to login</span>
        </a>
    </div>
</form>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

@endsection
