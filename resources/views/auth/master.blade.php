<!DOCTYPE html>

{{-- <html lang="en" style="background-color: #2f4052;"> --}}
<html lang="en">

    <head>

        <meta name="csrf-token" charset="utf-8" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Auth</title>

        <!-- CSS -->
            <!-- Default -->
            <link rel="stylesheet" href="{{ asset('/css/uikit.css') }}">
            <!-- Fontawesome -->
            <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome/css/all.css') }}">

        <!-- Custom CSS -->
            <!-- My CSS -->
            <link rel="stylesheet" href="{{ asset('/css/font.css') }}">
            <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
            <!-- Select2 -->
            <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">

        <!-- JS -->
            <!-- Default -->
            <script src="{{ asset('/js/uikit.js') }}"></script>
            <script src="{{ asset('/js/uikit-icons.js') }}"></script>
            <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript"></script>

    </head>
  
    <body>

        <!-- CONTENT START -->
            <div class="uk-width-expand uk-flex uk-flex-middle uk-flex-center custom-background-login" uk-height-viewport>
                <div class="uk-card uk-card-body uk-card-default uk-width-1-4">
                    @yield('master.content')
                </div>
            </div>
        <!-- CONTENT END -->

    </body>

</html>