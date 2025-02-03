@extends('auth.master')  
  
@section('master.content')

<form method="POST" action="{{ route('auth.portal.reset.password.send') }}">
    @csrf
    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Forgot password?</h3>
    </div>
    <div class="uk-margin">
        <span>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</span>
    </div>

    @if (\Session::has('auth-forgot-password-failed'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">{!! \Session::get('auth-forgot-password-failed') !!}</span>
        </div>
    @endif

    @if (\Session::has('auth-forgot-password-inactive'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">{!! \Session::get('auth-forgot-password-inactive') !!}</span>
        </div>
    @endif

    <div class="uk-margin">
        <input id="email" class="uk-input" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Sign in</button>
    </div>
    <div class="uk-margin uk-text-center">
        <a href="{{ route('auth.login') }}"><span class="uk-text-muted">Back to login</span></a>
    </div>
</form>

@endsection