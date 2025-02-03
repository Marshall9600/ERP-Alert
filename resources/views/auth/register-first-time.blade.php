@extends('auth.master')  
  
@section('master.content')

<form method="GET" action="{{ route('auth.portal.first.time.submit') }}">
    @csrf
    <input type="hidden" name="clientID" value="{{ $clientID }}" />
    <div class="uk-margin-medium uk-text-center">
        <ul class="uk-breadcrumb">
            <li><span class="uk-text-success"><i class="fa-solid fa-circle-1 fa-nm"></i>Account activation</span></li>
            <li><span><i class="fa-solid fa-circle-2 fa-nm"></i> 2FA activation</span></li>
        </ul>
    </div>
    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Account activation</h3>
    </div>
    <div class="uk-margin">
        <span>To proceed with your account activation, place your password and press submit.</span>
    </div>
    <div>
        <span class="uk-text-small">must be at least 10 characters in length.</span>
    </div>
    <div>
        <span class="uk-text-small">must contain at least one lowercase letter.</span>
    </div>
    <div>
        <span class="uk-text-small">must contain at least one uppercase letter.</span>
    </div>
    <div>
        <span class="uk-text-small">must contain at least one digit.</span>
    </div>
    <div>
        <span class="uk-text-small">must contain a special character.</span>
    </div>

    @if (\Session::has('auth-password-failed'))
        <div class="uk-margin uk-animation-slide-bottom-small">
            @foreach(\Session::get('auth-password-failed') as $Invalid)
                <div class="uk-text-small uk-text-danger">
                    {{ $Invalid }}
                </div>
                <br>
            @endforeach
        </div>
    @endif

    <div class="uk-margin">
        <input id="password" class="uk-input" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
    </div>
    <div class="uk-margin">
        <input id="password_confirmation" class="uk-input" type="password" name="password_confirmation" placeholder="Confirm-password" required autocomplete="new-password" />
    </div>
    <div class="uk-margin uk-text-center">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Submit</button>
    </div>
    <div class="uk-margin uk-text-center">
        <a href="{{ route('auth.login') }}"><span class="uk-text-muted">Back to login</span></a>
    </div>
</form>

@endsection