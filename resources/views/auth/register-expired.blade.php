@extends('auth.master')  
  
@section('master.content')

<form method="POST" action="{{ route('auth.forgot.password.send.email') }}">
    @csrf

    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Activation expired</h3>
    </div>
    <div class="uk-margin">
        <span>Your account activation has expired, to proceed the activation, resend your email address.</span>
    </div>
    
    @if (\Session::has('auth-forgot-password-failed'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">{!! \Session::get('auth-forgot-password-failed') !!}</span>
        </div>
    @endif

    <div class="uk-margin">
        <input id="email" class="uk-input" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
    </div>
    <div class="uk-margin uk-text-center">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Submit</button>
    </div>
    <div class="uk-margin uk-text-center">
        <a href="{{ route('auth.login') }}"><span class="uk-text-muted">Back to login</span></a>
    </div>
</form>

@endsection