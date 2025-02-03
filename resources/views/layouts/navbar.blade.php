<!-- //////////////////////////////////////////// NAVBAR //////////////////////////////////////////// -->
<div class="custom-navbar-shadow" uk-sticky="position: top">
    <div class="uk-grid-collapse uk-tile custom-navbar-tile custom-navbar-size" uk-grid>
        <div class="uk-width-small">
            <a href="#"><img src="{{ asset('/img/LogoCovertech.png') }}" alt="" width="120px"/></a>
        </div>
        <div class="uk-width-expand">
            <div class="uk-grid-small custom-navbar-row uk-visible@l" uk-grid>
                <div class="custom-navbar-item custom-navbar-active @if(!empty($tabtop) &&  $tabtop == 'alert') uk-active @endif">
                    <a href="{{ route('coverdesk.alert') }}" uk-tooltip="title: Alert; pos: bottom">
                        <div id="refreshNavbarAlert" class="custom-navbar-active-icon">
                            <i class="fa-light fa-bell fa-lg fa-nm"></i>
                            <span class="uk-text-center badge-warning badge-lblCount">1</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="uk-width-auto uk-flex uk-flex-right uk-flex-middle">
            <div class="uk-grid-medium" uk-grid>
                <div class="uk-width-auto uk-flex uk-flex-middle">
                    <span class="uk-light">
                        @if (!empty(Auth::user()->name) || !empty(Auth::user()->stfusr_last_name))
                            @if (!empty(Auth::user()->name))
                                {{ Auth::user()->name }}
                            @endif
                            @if (!empty(Auth::user()->stfusr_last_name))
                                {{ Auth::user()->stfusr_last_name }}
                            @endif
                        @else
                            <span class="uk-text-muted">Unknown</span> 
                        @endif
                    </span>
                </div>
                <div class="uk-width-auto uk-flex uk-flex-middle">
                    <a type="button">
                        @if (!empty(Auth::user()->stfusr_profile_image))
                            <img src="{{ asset('img/profile_img/'.Auth::user()->stfusr_profile_image) }}" width="30px" style="border-radius: 50%;">
                        @else
                            <img src="{{ asset('img/default-avatar.png') }}" width="30px" style="border-radius: 50%;">
                        @endif
                    </a>
                    <div uk-dropdown="mode: click">
                        <div class="uk-padding uk-text-center uk-text-truncate">
                            <h5 class="uk-text-bold">
                                @if (!empty(Auth::user()->name))
                                    {{ Auth::user()->name }}
                                @else
                                    Unknown
                                @endif
                            </h5>
                            <span>
                                @if (!empty(Auth::user()->email))
                                    {{ Crypt::decryptString(Auth::user()->email) }}
                                @else
                                    Unknown
                                @endif
                            </span>
                        </div>
                        <hr class="uk-margin-remove">
                        <a href="{{ route('auth.user.logout') }}">
                            <div class="uk-padding uk-padding-hover">
                                <i class="fa-solid fa-right-from-bracket fa-nm"></i> Logout
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="progress_id" class="beforeunload">
        <progress id="js-progressbar" class="uk-progress" value="25" max="100"></progress>
    </div>
</div>
<!-- //////////////////////////////////////////// NAVBAR //////////////////////////////////////////// -->

<!---------------------------------------------------------------------------------------------------------------------------------------------->

<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->
<!-- LOAD BAR -->
<script>
    UIkit.util.ready(function () {
        var bar = document.getElementById('js-progressbar');
        var progressContainer = document.getElementById('progress_id');
        function showProgressBar() {
            progressContainer.style.display = 'block';
            bar.value = 25;
        }
        window.addEventListener('beforeunload', showProgressBar);
        var animate = setInterval(function () {
            bar.value += 100;
            if (bar.value >= bar.max) {
                clearInterval(animate);
                setTimeout(function () {
                    progressContainer.style.display = 'none';
                }, 1000);
            }
            progress_id.isHidden = true
        }, 500);
    });
</script>
<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->