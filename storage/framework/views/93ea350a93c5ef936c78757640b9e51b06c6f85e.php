
<?php $__env->startSection('master.content'); ?>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<div class="uk-padding-small">
    <!-- TOP BAR -->
    <div class="uk-margin uk-card-default">
        <div class="uk-card uk-card-body uk-card-small">
            <div class="uk-margin" uk-grid>
                <div class="uk-width-expand uk-flex uk-flex-middle">
                    <!-- RETURN -->
                    <a class="returnForgetTab" href="<?php echo e(route('coverdesk.alert')); ?>"><h6><i class="fa-light fa-left-long fa-lg fa-nm-right"></i> Return</a>
                </div>
                <div class="uk-width-auto uk-flex uk-flex-right@l uk-flex-middle">
                    <!-- EDITOR -->
                    <div class="uk-grid-small" uk-grid>
                        <?php if(!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status !== "c" && $ModelData->cvdalrt_deletion == "0" && empty($ModelData->getTicket->cvdtic_id)): ?>
                            <div class="uk-width-auto uk-flex uk-flex-middle">
                                <div class="custom-button-small custom-icon-red" uk-tooltip="title: Spam">
                                    <a href="#delete-alert" uk-toggle><i class="fa-light fa-trash fa-lg fa-nm"></i></a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="uk-width-auto uk-flex uk-flex-middle">
                                <div class="custom-button-small custom-icon-gray" uk-tooltip="title: Ticket Created">
                                    <button disabled><i class="fa-light fa-trash fa-lg fa-nm"></i></button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <!-- ALERT SUBJECT -->
                <div class="uk-margin uk-padding-small custom-border-radius">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-expand">
                            <h1>
                                <?php if(!empty($ModelData->cvdalrt_subject)): ?>
                                    <?php echo e($ModelData->cvdalrt_subject); ?>

                                <?php else: ?>
                                    Unknown
                                <?php endif; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <h6>
                    Alert created
                    <?php if($ModelData->cvdalrt_created_date_time): ?>
                        <?php echo e(Carbon\Carbon::parse($ModelData->cvdalrt_created_date_time)->diffForHumans()); ?>

                    <?php endif; ?>
                </h6>
                <?php if(!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status == "c" && $ModelData->cvdalrt_deletion == "0"): ?>
                    <span class="uk-label">Assigned with Ticket</span>
                <?php endif; ?>
                <?php if(!empty($ModelData->cvdalrt_deletion) && $ModelData->cvdalrt_deletion == "1"): ?>
                    <span class="uk-label uk-label-danger">Deleted</span>
                <?php elseif(!empty($ModelData->cvdalrt_deletion) && $ModelData->cvdalrt_deletion == "2"): ?>
                    <span class="uk-label uk-label-danger">Spam</span>
                <?php endif; ?>
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
                                            <?php if(!empty($ModelData->cvdalrt_id)): ?>
                                                <?php echo e($ModelData->cvdalrt_id); ?>

                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
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
                                            <?php if(!empty($ModelData->cvdalrt_created_date_time)): ?>
                                                <?php echo e(Carbon\Carbon::parse($ModelData->cvdalrt_created_date_time)->format('j-M-Y h:i A')); ?>

                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($ModelData->getTicket->cvdtic_id)): ?>
                <div class="uk-width-auto@m">
                    <div class="uk-card uk-card-body uk-card-small uk-flex uk-flex-middle uk-flex-center">
                        <a href="<?php echo e(route('coverdesk.ticket.edit', ['TicketID' => $ModelData->getTicket->cvdtic_id])); ?>" class="uk-button uk-button-default" target="_blank" rel="noopener"><i class="fa-solid fa-ticket fa-nm-right uk-text-primary"></i> <?php echo e($ModelData->getTicket->cvdtic_id); ?></a>
                    </div>
                </div>
            <?php else: ?>
                <?php if(!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status !== "c" && $ModelData->cvdalrt_deletion == "0"): ?>
                    <?php if(!empty($ModelData->cvdalrt_status) && $ModelData->cvdalrt_status !== "c" && $ModelData->cvdalrt_deletion == "0" && empty($ModelData->getTicket->cvdtic_id)): ?>
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
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
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
                                            <?php if(!empty($ModelData->cvdalrt_from)): ?>
                                                <?php
                                                    try {
                                                        $cvdalrt_from_descrypt = Crypt::decryptString($ModelData->cvdalrt_from) ?? "";
                                                    } catch (\Exception $e) {
                                                        $cvdalrt_from_descrypt = "";
                                                    }
                                                ?>
                                                <span class="fa-nm-right"><?php echo e($cvdalrt_from_descrypt); ?>;</span>
                                            <?php endif; ?>
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
                                            <?php if(!empty($ModelData->cvdalrt_to) && is_array($ModelData->cvdalrt_to)): ?>
                                                <?php $__currentLoopData = $ModelData->cvdalrt_to; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cvdalrt_to): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        try {
                                                            $cvdalrt_to_descrypt = Crypt::decryptString($cvdalrt_to) ?? "";
                                                        } catch (\Exception $e) {
                                                            $cvdalrt_to_descrypt = "";
                                                        }
                                                    ?>
                                                    <span class="fa-nm-right"><?php echo e($cvdalrt_to_descrypt); ?>;</span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
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
                                            <?php if(!empty($ModelData->cvdalrt_cc) && is_array($ModelData->cvdalrt_cc)): ?>
                                                <?php $__currentLoopData = $ModelData->cvdalrt_cc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cvdalrt_cc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        try {
                                                            $cvdalrt_cc_descrypt = Crypt::decryptString($cvdalrt_cc) ?? "";
                                                        } catch (\Exception $e) {
                                                            $cvdalrt_cc_descrypt = "";
                                                        }
                                                    ?>
                                                    <span class="fa-nm-right"><?php echo e($cvdalrt_cc_descrypt); ?>;</span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="uk-grid-small" uk-grid>
                                <?php $__currentLoopData = $AlertAttachmentModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $AlertAttachmentModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="uk-width-1-5@m uk-width-1-2@s">
                                        <form class="uk-form-stacked" action="<?php echo e(route('coverdesk.alert.download.attachment')); ?>" method="POST" enctype="multipart/form-data">
                                            <?php echo method_field('PUT'); ?>
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="cvdalrtatm_attachment_name" value="<?php echo e($AlertAttachmentModel->cvdalrtatm_attachment_name); ?>">
                                            <input type="hidden" name="cvdalrtatm_attachment_path" value="<?php echo e($AlertAttachmentModel->cvdalrtatm_attachment_path); ?>">
                                            <button type="submit" class="custom-attachment-boarder uk-width-1-1 uk-flex uk-flex-left uk-text-truncate">
                                                <div class="uk-padding">
                                                    <i class="fa-solid fa-file-pdf fa-nm"></i>
                                                    <?php if(!empty($AlertAttachmentModel->cvdalrtatm_attachment_name)): ?>
                                                        <?php echo e(Str::limit($AlertAttachmentModel->cvdalrtatm_attachment_name, 30)); ?>

                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-padding custom-padding-message@l custom-padding-message@m uk-overflow-auto">
                            <?php if(!empty($ModelData->cvdalrt_body_html)): ?>
                                <?php echo $ModelData->cvdalrt_body_html; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>
            <li id="tab2">
                <!-- AUDIT LOG -->
                <div class="uk-padding-small">
                    <ul class="StepProgress">
                        <?php $__currentLoopData = $LogAlertModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $LogAlertModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="StepProgress-item is-done">
                                <strong style="color: <?php if(!empty($LogAlertModel->lgcvdalrt_color_code)): ?><?php echo e($LogAlertModel->lgcvdalrt_color_code); ?><?php endif; ?>">
                                    <div class="uk-grid-small" uk-grid>
                                        <div class="uk-width-auto">
                                            <i class="fa-solid fa-<?php if(!empty($LogAlertModel->lgcvdalrt_icon_code)): ?><?php echo e($LogAlertModel->lgcvdalrt_icon_code); ?><?php endif; ?> fa-nm"></i>
                                            <?php if(!empty($LogAlertModel->lgcvdalrt_type)): ?>
                                                <?php echo e($LogAlertModel->lgcvdalrt_type); ?>

                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </strong>
                                <div class="uk-text-small uk-text-muted">
                                    <?php if(!empty($LogAlertModel->lgcvdalrt_created_date_time)): ?>
                                        <?php echo e(Carbon\Carbon::parse($LogAlertModel->lgcvdalrt_created_date_time)->format('j-M-Y h:i A')); ?>

                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($LogAlertModel->lgcvdalrt_event)): ?>
                                    <?php echo e($LogAlertModel->lgcvdalrt_event); ?>

                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                                <?php if(!empty($LogAlertModel->lgcvdalrt_role_type)): ?>
                                    <div class="uk-text-small uk-text-muted">
                                        <?php if($LogAlertModel->lgcvdalrt_role_type == "User"): ?>
                                            <span class="uk-text-primary"><i class="fa-solid fa-user-tie fa-nm"></i> Created by User</span>
                                        <?php elseif($LogAlertModel->lgcvdalrt_role_type == "Client"): ?>
                                            <span class="uk-text-warning"><i class="fa-solid fa-user fa-nm"></i> Created by Client</span>
                                        <?php elseif($LogAlertModel->lgcvdalrt_role_type == "System"): ?>
                                            <span class="uk-text-danger"><i class="fa-solid fa-robot fa-nm"></i> Created by System</span>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <form class="PreventDoubleForm" action="<?php echo e(route('coverdesk.ticket.store')); ?>" method="POST">
                <input type="hidden" name="cvdtic_channel" value="Alert">
                <input type="hidden" name="cvdtic_custody_id" value="<?php echo e(Auth::user()->_id); ?>">
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
                                <?php if(!empty(Auth::user()->name) && !empty(Auth::user()->stfusr_last_name)): ?>
                                    <input class="uk-input" type="text" value="<?php echo e(Auth::user()->name.' '.Auth::user()->stfusr_last_name); ?>" disabled>
                                <?php elseif(!empty(Auth::user()->name)): ?>
                                    <input class="uk-input" type="text" value="<?php echo e(Auth::user()->name); ?>" disabled>
                                <?php elseif(!empty(Auth::user()->stfusr_last_name)): ?>
                                    <input class="uk-input" type="text" value="<?php echo e(Auth::user()->stfusr_last_name); ?>" disabled>
                                <?php else: ?>
                                    <input class="uk-input" type="text" value="UNKNOWN" disabled>
                                <?php endif; ?>
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

<?php $__env->stopSection(); ?>

<!---------------------------------------------------------------------------------------------------------------------------------------------->

<?php $__env->startSection('master.script'); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\20241115 - dash.covertech.com.my (Alert Only)\resources\views/layouts/coverdesk/alert/edit.blade.php ENDPATH**/ ?>