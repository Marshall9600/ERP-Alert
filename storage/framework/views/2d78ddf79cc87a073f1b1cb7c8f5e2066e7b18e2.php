
<?php $__env->startSection('master.content'); ?>

<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->
<div class="uk-padding-small">
    <div class="uk-card-default">
        <div class="uk-card uk-card-body uk-card-small">
            <h5 class="custom-text-bakbakone"><i class="fa-light fa-bell fa-lg fa-nm"></i> ALERT</h5>
        </div>
        <div class="uk-card uk-card-body uk-card-small">
            <div id="refreshCoverdeskAlertCount" class="uk-flex uk-flex-center">
                <div class="uk-grid-medium uk-grid-divider" uk-grid>
                    <?php if(empty($getOverallFilter) || $getOverallFilter == "active"): ?>
                        <div>
                            <span class="uk-text-maroon"><i class="fa-solid fa-sparkles fa-nm"></i> New: </span>
                            <?php if(!empty($TotalNewCount) && $TotalNewCount !== "0"): ?>
                                <span class="uk-margin-small-left custom-text-bakbakone"><?php echo e($TotalNewCount); ?></span>
                            <?php elseif(empty($TotalNewCount) || $TotalNewCount == "0"): ?>
                                <span class="uk-margin-small-left">0</span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <span class="custom-text-bakbakone">Total Active: </span>
                            <?php if(!empty($TotalActiveCount) && $TotalActiveCount !== "0"): ?>
                                <span class="uk-margin-small-left custom-text-bakbakone"><?php echo e($TotalActiveCount); ?></span>
                            <?php elseif(empty($TotalActiveCount) || $TotalActiveCount == "0"): ?>
                                <span class="uk-margin-small-left">0</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($getOverallFilter) && $getOverallFilter == "all"): ?>
                        <div>
                            <span class="uk-text-maroon"><i class="fa-solid fa-sparkles fa-nm"></i> New: </span>
                            <?php if(!empty($TotalNewCount) && $TotalNewCount !== "0"): ?>
                                <span class="uk-margin-small-left custom-text-bakbakone"><?php echo e($TotalNewCount); ?></span>
                            <?php elseif(empty($TotalNewCount) || $TotalNewCount == "0"): ?>
                                <span class="uk-margin-small-left">0</span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <span class="uk-text-primary"><i class="fa-solid fa-arrows-retweet fa-nm"></i> Converted: </span>
                            <?php if(!empty($TotalConvertedCount) && $TotalConvertedCount !== "0"): ?>
                                <span class="uk-margin-small-left custom-text-bakbakone"><?php echo e($TotalConvertedCount); ?></span>
                            <?php elseif(empty($TotalConvertedCount) || $TotalConvertedCount == "0"): ?>
                                <span class="uk-margin-small-left">0</span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <span class="custom-text-bakbakone">Overall: </span>
                            <?php if(!empty($TotalOverallCount) && $TotalOverallCount !== "0"): ?>
                                <span class="uk-margin-small-left custom-text-bakbakone"><?php echo e($TotalOverallCount); ?></span>
                            <?php elseif(empty($TotalOverallCount) || $TotalOverallCount == "0"): ?>
                                <span class="uk-margin-small-left">0</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="uk-card uk-card-body uk-card-small">
            <div class="uk-flex uk-flex-left custom-margin-xsmall-bottom">
                <div class="custom-button-switch">
                    <form class="custom-inline-form" action="<?php echo e(route('coverdesk.alert')); ?>" method="GET">
                        <input name="getOverall" type="hidden" value="active">
                        <button class="uk-button uk-button-small <?php if(empty($getOverallFilter) || $getOverallFilter == "active"): ?> custom-button-active <?php endif; ?>" type="submit">Active</button>
                    </form>
                    <form class="custom-inline-form" action="<?php echo e(route('coverdesk.alert')); ?>" method="GET">
                        <input name="getOverall" type="hidden" value="all">
                        <button class="uk-button uk-button-small <?php if($getOverallFilter == "all"): ?> custom-button-active <?php endif; ?>" type="submit">All</button>
                    </form>
                </div>
            </div>
            <div class="uk-overflow-auto custom-table-border" uk-height-viewport>
                <table class="uk-table uk-table-divider uk-table-middle <?php if(!empty($ModelPaginate) && count($ModelPaginate) !== 0): ?> uk-table-hover <?php endif; ?>">
                    <thead>
                        <tr class="custom-table-header">
                            <th class="uk-text-center">
                                <input type="checkbox" id="checkAllTable">
                            </th>
                            <th class="uk-width-small">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-expand uk-text-truncate">
                                        Created Time
                                    </div>
                                    <div class="uk-width-auto">
                                        <form class="PreventDoubleForm" action="<?php echo e(route('coverdesk.alert')); ?>" method="GET">
                                            <input name="getSort" type="hidden" value="cvdalrt_created_date_time">
                                            <?php if(empty($sortDirection) || $sortDirection == "asc"): ?>
                                                <input name="getDirection" type="hidden" value="desc">
                                                <button type="submit"><i class="fa-solid fa-down fa-nm" uk-tooltip="Ascending"></i></button>
                                            <?php else: ?>
                                                <input name="getDirection" type="hidden" value="asc">
                                                <button type="submit"><i class="fa-solid fa-up fa-nm" uk-tooltip="Descending"></i></button>
                                            <?php endif; ?>
                                            <input name="getOverall" type="hidden" value="<?php echo e($getOverallFilter); ?>">
                                            <input name="getCreatedDateFrom" type="hidden" value="<?php echo e($getCreatedDateFromFilter); ?>">
                                            <input name="getCreatedDateTo" type="hidden" value="<?php echo e($getCreatedDateToFilter); ?>">
                                            <input name="getAlertID" type="hidden" value="<?php echo e($getAlertIDFilter); ?>">
                                            <input name="getStatus" type="hidden" value="<?php echo e($getStatusFilter); ?>">
                                            <input name="getTicket" type="hidden" value="<?php echo e($getTicketFilter); ?>">
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="uk-table-triple">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-expand uk-text-truncate">
                                        Alert ID & Subject
                                    </div>
                                    <div class="uk-width-auto">
                                        <form class="PreventDoubleForm" action="<?php echo e(route('coverdesk.alert')); ?>" method="GET">
                                            <input name="getSort" type="hidden" value="cvdalrt_id">
                                            <?php if(empty($sortDirection) || $sortDirection == "asc"): ?>
                                                <input name="getDirection" type="hidden" value="desc">
                                                <button type="submit"><i class="fa-solid fa-down fa-nm" uk-tooltip="Ascending"></i></button>
                                            <?php else: ?>
                                                <input name="getDirection" type="hidden" value="asc">
                                                <button type="submit"><i class="fa-solid fa-up fa-nm" uk-tooltip="Descending"></i></button>
                                            <?php endif; ?>
                                            <input name="getOverall" type="hidden" value="<?php echo e($getOverallFilter); ?>">
                                            <input name="getCreatedDateFrom" type="hidden" value="<?php echo e($getCreatedDateFromFilter); ?>">
                                            <input name="getCreatedDateTo" type="hidden" value="<?php echo e($getCreatedDateToFilter); ?>">
                                            <input name="getAlertID" type="hidden" value="<?php echo e($getAlertIDFilter); ?>">
                                            <input name="getStatus" type="hidden" value="<?php echo e($getStatusFilter); ?>">
                                            <input name="getTicket" type="hidden" value="<?php echo e($getTicketFilter); ?>">
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="uk-width-small">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-expand uk-text-truncate">
                                        Status
                                    </div>
                                    <div class="uk-width-auto">
                                        <form class="PreventDoubleForm" action="<?php echo e(route('coverdesk.alert')); ?>" method="GET">
                                            <input name="getSort" type="hidden" value="cvdalrt_status">
                                            <?php if(empty($sortDirection) || $sortDirection == "asc"): ?>
                                                <input name="getDirection" type="hidden" value="desc">
                                                <button type="submit"><i class="fa-solid fa-down fa-nm" uk-tooltip="Ascending"></i></button>
                                            <?php else: ?>
                                                <input name="getDirection" type="hidden" value="asc">
                                                <button type="submit"><i class="fa-solid fa-up fa-nm" uk-tooltip="Descending"></i></button>
                                            <?php endif; ?>
                                            <input name="getOverall" type="hidden" value="<?php echo e($getOverallFilter); ?>">
                                            <input name="getCreatedDateFrom" type="hidden" value="<?php echo e($getCreatedDateFromFilter); ?>">
                                            <input name="getCreatedDateTo" type="hidden" value="<?php echo e($getCreatedDateToFilter); ?>">
                                            <input name="getAlertID" type="hidden" value="<?php echo e($getAlertIDFilter); ?>">
                                            <input name="getStatus" type="hidden" value="<?php echo e($getStatusFilter); ?>">
                                            <input name="getTicket" type="hidden" value="<?php echo e($getTicketFilter); ?>">
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="uk-width-small">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-expand uk-text-truncate">
                                        Ticket ID
                                    </div>
                                    <div class="uk-width-auto">
                                        <form class="PreventDoubleForm" action="<?php echo e(route('coverdesk.alert')); ?>" method="GET">
                                            <input name="getSort" type="hidden" value="cvdalrt_ticket_id">
                                            <?php if(empty($sortDirection) || $sortDirection == "asc"): ?>
                                                <input name="getDirection" type="hidden" value="desc">
                                                <button type="submit"><i class="fa-solid fa-down fa-nm" uk-tooltip="Ascending"></i></button>
                                            <?php else: ?>
                                                <input name="getDirection" type="hidden" value="asc">
                                                <button type="submit"><i class="fa-solid fa-up fa-nm" uk-tooltip="Descending"></i></button>
                                            <?php endif; ?>
                                            <input name="getOverall" type="hidden" value="<?php echo e($getOverallFilter); ?>">
                                            <input name="getCreatedDateFrom" type="hidden" value="<?php echo e($getCreatedDateFromFilter); ?>">
                                            <input name="getCreatedDateTo" type="hidden" value="<?php echo e($getCreatedDateToFilter); ?>">
                                            <input name="getAlertID" type="hidden" value="<?php echo e($getAlertIDFilter); ?>">
                                            <input name="getStatus" type="hidden" value="<?php echo e($getStatusFilter); ?>">
                                            <input name="getTicket" type="hidden" value="<?php echo e($getTicketFilter); ?>">
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th>
            
                            </th>
                        </tr>
                        <form class="PreventDoubleForm" action="<?php echo e(route('coverdesk.alert')); ?>" method="GET">
                            <input name="getOverall" type="hidden" value="<?php echo e($getOverallFilter); ?>">
                            <tr class="custom-table-hoverless">
                                <th class="uk-text-center">
                                    
                                </th>
                                <th>
                                    <div class="uk-grid-collapse" uk-grid>
                                        <div class="uk-width-1-2">
                                            <input class="uk-input uk-form-width-xsmall DateTimeInput" name="getCreatedDateFrom" type="text" value="<?php echo e($getCreatedDateFromFilter); ?>" placeholder="From...">
                                        </div>
                                        <div class="uk-width-1-2">
                                            <input class="uk-input uk-form-width-xsmall DateTimeInput" name="getCreatedDateTo" type="text" value="<?php echo e($getCreatedDateToFilter); ?>" placeholder="To...">
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <input class="uk-input" name="getAlertID" type="text" value="<?php echo e($getAlertIDFilter); ?>" placeholder="Search...">
                                </th>
                                <th>
                                    <select class="uk-select" name="getStatus">
                                        <option value="">Select...</option>
                                        <option value="n" <?php if($getStatusFilter == "n"): ?> selected <?php endif; ?>>New</option>
                                        <?php if($getOverallFilter == "all"): ?>
                                            <option value="c" <?php if($getStatusFilter == "c"): ?> selected <?php endif; ?>>Assigned</option>
                                        <?php endif; ?>
                                    </select>
                                </th>
                                <th>
                                    <input class="uk-input" name="getTicketFilter" type="text" value="<?php echo e($getTicketFilter); ?>" placeholder="Search...">
                                </th>
                                <th class="uk-text-center ">
                                    <button type="submit"><i class="fa-light fa-magnifying-glass" uk-tooltip="Search"></i></button>
                                </th>
                            </tr>
                        </form>
                    </thead>
                    <tbody id="tbody">
                        <?php if(!empty($ModelPaginate) && count($ModelPaginate) !== 0): ?>
                            <?php $__currentLoopData = $ModelPaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ModelOne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $RememberRead = "";
                                    if(!empty($ModelOne->cvdalrt_saved_read) && is_array($ModelOne->cvdalrt_saved_read))
                                    {
                                        if(in_array(Auth::user()->_id, $ModelOne->cvdalrt_saved_read))
                                        {
                                            $RememberRead = "1";
                                        }
                                    }
                                ?>
                                <tr class="<?php if($ModelOne->cvdalrt_deletion !== "0"): ?> custom-table-background-red <?php elseif(empty($RememberRead) || $RememberRead !== "1"): ?> custom-table-background-blue uk-text-bold  <?php endif; ?>">
                                    <td class="uk-text-center">
                                        <input type="checkbox" class="checkOneTable" value="<?php echo e($ModelOne->_id); ?>">
                                    </td>
                                    <td onclick="location.href='<?php echo e(route('coverdesk.alert.edit', ['AlertID' => $ModelOne->cvdalrt_id])); ?>'">
                                        <div>
                                            <?php if(!empty($ModelOne->cvdalrt_created_date_time)): ?>
                                                <b><?php echo e(Carbon\Carbon::parse($ModelOne->cvdalrt_created_date_time)->format('l')); ?></b>
                                            <?php else: ?>
                                                <span class="uk-text-small uk-text-muted">N/A</span>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <?php if(!empty($ModelOne->cvdalrt_created_date_time)): ?>
                                                <?php echo e(Carbon\Carbon::parse($ModelOne->cvdalrt_created_date_time)->format('j-M-Y h:i A')); ?>

                                            <?php else: ?>
                                                <span class="uk-text-small uk-text-muted">N/A</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="uk-text-truncate" onclick="location.href='<?php echo e(route('coverdesk.alert.edit', ['AlertID' => $ModelOne->cvdalrt_id])); ?>'">
                                        <div class="uk-grid-small" uk-grid <?php if(!empty($ModelOne->cvdalrt_subject)): ?> uk-tooltip="title:  <?php echo e($ModelOne->cvdalrt_subject); ?>" <?php endif; ?>>
                                            <?php if(empty($RememberRead) || $RememberRead !== "1"): ?>
                                                <div class="uk-width-auto">
                                                    <i class="fa-solid fa-circle fa-2xs uk-text-danger"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="uk-width-expand uk-text-truncate">
                                                <?php if(!empty($ModelOne->cvdalrt_id)): ?>
                                                    <div>
                                                        <span class="uk-text-bold"><?php echo e($ModelOne->cvdalrt_id); ?></span>
                                                    </div>
                                                <?php else: ?>
                                                    <div>
                                                        <span class="uk-text-small uk-text-muted">N/A</span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($ModelOne->cvdalrt_subject)): ?>
                                                    <div>
                                                        <h5><?php echo e(Str::limit($ModelOne->cvdalrt_subject, 60)); ?></h5>
                                                    </div>
                                                <?php else: ?>
                                                    <div>
                                                        <span class="uk-text-small uk-text-muted">N/A</span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($ModelOne->cvdalrt_deletion) && $ModelOne->cvdalrt_deletion == "1"): ?>
                                                    <span class="uk-label uk-label-danger">Deleted</span>
                                                <?php elseif(!empty($ModelOne->cvdalrt_deletion) && $ModelOne->cvdalrt_deletion == "2"): ?>
                                                    <span class="uk-label uk-label-primary">Taken</span>
                                                <?php elseif(!empty($ModelOne->cvdalrt_deletion) && $ModelOne->cvdalrt_deletion == "3"): ?>
                                                    <span class="uk-label uk-label-danger">False Alarm</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="uk-text-truncate" onclick="location.href='<?php echo e(route('coverdesk.alert.edit', ['AlertID' => $ModelOne->cvdalrt_id])); ?>'">
                                        <?php if(!empty($ModelOne->cvdalrt_status)): ?>
                                            <?php if($ModelOne->cvdalrt_status == "n"): ?>
                                                <span class="uk-text-maroon"><i class="fa-solid fa-sparkles fa-nm"></i> New</span>
                                            <?php elseif($ModelOne->cvdalrt_status == "c"): ?>
                                                <span class="uk-text-primary"><i class="fa-solid fa-arrows-retweet fa-nm"></i> Assigned</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="uk-text-small uk-text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="uk-text-truncate">
                                        <?php if(!empty($ModelOne->getTicket->cvdtic_id)): ?>
                                            <?php echo e($ModelOne->getTicket->cvdtic_id); ?>

                                            <?php if(!empty($PagePermission->stfusrrnp_permission['Ticket']['TicketView'])): ?>
                                                <a href="<?php echo e(route('coverdesk.ticket.edit', ['TicketID' => $ModelOne->getTicket->cvdtic_id])); ?>" target="_blank" rel="noopener">
                                                    <i class="fa-solid fa-arrow-up-right-from-square fa-nm"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="uk-text-small uk-text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="uk-text-center ">
                                        <a href="<?php echo e(route('coverdesk.alert.edit', ['AlertID' => $ModelOne->cvdalrt_id])); ?>"><i class="fa-light fa-right-long fa-lg" uk-tooltip="Go in"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="100">
                                    <div class="uk-width-expand uk-flex uk-flex-middle uk-flex-center uk-height-large">
                                        <div class="uk-card uk-card-body uk-width-1-4 uk-text-center">
                                            <i class="fa-light fa-notes fa-9x custom-icon-empty"></i>
                                            <h6>No data can be found!</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="refreshCoverdeskAlertPaginate" class="uk-padding">
            <?php if(!empty($ModelPaginate) && count($ModelPaginate) !== 0): ?>
                <?php echo $__env->make('layouts.pagination', ['paginator' => $ModelPaginate], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- //////////////////////////////////////////// CONTENT //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MODAL //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MODAL //////////////////////////////////////////// -->

<!-- //////////////////////////////////////////// MESSAGE //////////////////////////////////////////// -->
    <!-- ALERT TAKEN -->
    <?php if(\Session::has('coverdesk-alert-delete')): ?>
        <script>
            UIkit.notification({
                message: '<div class="uk-grid uk-grid-small"><div class="uk-width-auto uk-flex uk-flex-middle"><i class="fa-light fa-circle-check fa-xl fa-nm"></i></div><div class="uk-width-expand"><h4>Successfully Deleted!</h4><span>You have successfully deleted the alert.</span></div></div>',
                pos: 'bottom-right',
                status: 'success',
                timeout: 15000,
                sticky: true,
            })
        </script>
    <?php endif; ?>
<!-- //////////////////////////////////////////// MESSAGE //////////////////////////////////////////// -->

<?php $__env->stopSection(); ?>

<!---------------------------------------------------------------------------------------------------------------------------------------------->

<?php $__env->startSection('master.script'); ?>

<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->
    <!-- CLEAR TABS/SWITCHERS -->
    <script>
        localStorage.clear();
    </script>
    
    <!-- TABLE REFRESH -->
    <script>
        $(document).ready(function(){
            function refreshTable() {
                $('#tbody').load(document.URL +  ' #tbody tr');
                $('#refreshCoverdeskAlertCount').load(document.URL + ' #refreshCoverdeskAlertCount > *');
                $('#refreshCoverdeskAlertPaginate').load(document.URL + ' #refreshCoverdeskAlertPaginate > *');
            }
            setInterval(refreshTable, 130000);
        });
    </script>

    <!-- CHECKBOX -->
    <script>
        $('#checkAllTable').change(function () {
            $('.checkOneTable').prop('checked',this.checked);
        });

        $('.checkOneTable').change(function () {
            if ($('.checkOneTable:checked').length == $('.checkOneTable').length){
                $('#checkAllTable').prop('checked',true);
            }
            else {
                $('#checkAllTable').prop('checked',false);
            }
        });
    </script>

    <!-- SELECT 2 -->
    <script>
        $(document).ready(function() {
            // SELECT2
                $('.select2TicketCompany').select2({
                    allowClear: false,
                    tags: true,
                    dropdownParent: $(".select2WorkTicketCompany"),
                    width: "100%",
                });

                $('.select2TicketUser').select2({
                    allowClear: false,
                    tags: true,
                    dropdownParent: $(".select2WorkTicketUser"),
                    width: "100%",
                });
            // SELECT2
        });
    </script>

    <!-- CREATE EXISTING OR NEW USER -->
    <script>
        $('#checkTabNew').hide();
        $('#checkTitleNew').prop('required', false);
        $('#checkFirstNameNew').prop('required', false);
        $('#checkEmailNew').prop('required', false);

        $('#checkRadioExisting').click(function () {
            $('#checkTabExisting').show();
            $('#checkTabNew').hide();
            $('#checkCompanyExisting').prop('required', true);
            $('#checkUserExisting').prop('required', true);
            $('#checkTitleNew').prop('required', false);
            $('#checkFirstNameNew').prop('required', false);
            $('#checkEmailNew').prop('required', false);
        });

        $('#checkRadioNew').click(function () {
            $('#checkTabExisting').hide();
            $('#checkTabNew').show();
            $('#checkCompanyExisting').prop('required', false);
            $('#checkUserExisting').prop('required', false);
            $('#checkTitleNew').prop('required', true);
            $('#checkFirstNameNew').prop('required', true);
            $('#checkEmailNew').prop('required', true);
        });
    </script>

    <!-- FILTER USER BY COMPANY -->
    <script>
        $(document).ready(function () {
            $('.selectCompany').on('change', function () {
                var selectUser = this.value;
                var selectAppended = false;
                $(".selectUser").html('');
                $.ajax({
                    url: "/coverdesk/ticket/store/filter/user",
                    type: "POST",
                    data: {
                        selectUser: selectUser,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (!selectAppended) {
                            $(".selectUser").append('<option value="">Select...</option>');
                            selectAppended = true;
                        }
                        $.each(response.success, function (key, value) {
                            $(".selectUser").append('<option value="' + value._id + '"><?php if(!empty(' + value.cliusr_title + ')): ?>' + value.cliusr_title + '<?php endif; ?> <?php if(!empty(' + value.cliusr_first_name + ')): ?>' + value.cliusr_first_name + '<?php endif; ?> <?php if(!empty(' + value.cliusr_last_name + ')): ?>' + value.cliusr_last_name + '<?php endif; ?> &#40;<?php if(!empty(' + value.cliusr_email + ')): ?>' + value.cliusr_email + '<?php endif; ?>&#41;</option>');
                        });
                    }
                });
            });
        });
    </script>
<!-- //////////////////////////////////////////// SCRIPT //////////////////////////////////////////// -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\20241115 - dash.covertech.com.my (Alert Only)\resources\views/layouts/Coverdesk/Alert/index.blade.php ENDPATH**/ ?>