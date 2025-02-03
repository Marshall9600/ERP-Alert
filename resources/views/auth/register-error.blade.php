@extends('auth.master')  
  
@section('master.content')

<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            
            <div class="login_heading">
                <h2><i class="material-icons md-48">&#xe002;</i></h2>
                <h2 class="uk-text-bold">Error</h2>
                <span class="uk-text-small">Please go back to login page.</span>
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