<!-- //////////////////////////////////////////// PAGINATION //////////////////////////////////////////// -->
<?php
    $visibleRange = 5;
    $halfRange = floor($visibleRange / 2);
    $startPage = max(1, $paginator->currentPage() - $halfRange);
    $endPage = min($paginator->lastPage(), $paginator->currentPage() + $halfRange);

    // Adjust start and end pages if they are out of bounds
    if ($startPage > 1) {
        $endPage = min($paginator->lastPage(), $endPage + $startPage - 1);
    } else {
        $endPage = min($paginator->lastPage(), $visibleRange);
    }

    if ($endPage === $paginator->lastPage()) {
        $startPage = max(1, $paginator->lastPage() - $visibleRange + 1);
    }
?>

<?php if($paginator->lastPage() > 1): ?>
    <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-expand uk-flex uk-flex-middle">
            <span class="uk-text-small">Showing <?php echo e($paginator->firstItem()); ?> to <?php echo e($paginator->lastItem()); ?> of <?php echo e($paginator->total()); ?> results</span>
        </div>
        <div class="uk-width-auto uk-flex uk-flex-middle">
            <div class="uk-grid-collapse" uk-grid>
                <div class="uk-width-auto">
                    <div class="<?php echo e(($paginator->currentPage() == 1) ? ' disabled' : ''); ?>">
                        <a href="<?php echo e($paginator->url(1)); ?>"><i class="fa-light fa-caret-left fa-nm"></i></a>
                    </div>
                </div>
                <div class="uk-width-expand">
                    <?php $__currentLoopData = range($startPage, $endPage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->first && $page > 1): ?>
                            <span>...</span>
                        <?php endif; ?>

                        <a href="<?php echo e($paginator->url($page)); ?>">
                            <span class="uk-text-small custom-button-pagination custom-margin-spacing <?php if($paginator->currentPage() == $page): ?> custom-number-pagination <?php endif; ?>">
                                <?php echo e($page); ?>

                            </span>
                        </a>

                        <?php if($loop->last && $page < $paginator->lastPage()): ?>
                            <span>...</span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="uk-width-auto">
                    <div class="<?php echo e(($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : ''); ?>">
                        <a href="<?php echo e($paginator->url($paginator->currentPage() + 1)); ?>" ><i class="fa-light fa-caret-right fa-nm"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- //////////////////////////////////////////// PAGINATION //////////////////////////////////////////// --><?php /**PATH C:\xampp\htdocs\20241115 - dash.covertech.com.my (Alert Only)\resources\views/layouts/pagination.blade.php ENDPATH**/ ?>