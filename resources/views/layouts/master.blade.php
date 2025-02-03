<!DOCTYPE html>

<html>

    <head>

        <meta name="csrf-token" charset="utf-8" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Covertech Admin</title>

        <!-- CSS -->
            <!-- Default -->
            <link rel="stylesheet" href="{{ asset('/css/uikit.css') }}">
            <link rel="stylesheet" href="{{ asset('/css/jquery-ui.css') }}">
            <!-- Fontawesome -->
            <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome/css/all.css') }}">

        <!-- Custom CSS -->
            <!-- My CSS -->
            <link rel="stylesheet" href="{{ asset('/css/font.css') }}">
            <link rel="stylesheet" href="{{ asset('/css/custom.css') }}" !important>
            <!-- Select2 -->
            <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">
            <!-- DHTMLX -->
            <link rel="stylesheet" href="{{ asset('/css/dhtmlxgantt.css') }}">
            <!-- Flatpickr CSS -->
            <link rel="stylesheet" href="{{ asset('/css/flatpickr.min.css') }}">

        <!-- JS -->
            <!-- Default -->
            <script src="{{ asset('/js/uikit.js') }}"></script>
            <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('/js/jquery-ui.js') }}" type="text/javascript"></script>
            <!-- Select2 -->
            <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
            <!-- TINYMCE -->
            <script src="{{ asset('/js/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
            <!-- DHTMLX -->
            <script src="{{ asset('/js/dhtmlxgantt.js') }}" type="text/javascript"></script>
            <!-- Flatpickr CSS -->
            <script src="{{ asset('/js/flatpickr.min.js') }}" type="text/javascript"></script>
            
    </head>

    <body class="custom-background" uk-height-viewport>

        <!-- NAVBAR START-->
            <!-- PHP START -->
                @php
                    use App\Models\Coverdesk\Alert\AlertModel;
                    use App\Models\User;

                    // NAVBAR
                        $NavbarAlertModelCount = count(AlertModel::where('cvdalrt_deletion', '0')->where('cvdalrt_status', '!=', 'c')->where('cvdalrt_status', '!=', 'pc')->select('_id')->get());

                        $NavbarUserModels = User::orderBy('name', 'asc')->orderBy('stfusr_last_name', 'asc')->where('stfusr_deletion', '0')->where('stfusr_status', 'a')->select('name', 'stfusr_last_name')->get();
                    // NAVBAR

                    // LOGIN
                        if(!empty(Auth::user()->stfusr_last_login))
                        {
                            $startTime = Carbon::parse(Carbon::now()->format('Y-m-d H:i:s'));
                            $endTime = Carbon::parse(Auth::user()->stfusr_last_login);

                            $hoursDifference = $endTime->diffInHours($startTime);

                            if($hoursDifference > 12)
                            {
                                // LAST LOGIN
                                    $user = Auth::user();
                                    $user->stfusr_last_login = Carbon::now()->format('Y-m-d H:i:s');
                                    $user->save();
                                // LAST LOGIN
                                
                                // LOGIN LOGS
                                    $request_login_ip = app('request');

                                    LogSetting::firstOrCreate([
                                        'lgset_event' => ($user->name ?? "")." ".($user->stfusr_last_name ?? "")." login into the portal",
                                        'lgset_type' =>  "Login Portal",
                                        'lgset_category' =>  "Login",
                                        'lgset_status' =>  "Successful",
                                        'lgset_remarks' =>  "",
                                        'lgset_created_date' => Carbon::now()->format('Y-m-d'),
                                        'lgset_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                                        'lgset_created_by' => $user->_id,
                                        'lgset_computer_ip' => $request_login_ip->header('X-Forwarded-For'),
                                    ]);
                                // LOGIN LOGS
                            }
                        }
                    // LOGIN
                @endphp
            <!-- PHP END -->
            
            @include('layouts.navbar')
        <!-- NAVBAR END -->

        <div class="uk-grid-collapse" uk-grid>
            <div class="uk-width-auto custom-sidebar-tile uk-hidden@l">
                <!-- SIDEBAR START-->
                    @include('layouts.sidebar')
                <!-- SIDEBAR END -->
            </div>
            <div class="uk-width-expand">
                <!-- CONTENT START -->
                    @yield('master.content')
                <!-- CONTENT END -->
            </div>
        </div>

        <!-- SCRIPT START-->
            <!-- NAVBAR REFRESH -->
                <script>
                    $(document).ready(function(){
                        function refreshNavbar() {
                            $('#refreshNavbarTicket').load(document.URL + ' #refreshNavbarTicket > *');
                            $('#refreshSidebarTicket').load(document.URL + ' #refreshSidebarTicket > *');
                            $('#refreshNavbarAlert').load(document.URL + ' #refreshNavbarAlert > *');
                            $('#refreshSidebarAlert').load(document.URL + ' #refreshSidebarAlert > *');
                            $('#refreshNavbarProject').load(document.URL + ' #refreshNavbarProject > *');
                            $('#refreshSidebarProject').load(document.URL + ' #refreshSidebarProject > *');
                            $('#refreshNavbarTask').load(document.URL + ' #refreshNavbarTask > *');
                            $('#refreshNavbarTaskLabel').load(document.URL + ' #refreshNavbarTaskLabel > *');
                            $('#tbodyNavbarTask').load(document.URL +  ' #tbodyNavbarTask tr');
                        }
                        setInterval(refreshNavbar, 100000);
                    });
                </script>

            <!-- DATE & TIME-->
                <script>
                    $(document).ready(function() {
                        // DATEPICKER
                            $(".DateTimeInput").datepicker({
                                dateFormat: "dd-mm-yy",
                                onSelect: function(selectedDate) {
                                    $(".DateTimeInputAfter").datepicker("option", "minDate", selectedDate);
                                }
                            });

                            $(".DateTimeInputAfter").datepicker({
                                dateFormat: "dd-mm-yy"
                            });
                        // DATEPICKER

                        // CALENDAR AND TIME
                            flatpickr(".CalendarTimeInput", {
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                                time_24hr: true
                            });

                            flatpickr(".ClockTimeInput", {
                                enableTime: true,
                                dateFormat: "h:i K",
                                noCalendar: true
                            });
                        // CALENDAR AND TIME
                    });
                </script>

            <!-- TINYMCE -->
                <script>
                    tinymce.init({
                        selector: '.tinytextareadefault',
                        license_key: 'gpl',
                        plugins: 'lists advlist table',
                        toolbar: 'aligncenter alignjustify fontfamily fontsize forecolor bold italic underline | numlist bullist | table tabledelete',
                        newline_behavior: 'invert',
                        table_default_attributes: {
                            border: '0'
                        },
                        setup: function(editor) {
                            editor.on('keyup', function(e) {

                                // TICKET
                                $('#pasteTicketContentValues').empty();
                                var selectTicketID = $('.selectTicketID').val();
                                if(selectTicketID)
                                {
                                    var GetTicketSavedDraftMessage = editor.getContent();
                                    $("#pasteTicketContentValues").append('<div>' + GetTicketSavedDraftMessage + '</div>');

                                    $.ajax({
                                        url: '/coverdesk/ticket/save/draft/message',
                                        type: "POST",
                                        data: {
                                            selectTicketID:selectTicketID,
                                            GetTicketSavedDraftMessage:GetTicketSavedDraftMessage,
                                            _token: '{{csrf_token()}}'
                                        },
                                        success: function(data) {
                                            
                                        }
                                    });
                                }

                                // PROJECT
                                $('#pasteProjectContentValues').empty();
                                var selectProjectID = $('.selectProjectID').val();
                                if(selectProjectID)
                                {
                                    var GetProjectSavedDraftMessage = editor.getContent();
                                    $("#pasteProjectContentValues").append('<div>' + GetProjectSavedDraftMessage + '</div>');

                                    $.ajax({
                                        url: '/coverdesk/project/message/save/draft/message',
                                        type: "POST",
                                        data: {
                                            selectProjectID:selectProjectID,
                                            GetProjectSavedDraftMessage:GetProjectSavedDraftMessage,
                                            _token: '{{csrf_token()}}'
                                        },
                                        success: function(data) {
                                            
                                        }
                                    });
                                }

                                // REMOTE PATCH
                                $('#pasteRemotePatchContentValues').empty();
                                var selectRemotePatchID = $('.selectRemotePatchID').val();
                                if(selectRemotePatchID)
                                {
                                    var GetRemotePatchSavedDraftMessage = editor.getContent();
                                    $("#pasteRemotePatchContentValues").append('<div>' + GetRemotePatchSavedDraftMessage + '</div>');

                                    $.ajax({
                                        url: '/coverdesk/maintenance/remote_patch/message/save/draft/message',
                                        type: "POST",
                                        data: {
                                            selectRemotePatchID:selectRemotePatchID,
                                            GetRemotePatchSavedDraftMessage:GetRemotePatchSavedDraftMessage,
                                            _token: '{{csrf_token()}}'
                                        },
                                        success: function(data) {
                                            
                                        }
                                    });
                                }

                                // ONSITE INSPECTION
                                $('#pasteOnsiteInspectionContentValues').empty();
                                var selectOnsiteInspectionID = $('.selectOnsiteInspectionID').val();
                                if(selectOnsiteInspectionID)
                                {
                                    var GetOnsiteInspectionSavedDraftMessage = editor.getContent();
                                    $("#pasteOnsiteInspectionContentValues").append('<div>' + GetOnsiteInspectionSavedDraftMessage + '</div>');

                                    $.ajax({
                                        url: '/coverdesk/maintenance/onsite_inspection/message/save/draft/message',
                                        type: "POST",
                                        data: {
                                            selectOnsiteInspectionID:selectOnsiteInspectionID,
                                            GetOnsiteInspectionSavedDraftMessage:GetOnsiteInspectionSavedDraftMessage,
                                            _token: '{{csrf_token()}}'
                                        },
                                        success: function(data) {
                                            
                                        }
                                    });
                                }
                                
                            });
                        },
                    });
                </script>
                <script>
                    UIkit.util.on('.update-tinymce-modal', 'show', function () {
                        tinymce.init({
                            selector: '.tinytextareamodal',
                            license_key: 'gpl',
                            plugins: 'lists advlist table',
                            toolbar: 'aligncenter alignjustify fontfamily fontsize forecolor bold italic underline | numlist bullist | table tabledelete',
                            newline_behavior: 'invert',
                            table_default_attributes: {
                                border: '0'
                            },
                        });
                    });
                </script>

            <!-- PAGE PERMISSION INVALID -->
                @if (\Session::has('page-permission-invalid'))
                    <script>
                        UIkit.notification({
                            message: '<div class="uk-grid uk-grid-small"><div class="uk-width-auto uk-flex uk-flex-middle"><i class="fa-light fa-circle-check fa-xl fa-nm"></i></div><div class="uk-width-expand"><h4>Permission Invalid!</h4><span>You have no access into this page.</span></div></div>',
                            pos: 'bottom-right',
                            status: 'danger',
                            timeout: 15000,
                            sticky: true,
                        })
                    </script>
                @endif

            <!-- PREVENT DOUBLE CLICK SUBMIT -->
                <script>
                    $(document).ready(function () {
                        $('.PreventDoubleForm').submit(function () {
                            $('.PreventDoubleSubmit').attr('disabled', true);
                            $('.PreventDoubleSubmit').html('Processing...');
                            return true;
                        });
                    });
                </script>

            <!-- CRON PUSH NEW TICKET -->
                <script>
                    setInterval(displayHello, 100000);

                    function displayHello() {

                        // TICKETS
                        $.ajax({
                            url: '/coverdesk/ticket/push/new/ticket',
                            type: "GET",
                            success: function (response) {
                                if(response.success == '0')
                                {
                                    // NOTHING TO DO!!!
                                }   
                                else
                                {
                                    var count = response.success;

                                    UIkit.notification({
                                        message: '<div class="uk-grid uk-grid-small"><div class="uk-width-auto uk-flex uk-flex-middle"><i class="fa-light fa-circle-check fa-xl fa-nm"></i></div><div class="uk-width-expand"><h4>@if(' + count + ' > 100) 100+ @else ' + count + ' @endif New Ticket!</h4><span>New ticket has been created.</span></div></div>',
                                        pos: 'bottom-right',
                                        status: 'success',
                                        timeout: 150000,
                                        sticky: true,
                                    })
                                }
                            }
                        });

                        // MESSAGES
                        $.ajax({
                            url: '/coverdesk/ticket/push/new/message',
                            type: "GET",
                            success: function (response) {
                                if(response.success == '0')
                                {
                                    // NOTHING TO DO!!!
                                }   
                                else
                                {
                                    var count = response.success;

                                    UIkit.notification({
                                        message: '<div class="uk-grid uk-grid-small"><div class="uk-width-auto uk-flex uk-flex-middle"><i class="fa-light fa-circle-check fa-xl fa-nm"></i></div><div class="uk-width-expand"><h4>@if(' + count + ' > 100) 100+ @else ' + count + ' @endif New Message!</h4><span>New ticket messages from client.</span></div></div>',
                                        pos: 'bottom-right',
                                        status: 'success',
                                        timeout: 150000,
                                        sticky: true,
                                    })
                                }
                            }
                        });
                    }
                </script>

            <!-- CRON PUSH NEW ALERT -->
                <script>
                    setInterval(displayHello, 130000);

                    function displayHello() {

                        $.ajax({
                            url: '/coverdesk/alert/push/new/alert',
                            type: "GET",
                            success: function (response) {
                                if(response.success == '0')
                                {
                                    // NOTHING TO DO!!!
                                }   
                                else
                                {
                                    var count = response.success;

                                    UIkit.notification({
                                        message: '<div class="uk-grid uk-grid-small"><div class="uk-width-auto uk-flex uk-flex-middle"><i class="fa-light fa-circle-check fa-xl fa-nm"></i></div><div class="uk-width-expand"><h4>' + count + ' New Alert!</h4><span>New Alert has been detected.</span></div></div>',
                                        pos: 'bottom-right',
                                        status: 'success',
                                        timeout: 150000,
                                        sticky: true,
                                    })
                                }
                            }
                        });
                    }
                </script>

            <!-- CRON PUSH LATEST SOFTWARE -->
                <script>
                    setInterval(displayHello, 200000);

                    function displayHello() {

                        $.ajax({
                            url: '/api/software/superops/push/new/software',
                            type: "GET",
                            success: function (response) {
                                if(response.success == '0')
                                {
                                    // NOTHING TO DO!!!
                                }
                                else
                                {
                                    if (response.success == '1')
                                    {
                                        var count = response.success;

                                        UIkit.notification({
                                            message: '<div class="uk-grid uk-grid-small"><div class="uk-width-auto uk-flex uk-flex-middle"><i class="fa-light fa-circle-check fa-xl fa-nm"></i></div><div class="uk-width-expand"><h4>SuperOps Software Updated!</h4><span>You may view the latest software list now.</span></div></div>',
                                            pos: 'bottom-right',
                                            status: 'success',
                                            timeout: 150000,
                                            sticky: true,
                                        })
                                    }

                                    if (response.success == '2')
                                    {
                                        var count = response.success;

                                        UIkit.notification({
                                            message: '<div class="uk-grid uk-grid-small"><div class="uk-width-auto uk-flex uk-flex-middle"><i class="fa-light fa-circle-check fa-xl fa-nm"></i></div><div class="uk-width-expand"><h4>SuperOps Software Failed!</h4><span>Failed to update latest software list, kindly check with the developer.</span></div></div>',
                                            pos: 'bottom-right',
                                            status: 'danger',
                                            timeout: 150000,
                                            sticky: true,
                                        })
                                    }
                                }
                            }
                        });
                    }
                </script>

                @yield('master.script')
        <!-- SCRIPT END -->

    </body>

</html>
