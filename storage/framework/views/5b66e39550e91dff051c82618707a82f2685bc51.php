  
  
<?php $__env->startSection('master.content'); ?>

<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<form method="POST" action="<?php echo e(route('auth.login.two.factor.submit')); ?>">
    <?php echo csrf_field(); ?>

    <input type="hidden" name="client_id" value="<?php echo e(encrypt($UserFound->_id)); ?>" />
    <input type="hidden" name="remember" value="<?php echo e($remember); ?>" />

    <div class="uk-margin uk-text-center">
        <h3 class="uk-text-bold">Enter your 2FA</h3>
    </div>
    <div class="uk-margin">
        <span>Please open your authenticator and key-in the 6-digit code to proceed.</span>
    </div>

    <?php if(!empty($incorrect2FA)): ?>
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger">Your 2FA credential was incorrect, please try again.</span>
        </div>
    <?php endif; ?>

    <?php if(\Session::has('auth-2fa-invalid')): ?>
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger"><?php echo \Session::get('auth-2fa-invalid'); ?></span>
        </div>
    <?php endif; ?>

    <?php if(\Session::has('auth-2fa-empty')): ?>
        <div class="uk-margin uk-animation-slide-bottom-small uk-text-center">
            <span class="uk-text-danger"><?php echo \Session::get('auth-2fa-empty'); ?></span>
        </div>
    <?php endif; ?>

    <div class="uk-margin">
        <input id="code" class="uk-input" type="text" name="code" inputmode="numeric" placeholder="6-digit-code" autofocus x-ref="code" autocomplete="one-time-code" required />
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Submit</button>
    </div>
    <div class="uk-margin uk-text-center">
        <a href="<?php echo e(route('auth.login')); ?>">
            <span class="uk-text-muted">Back to login</span>
        </a>
    </div>
</form>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\20241115 - dash.covertech.com.my (Alert Only)\resources\views/auth/login-two-factor.blade.php ENDPATH**/ ?>