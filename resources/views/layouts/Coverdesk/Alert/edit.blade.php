@extends('layouts.master')
@section('master.content')
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<div class="uk-padding-small">
    <!-- TOP BAR -->
    <div class="uk-margin uk-card-default">
        <div class="uk-card uk-card-body uk-card-small">
            <div class="uk-margin" uk-grid>
                <div class="uk-width-expand uk-flex uk-flex-middle">
                    <!-- RETURN -->
                    <a class="returnForgetTab" href="{{ route('coverdesk.alert') }}"><h6><i class="fa-light fa-left-long fa-lg fa-nm-right"></i> Return</a>
                </div>
                <div class="uk-width-auto uk-flex uk-flex-right@l uk-flex-middle">
                    <!-- EDITOR -->
                    <div class="uk-grid-small" uk-grid>
                        @if (!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status !== "c" && $ModelData->cvdalrt_deletion == "0" && empty($ModelData->getTicket->cvdtic_id))
                            <div class="uk-width-auto uk-flex uk-flex-middle">
                                <div class="custom-button-small custom-icon-red" uk-tooltip="title: Spam">
                                    <a href="#delete-alert" uk-toggle><i class="fa-light fa-trash fa-lg fa-nm"></i></a>
                                </div>
                            </div>
                        @else
                            <div class="uk-width-auto uk-flex uk-flex-middle">
                                <div class="custom-button-small custom-icon-gray" uk-tooltip="title: Ticket Created">
                                    <button disabled><i class="fa-light fa-trash fa-lg fa-nm"></i></button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <!-- ALERT SUBJECT -->
                <div class="uk-margin uk-padding-small custom-border-radius">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-expand">
                            <h1>
                                @if (!empty($ModelData->cvdalrt_subject))
                                    {{ $ModelData->cvdalrt_subject }}
                                @else
                                    Unknown
                                @endif
                            </h1>
                        </div>
                    </div>
                </div>
                <h6>
                    Alert created
                    @if ($ModelData->cvdalrt_created_date_time)
                        {{ Carbon\Carbon::parse($ModelData->cvdalrt_created_date_time)->diffForHumans() }}
                    @endif
                </h6>
                @if (!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status == "c" && $ModelData->cvdalrt_deletion == "0")
                    <span class="uk-label">Assigned with Ticket</span>
                @endif
                @if (!empty($ModelData->cvdalrt_deletion) && $ModelData->cvdalrt_deletion == "1")
                    <span class="uk-label uk-label-danger">Deleted</span>
                @elseif (!empty($ModelData->cvdalrt_deletion) && $ModelData->cvdalrt_deletion == "2")
                    <span class="uk-label uk-label-danger">Spam</span>
                @endif
            </div>
        </div>
        <div class="uk-grid-collapse uk-grid-match" uk-grid>
            <div class="uk-width-expand@m uk-flex-bottom">
                <div class="uk-card uk-card-body uk-card-small custom-info-background-left">
                    <div class="uk-margin-small">
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-4@m">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-auto">
                                        <i class="fa-light fa-bell fa-lg fa-nm-right uk-text-primary"></i>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h6 class="uk-text-bold uk-text-primary">Alert ID:</h6>
                                        <span>
                                            @if (!empty($ModelData->cvdalrt_id))
                                                {{ $ModelData->cvdalrt_id }}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-1-4@m">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-auto">
                                        <i class="fa-light fa-timer fa-lg fa-nm-right"></i>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h6 class="uk-text-bold">Created Date:</h6>
                                        <span>
                                            @if (!empty($ModelData->cvdalrt_created_date_time))
                                                {{ Carbon\Carbon::parse($ModelData->cvdalrt_created_date_time)->format('j-M-Y h:i A') }}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($ModelData->getTicket->cvdtic_id))
                <div class="uk-width-auto@m">
                    <div class="uk-card uk-card-body uk-card-small uk-flex uk-flex-middle uk-flex-center">
                        <a href="{{ route('coverdesk.ticket.edit', ['TicketID' => $ModelData->getTicket->cvdtic_id]) }}" class="uk-button uk-button-default" target="_blank" rel="noopener"><i class="fa-solid fa-ticket fa-nm-right uk-text-primary"></i> {{ $ModelData->getTicket->cvdtic_id }}</a>
                    </div>
                </div>
            @else
                @if (!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status !== "c" && $ModelData->cvdalrt_deletion == "0")
                    @if (!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status !== "c" && $ModelData->cvdalrt_deletion == "0" && empty($ModelData->getTicket->cvdtic_id))
                        <div class="uk-width-auto@m">
                            <div class="uk-card uk-card-body uk-card-small uk-flex uk-flex-middle uk-flex-center">
                                <a href="#convert-into-ticket" uk-toggle class="uk-button uk-button-default uk-width-1-1"><i class="fa-solid fa-arrows-retweet fa-nm-right uk-text-primary"></i> Convert into Ticket</a>
                            </div>
                        </div>
                        <div class="uk-width-auto@m uk-flex-middle uk-flex-center">
                            OR
                        </div>
                        <div class="uk-width-auto@m">
                            <div class="uk-card uk-card-body uk-card-small uk-flex uk-flex-middle uk-flex-center">
                                <a href="#assign-into-ticket" uk-toggle class="uk-button uk-button-default uk-width-1-1"><i class="fa-solid fa-arrow-turn-right fa-nm-right uk-text-primary"></i> Assign to a Ticket</a>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </div>
    </div>
    <!-- ALERT MESSAGE & LOG -->
    <div class="uk-margin uk-card-default">
        <ul class="uk-tab-alert uk-child-width-expand" uk-tab="connect: #switcher-tab;">
            <li>
                <!-- ALERT MESSAGE -->
                <a href="#tab1" class="tab-active">
                    <div class="uk-padding">
                        <h6>Messages</h6>
                    </div>
                </a>
            </li>
            <li>
                <!-- AUDIT LOG -->
                <a href="#tab2" class="tab-active">
                    <div class="uk-padding">
                        <h6>Audit Log</h6>
                    </div>
                </a>
            </li>
        </ul>
        <ul id="switcher-tab" class="uk-switcher">
            <li id="tab1">
                <!-- MESSAGES -->
                <div class="uk-padding-small">
                    <div class="custom-table-border">
                        <div class="uk-padding custom-background">
                            <table class="uk-table uk-table-small uk-table-middle">
                                <tbody>
                                    <tr>
                                        <td class="uk-width-small">
                                            <h5 class="custom-text-bakbakone">From</h5>
                                        </td>
                                        <td class="uk-table-shrink">
                                            :
                                        </td>
                                        <td class="uk-table-expand">
                                            @if (!empty($ModelData->cvdalrt_from))
                                                @php
                                                    try {
                                                        $cvdalrt_from_descrypt = Crypt::decryptString($ModelData->cvdalrt_from) ?? "";
                                                    } catch (\Exception $e) {
                                                        $cvdalrt_from_descrypt = "";
                                                    }
                                                @endphp
                                                <span class="fa-nm-right">{{ $cvdalrt_from_descrypt }};</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="uk-width-small">
                                            <h5 class="custom-text-bakbakone">To</h5>
                                        </td>
                                        <td class="uk-table-shrink">
                                            :
                                        </td>
                                        <td class="uk-table-expand">
                                            @if (!empty($ModelData->cvdalrt_to) && is_array($ModelData->cvdalrt_to))
                                                @foreach ($ModelData->cvdalrt_to as $cvdalrt_to)
                                                    @php
                                                        try {
                                                            $cvdalrt_to_descrypt = Crypt::decryptString($cvdalrt_to) ?? "";
                                                        } catch (\Exception $e) {
                                                            $cvdalrt_to_descrypt = "";
                                                        }
                                                    @endphp
                                                    <span class="fa-nm-right">{{ $cvdalrt_to_descrypt }};</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="uk-width-small">
                                            <h5 class="custom-text-bakbakone">Cc</h5>
                                        </td>
                                        <td class="uk-table-shrink">
                                            :
                                        </td>
                                        <td class="uk-table-expand">
                                            @if (!empty($ModelData->cvdalrt_cc) && is_array($ModelData->cvdalrt_cc))
                                                @foreach ($ModelData->cvdalrt_cc as $cvdalrt_cc)
                                                    @php
                                                        try {
                                                            $cvdalrt_cc_descrypt = Crypt::decryptString($cvdalrt_cc) ?? "";
                                                        } catch (\Exception $e) {
                                                            $cvdalrt_cc_descrypt = "";
                                                        }
                                                    @endphp
                                                    <span class="fa-nm-right">{{ $cvdalrt_cc_descrypt }};</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="uk-grid-small" uk-grid>
                                @foreach ($AlertAttachmentModels as $AlertAttachmentModel)
                                    <div class="uk-width-1-5@m uk-width-1-2@s">
                                        <form class="uk-form-stacked" action="{{ route('coverdesk.alert.download.attachment') }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="cvdalrtatm_attachment_name" value="{{ $AlertAttachmentModel->cvdalrtatm_attachment_name }}">
                                            <input type="hidden" name="cvdalrtatm_attachment_path" value="{{ $AlertAttachmentModel->cvdalrtatm_attachment_path }}">
                                            <button type="submit" class="custom-attachment-boarder uk-width-1-1 uk-flex uk-flex-left uk-text-truncate">
                                                <div class="uk-padding">
                                                    <i class="fa-solid fa-file-pdf fa-nm"></i>
                                                    @if (!empty($AlertAttachmentModel->cvdalrtatm_attachment_name))
                                                        {{ Str::limit($AlertAttachmentModel->cvdalrtatm_attachment_name, 30) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="uk-padding custom-padding-message@l custom-padding-message@m uk-overflow-auto">
                            @if (!empty($ModelData->cvdalrt_body_html))
                                {!! $ModelData->cvdalrt_body_html !!}
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            <li id="tab2">
                <!-- AUDIT LOG -->
                <div class="uk-padding-small">
                    <ul class="StepProgress">
                        @foreach ($LogAlertModels as $LogAlertModel)
                            <div class="StepProgress-item is-done">
                                <strong style="color: @if(!empty($LogAlertModel->lgcvdalrt_color_code)){{ $LogAlertModel->lgcvdalrt_color_code }}@endif">
                                    <div class="uk-grid-small" uk-grid>
                                        <div class="uk-width-auto">
                                            <i class="fa-solid fa-@if(!empty($LogAlertModel->lgcvdalrt_icon_code)){{ $LogAlertModel->lgcvdalrt_icon_code }}@endif fa-nm"></i>
                                            @if (!empty($LogAlertModel->lgcvdalrt_type))
                                                {{ $LogAlertModel->lgcvdalrt_type }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                                </strong>
                                <div class="uk-text-small uk-text-muted">
                                    @if (!empty($LogAlertModel->lgcvdalrt_created_date_time))
                                        {{ Carbon\Carbon::parse($LogAlertModel->lgcvdalrt_created_date_time)->format('j-M-Y h:i A') }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                                @if (!empty($LogAlertModel->lgcvdalrt_event))
                                    {{ $LogAlertModel->lgcvdalrt_event }}
                                @else
                                    N/A
                                @endif
                                @if (!empty($LogAlertModel->lgcvdalrt_role_type))
                                    <div class="uk-text-small uk-text-muted">
                                        @if ($LogAlertModel->lgcvdalrt_role_type == "User")
                                            <span class="uk-text-primary"><i class="fa-solid fa-user-tie fa-nm"></i> Created by User</span>
                                        @elseif ($LogAlertModel->lgcvdalrt_role_type == "Client")
                                            <span class="uk-text-warning"><i class="fa-solid fa-user fa-nm"></i> Created by Client</span>
                                        @elseif ($LogAlertModel->lgcvdalrt_role_type == "System")
                                            <span class="uk-text-danger"><i class="fa-solid fa-robot fa-nm"></i> Created by System</span>
                                        @else
                                        @endif
                                    </div>
                                @else
                                @endif
                            </div>
                        @endforeach
                        <div class="StepProgress-item current">
                            <strong>START</strong>
                        </div>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MODAL //////////////////////////////////////////// -->
    <!-- CONVERT TICKET -->
    <div id="convert-into-ticket" class="uk-flex-top" uk-modal="bg-close: false">
        <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body">
            <form class="PreventDoubleForm" action="{{ route('coverdesk.ticket.store') }}" method="POST">
                <input type="hidden" name="cvdtic_channel" value="Alert">
                <input type="hidden" name="cvdtic_custody_id" value="{{ Auth::user()->_id }}">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-margin">
                    <h4><i class="fa-light fa-arrows-retweet fa-lg fa-nm uk-text-primary"></i> Convert into Ticket</h4>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-horizontal custom-modal-border">
                        <div class="uk-margin">
                            <span class="uk-form-label">Ticket Subject<span class="uk-text-danger">*</span></span>
                            <div class="uk-form-controls">
                                <input class="uk-input" name="cvdtic_subject" type="text" value="<script>alert('XSS!')</script>" placeholder="REQUIRED" required>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <span class="uk-form-label">Custody<span class="uk-text-danger">*</span></span>
                            <div class="uk-form-controls">
                                @if (!empty(Auth::user()->name) && !empty(Auth::user()->stfusr_last_name))
                                    <input class="uk-input" type="text" value="{{ Auth::user()->name.' '.Auth::user()->stfusr_last_name }}" disabled>
                                @elseif (!empty(Auth::user()->name))
                                    <input class="uk-input" type="text" value="{{ Auth::user()->name }}" disabled>
                                @elseif (!empty(Auth::user()->stfusr_last_name))
                                    <input class="uk-input" type="text" value="{{ Auth::user()->stfusr_last_name }}" disabled>
                                @else
                                    <input class="uk-input" type="text" value="UNKNOWN" disabled>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-margin">
                    <div uk-grid>
                        <div class="uk-width-expand">
                            
                        </div>
                        <div class="uk-width-auto">
                            <button class="uk-button uk-button-default uk-modal-close uk-margin-small-right custom-icon-red" type="button">Cancel</button>
                            <button class="uk-button uk-button-default custom-icon-green PreventDoubleSubmit" type="submit">Convert</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- //////////////////////////////////////////// MODAL //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MESSAGE //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MESSAGE //////////////////////////////////////////// -->

@endsection

<!---------------------------------------------------------------------------------------------------------------------------------------------->

@section('master.script')

<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->
    <!-- TAB REMEMBER -->
    <script>
        $(document).ready(function() {
            var activeTabCoverdeskAlert = localStorage.getItem('activeTabCoverdeskAlert');

            var uikitTab = UIkit.tab(document.querySelector('.uk-tab-alert'));

            if (activeTabCoverdeskAlert) {
                uikitTab.show(activeTabCoverdeskAlert);
                setTimeout(function() {
                    $('.tab-active').eq(activeTabCoverdeskAlert).click();
                }, 0);
            } else {
                $('.tab-active').first().click();
            }

            document.querySelectorAll('.uk-tab-alert > li > a').forEach(function (tabLink, index) {
                tabLink.addEventListener('click', function () {
                    localStorage.setItem('activeTabCoverdeskAlert', index);
                });
            });
        });
    </script>

    <!-- SELECT 2 -->
    <script>
        $(document).ready(function() {
            // SELECT2
                $('.select2AlertCompany').select2({
                    allowClear: false,
                    tags: true,
                    dropdownParent: $(".select2WorkAlertCompany"),
                    width: "100%",
                    placeholder: "Select..."
                });

                $('.select2AlertCompanyAssign').select2({
                    allowClear: false,
                    tags: true,
                    dropdownParent: $(".select2WorkAlertCompanyAssign"),
                    width: "100%",
                    placeholder: "Select..."
                });

                $('.select2AlertTicketAssign').select2({
                    allowClear: false,
                    tags: true,
                    dropdownParent: $(".select2WorkAlertTicketAssign"),
                    width: "100%",
                    placeholder: "Select..."
                });
            // SELECT2
        });
    </script>

    <!-- SUBMIT SPAM ALERT FORM -->
    <script>
        function submitDeleteAlertForm() {
            document.getElementById('myDeleteAlertForm').submit();
        }
    </script>
<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->
@endsection