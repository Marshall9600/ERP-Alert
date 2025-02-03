@extends('auth.master')  
  
@section('master.content')

<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            
            <div class="login_heading">
                <h2 class="uk-text-bold">Sign up</h2>
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="uk-form-row">
                    <label for="email">Name</label>
                    <input id="name" class="md-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="uk-form-row">
                    <label for="email">Email</label>
                    <input id="email" class="md-input" type="email" name="email" :value="old('name')" :value="old('email')" required />
                </div>

                <div class="uk-form-row">
                    <label for="password">Password</label>
                    <input id="password" class="md-input" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="uk-form-row">
                    <label for="password">Confirm Password</label>
                    <input id="password_confirmation" class="md-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="uk-margin-top">
                    <button class="md-btn md-btn-primary md-btn-block" type="submit">Submit</button>
                </div>

                <div class="uk-margin-top uk-text-center uk-text-muted uk-text-small">
                    <a  href="{{ route('auth.login') }}">
                        <span class="uk-text-muted">Back to login</span>
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection