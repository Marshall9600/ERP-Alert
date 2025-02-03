@extends('auth.master')  
  
@section('master.content')

<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<form method="POST" action="{{ route('auth.user.login') }}">
    @csrf
    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Log in</h3>
    </div>

    @if (\Session::has('auth-forgot-password-send'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-success">{!! \Session::get('auth-forgot-password-send') !!}</span>
        </div>
    @endif

    @if (\Session::has('auth-login-incorrect'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">{!! \Session::get('auth-login-incorrect') !!}</span>
        </div>
    @endif

    @if (\Session::has('auth-login-inactive'))
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">{!! \Session::get('auth-login-inactive') !!}</span>
        </div>
    @endif

    <div class="uk-margin">
        <input id="email" class="uk-input" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
    </div>
    <div class="uk-margin">
        <input id="password" class="uk-input" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
    </div>
    <div class="uk-margin">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
                <input id="remember_me" class="uk-checkbox" type="checkbox" name="remember" value="1">
            </div>
            <div class="uk-width-expand">
                <span>Remember Me</span>
            </div>
        </div>
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Sign in</button>
    </div>
</form>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

@endsection