<!-- //////////////////////////////////////////// NAVBAR //////////////////////////////////////////// -->
<div class="custom-navbar-shadow" uk-sticky="position: top">
    <div class="uk-grid-collapse uk-tile custom-navbar-tile custom-navbar-size" uk-grid>
        <div class="uk-width-small">
            <a href="#"><img src="<?php echo e(asset('/img/LogoCovertech.png')); ?>" alt="" width="120px"/></a>
        </div>
        <div class="uk-width-expand">
            <div class="uk-grid-small custom-navbar-row uk-visible@l" uk-grid>
                <div class="custom-navbar-item custom-navbar-active <?php if(!empty($tabtop) &&  $tabtop == 'alert'): ?> uk-active <?php endif; ?>">
                    <a href="<?php echo e(route('coverdesk.alert')); ?>" uk-tooltip="title: Alert; pos: bottom">
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
                        <?php if(!empty(Auth::user()->name) || !empty(Auth::user()->stfusr_last_name)): ?>
                            <?php if(!empty(Auth::user()->name)): ?>
                                <?php echo e(Auth::user()->name); ?>

                            <?php endif; ?>
                            <?php if(!empty(Auth::user()->stfusr_last_name)): ?>
                                <?php echo e(Auth::user()->stfusr_last_name); ?>

                            <?php endif; ?>
                        <?php else: ?>
                            <span class="uk-text-muted">Unknown</span> 
                        <?php endif; ?>
                    </span>
                </div>
                <div class="uk-width-auto uk-flex uk-flex-middle">
                    <a type="button">
                        <?php if(!empty(Auth::user()->stfusr_profile_image)): ?>
                            <img src="<?php echo e(asset('img/profile_img/'.Auth::user()->stfusr_profile_image)); ?>" width="30px" style="border-radius: 50%;">
                        <?php else: ?>
                            <img src="<?php echo e(asset('img/default-avatar.png')); ?>" width="30px" style="border-radius: 50%;">
                        <?php endif; ?>
                    </a>
                    <div uk-dropdown="mode: click">
                        <div class="uk-padding uk-text-center uk-text-truncate">
                            <h5 class="uk-text-bold">
                                <?php if(!empty(Auth::user()->name)): ?>
                                    <?php echo e(Auth::user()->name); ?>

                                <?php else: ?>
                                    Unknown
                                <?php endif; ?>
                            </h5>
                            <span>
                                <?php if(!empty(Auth::user()->email)): ?>
                                    <?php echo e(Crypt::decryptString(Auth::user()->email)); ?>

                                <?php else: ?>
                                    Unknown
                                <?php endif; ?>
                            </span>
                        </div>
                        <hr class="uk-margin-remove">
                        <a href="<?php echo e(route('auth.user.logout')); ?>">
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
<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// --><?php /**PATH C:\xampp\htdocs\20241115 - dash.covertech.com.my (Alert Only)\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>