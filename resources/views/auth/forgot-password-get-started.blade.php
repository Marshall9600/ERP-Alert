@extends('auth.master')  
  
@section('master.content')

<form method="GET" action="{{ route('auth.portal.reset.password.reset', $clientID) }}">
    @csrf
    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Begin Reset Password</h3>
    </div>
    <div class="uk-margin uk-text-center">
        <span>Click start to reset your password.</span>
    </div>
    <div class="uk-margin uk-text-center">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Start</button>
    </div>
</form>

@endsection