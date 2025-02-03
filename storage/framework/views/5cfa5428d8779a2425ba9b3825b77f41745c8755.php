  
  
<?php $__env->startSection('master.content'); ?>

<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<form method="POST" action="<?php echo e(route('auth.user.login')); ?>">
    <?php echo csrf_field(); ?>
    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Log in</h3>
    </div>

    <?php if(\Session::has('auth-forgot-password-send')): ?>
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-success"><?php echo \Session::get('auth-forgot-password-send'); ?></span>
        </div>
    <?php endif; ?>

    <?php if(\Session::has('auth-login-incorrect')): ?>
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger"><?php echo \Session::get('auth-login-incorrect'); ?></span>
        </div>
    <?php endif; ?>

    <?php if(\Session::has('auth-login-inactive')): ?>
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger"><?php echo \Session::get('auth-login-inactive'); ?></span>
        </div>
    <?php endif; ?>

    <div class="uk-margin">
        <input id="email" class="uk-input" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
    </div>
    <div class="uk-margin">
        <input id="password" class="uk-input" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
    </div>
    <div class="uk-margin">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
                <input id="remember_me" class="uk-checkbox" type="checkbox" name="remember" value="1">
            </div>
            <div class="uk-width-expand">
                <span>Remember Me</span>
            </div>
        </div>
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Sign in</button>
    </div>
</form>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\20241115 - dash.covertech.com.my (Alert Only)\resources\views/auth/login.blade.php ENDPATH**/ ?>