@extends('auth.master')  
  
@section('master.content')

<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            
            <div class="login_heading">
                <h2 class="uk-text-bold">2FA Inactive</h2>
                <span class="uk-text-small">Your 2FA was interrupted, you will be redirected to 2FA activation.</span>
            </div>

            <div class="uk-margin-top uk-text-center uk-text-muted uk-text-small">
                <a  href="{{ route('auth.login') }}">
                    <span class="uk-text-muted">Back to login</span>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection