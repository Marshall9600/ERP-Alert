<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <!-- CSS -->
            <!-- Default -->
            <link rel="stylesheet" href="<?php echo e(asset('/css/uikit.css')); ?>">
            <!-- Fontawesome -->
            <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/fontawesome/css/all.css')); ?>">

        <!-- Custom CSS -->
            <!-- My CSS -->
            <link rel="stylesheet" href="<?php echo e(asset('/css/font.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('/css/custom.css')); ?>">
            <!-- Select2 -->
            <link rel="stylesheet" href="<?php echo e(asset('/css/select2.min.css')); ?>">

        <!-- JS -->
            <!-- Default -->
            <script src="<?php echo e(asset('/js/uikit.js')); ?>"></script>
            <script src="<?php echo e(asset('/js/uikit-icons.js')); ?>"></script>
            <script src="<?php echo e(asset('/js/jquery.min.js')); ?>" type="text/javascript"></script>

    </head>
    <body>
        
        <div class="uk-width-expand uk-flex uk-flex-middle uk-flex-center" uk-height-viewport>
            <div class="uk-card uk-card-body uk-card-default uk-width-1-2">
                    
                <div class="uk-grid-medium" uk-grid>
                    <div class="uk-width-2-3 uk-flex uk-flex-middle">
                        <div>
                            <h1><?php echo $__env->yieldContent('message'); ?></h1>
                            <div class="uk-margin">
                                <?php echo $__env->yieldContent('body'); ?>
                            </div>
                            <div class="uk-margin">
                                <a href="<?php echo e(url()->previous()); ?>" class="uk-button uk-button-default custom-icon-green">Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3 uk-flex uk-flex-middle">
                        <i class="fa-light fa-circle-question fa-6x"></i>
                    </div>
                </div>

            </div>
        </div>
        
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\20241115 - dash.covertech.com.my (Alert Only)\resources\views/errors/minimal.blade.php ENDPATH**/ ?>