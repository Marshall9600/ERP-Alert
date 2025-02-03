@extends('auth.master')  
  
@section('master.content')

<div class="uk-margin uk-text-center">
    <h3 class="uk-text-bold">Error</h3>
</div>
<div class="uk-margin uk-text-center">
    <span>Please go back to login page.</span>
</div>
<div class="uk-margin uk-text-center">
    <a href="{{ route('auth.login') }}"><span class="uk-text-muted">Back to login</span></a>
</div>

@endsection