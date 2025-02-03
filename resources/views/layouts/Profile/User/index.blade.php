@extends('layouts.master')  
  
@section('master.content')

<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<div class="uk-padding-small">
    <div class="uk-card-default">
        <div class="uk-container">
            <div class="uk-margin-medium uk-card uk-card-body uk-card-small">
                <!-- TITLE -->
                <h6 class="uk-heading-line"><span>My profile</span></h6>
            </div>
            <div class="uk-margin-medium uk-flex uk-flex-middle">
                <div class="uk-grid-medium uk-grid-match" uk-grid>
                    <div class="uk-width-2-3@m uk-flex-middle">
                        <!-- USER INFO -->
                        <div class="uk-card uk-card-body uk-card-small">
                            <div class="uk-margin-medium">
                                <!-- USER NAME -->
                                <h1 class="uk-heading-bullet uk-animation-slide-left-small">
                                    @if (!empty(Auth::user()->name) || !empty(Auth::user()->stfusr_last_name))
                                        @if (!empty(Auth::user()->stfusr_title))
                                            {{ Auth::user()->stfusr_title }}
                                        @endif
                                        @if (!empty(Auth::user()->name))
                                            {{ Auth::user()->name }}
                                        @endif
                                        @if (!empty(Auth::user()->stfusr_last_name))
                                            {{ Auth::user()->stfusr_last_name }}
                                        @endif
                                    @else
                                        Unknown
                                    @endif
                                </h1>
                            </div>
                            <div class="uk-margin">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3@m uk-width-1-2@s uk-animation-slide-bottom-small" style="animation-delay: 200ms;">
                                        <h6>Department:</h6>
                                        <span class="uk-text-bold">
                                            Research &amp; Development
                                        </span>
                                    </div>
                                    <div class="uk-width-1-3@m uk-width-1-2@s uk-animation-slide-bottom-small" style="animation-delay: 400ms;">
                                        <h6>Position:</h6>
                                        <span class="uk-text-bold">
                                            System Analyst
                                        </span>
                                    </div>
                                    <div class="uk-width-1-3@m uk-width-1-2@s uk-animation-slide-bottom-small" style="animation-delay: 600ms;">
                                        <h6>Staff ID:</h6>
                                        <span class="uk-text-bold">
                                            cover-11223344
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin-medium uk-text-justify">
                                <h5>As a System Analyst, you will play a critical role in bridging the gap between business needs and technological solutions. Your primary responsibility will be to analyze, design, and implement information systems that enhance organizational efficiency and meet the strategic objectives of the company. You will work closely with stakeholders from various departments to understand their requirements and translate them into functional specifications for development teams.</h5>
                            </div>
                            <div class="uk-margin-medium">
                                <div class="uk-margin uk-grid-small uk-animation-slide-left-small" uk-grid style="animation-delay: 400ms;">
                                    <div class="uk-width-auto uk-flex uk-flex-middle uk-flex-center">
                                        <i class="fa-light fa-location-dot fa-xl fa-nm"></i>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h6>Address:</h6>
                                        <span class="uk-text-bold">
                                            The Curve, Lot 237, Second Floor, Mutiara Damansara, 47800 Petaling Jaya, Selangor
                                        </span>
                                    </div>
                                </div>
                                <div class="uk-margin uk-grid-small uk-animation-slide-left-small" uk-grid style="animation-delay: 600ms;">
                                    <div class="uk-width-auto uk-flex uk-flex-middle uk-flex-center">
                                        <i class="fa-light fa-phone fa-xl fa-nm"></i>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h6>Mobile Number:</h6>
                                        <span class="uk-text-bold">
                                            +6016-4321 5678
                                        </span>
                                    </div>
                                </div>
                                <div class="uk-margin uk-grid-small uk-animation-slide-left-small" uk-grid style="animation-delay: 800ms;">
                                    <div class="uk-width-auto uk-flex uk-flex-middle uk-flex-center">
                                        <i class="fa-light fa-envelope fa-xl fa-nm"></i>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h6>Email Address:</h6>
                                        <span class="uk-text-bold">
                                            @if (!empty(Auth::user()->email))
                                                {{ Crypt::decryptString(Auth::user()->email) }}
                                            @else
                                                Unknown
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-expand@m uk-flex uk-flex-middle uk-visible@l">
                        <div class="uk-card uk-card-body uk-card-small">
                            <div class="uk-margin">
                                <img src="{{ asset('img/profile_img/profile.jpg') }}" width="500px" style="border-radius: 5%;">
                            </div>
                            <div class="uk-margin uk-flex uk-flex-right">
                                <i class="fa-light fa-circle-user fa-nm uk-animation-slide-bottom-small" style="animation-delay: 1000ms;"></i>
                                <i class="fa-light fa-circle-waveform-lines fa-nm uk-animation-slide-bottom-small" style="animation-delay: 1400ms;"></i>
                                <i class="fa-light fa-circle-bookmark fa-nm uk-animation-slide-bottom-small" style="animation-delay: 1800ms;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-margin uk-card-secondary uk-height-medium">

            </div>
        </div>
    </div>
</div>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MODAL //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MODAL //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MESSAGE //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MESSAGE //////////////////////////////////////////// -->

@endsection

<!---------------------------------------------------------------------------------------------------------------------------------------------->

@section('master.script')

<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->
    <!-- CLEAR TABS/SWITCHERS -->
    <script>
        localStorage.clear();
    </script>
<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->

@endsection