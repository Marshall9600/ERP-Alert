@extends('auth.master')  
  
@section('master.content')

<form method="POST" action="{{ route('auth.portal.two.factor.submit') }}">
    @csrf
    <input type="hidden" name="client_id" value="{{ encrypt($UserFound->_id) }}" />

    <div class="uk-margin-medium uk-text-center">
        <ul class="uk-breadcrumb">
            <li><span><i class="fa-solid fa-circle-1 fa-nm"></i>Account activation</span></li>
            <li><span class="uk-text-success"><i class="fa-solid fa-circle-2 fa-nm"></i> 2FA activation</span></li>
        </ul>
    </div>
    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">2FA activation</h3>
    </div>
    <div class="uk-margin-small">
        <span class="uk-text-small">When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.</span>
    </div>
    <div class="uk-margin-small">
        <span class="uk-text-small">To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.</span>
    </div>

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                
        <div class="uk-margin uk-text-center">
            {!! $UserFound->twoFactorQrCodeSvg() !!}
        </div>

        @if (\Session::has('auth-2fa-failed'))
            <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
                <span class="uk-text-danger">{!! \Session::get('auth-2fa-failed') !!}</span>
            </div>
        @endif

        @if (!empty($incorrect2FA))
            <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
                <span class="uk-text-danger">Your 2FA credential was incorrect, please try again.</span>
            </div>
        @endif

        @if (\Session::has('auth-2fa-empty'))
            <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
                <span class="uk-text-danger">{!! \Session::get('auth-2fa-empty') !!}</span>
            </div>
        @endif

        <div class="uk-margin">
            <input id="code" class="uk-input" type="text" name="code" inputmode="numeric" placeholder="6-digit-code" autofocus autocomplete="one-time-code"
                wire:model.defer="code"
                wire:keydown.enter="confirmTwoFactorAuthentication" required />
            <x-jet-input-error for="code" class="mt-2" />
        </div>
        <div class="uk-margin">
            <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Submit</button>
        </div>
        <div class="uk-margin uk-text-center">
            <a href="{{ route('auth.login') }}"><span class="uk-text-muted">Back to login</span></a>
        </div>

    @endif

</form>

@endsection