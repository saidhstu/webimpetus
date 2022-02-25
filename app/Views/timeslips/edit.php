<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<div class="white_card_body">
    <div class="card-body">
        
        <form id="addcat" method="post" action="<?php echo $actionUrl; ?>" enctype="multipart/form-data">
            
            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('task_name'); ?>
                    <span class="redstar">*</span> 
                </div>
                <div class="form-group required col-md-4">
                    <select id="task_name" name="task_name" class="form-control required dashboard-dropdown">
                        <option value="">--Selected--</option>
                        <?php foreach($tasks as $row) { ?>
                        <option value="<?= $row['id'];?>" <?=($row['id']== @$timeslips['task_name'])?'selected':'' ?>><?= $row['name'];?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('week_no'); ?>
                </div>
                <div class="form-group col-md-4">
                    <input id="week_no" name="week_no" class="form-control" value="<?php echo @$timeslips['week_no']; ?>">
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('employee_name'); ?>
                </div>
                <div class="form-group required col-md-4">
                    <select id="employee_name" name="employee_name" class="form-control required dashboard-dropdown">
                        <option value="">--Selected--</option>
                        <?php foreach($employees as $row) { ?>
                        <option value="<?= $row['id'];?>" <?=($row['id']== @$timeslips['employee_name'])?'selected':'' ?>><?= $row['name'];?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_start_date'); ?>
                    <span class="redstar">*</span> 
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <input type="text" id="slip_start_date" name="slip_start_date" class="form-control required datepicker" value="<?php echo render_date(@$timeslips['slip_start_date']); ?>">
                        <span class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </span>
                    </div>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_timer_started'); ?>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <input id="slip_timer_started" name="slip_timer_started" class="form-control timepicker" value="<?php echo @$timeslips['slip_timer_started']; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-clock"></i></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_end_date'); ?>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <input id="slip_end_date" name="slip_end_date" class="form-control datepicker" value="<?php echo render_date(@$timeslips['slip_end_date']); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_timer_end'); ?>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <input id="slip_timer_end" name="slip_timer_end" class="form-control timepicker" value="<?php echo @$timeslips['slip_timer_end']; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-clock"></i></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('break_time'); ?>
                </div>
                <div class="form-group col-md-4">
                    <input type="checkbox" id="break_time" name="break_time" <?php echo @$timeslips['break_time'] == '1' ? 'checked' : ''; ?>>
                    <span>Excude break time</span>
                </div>

            </div>
            <?php 
            $showBreakStartAndEndTimer = 'display: none;';
            if (@$timeslips['break_time'] == 1) {
                $showBreakStartAndEndTimer = '';
            } ?>
            <div class="form-row" style="<?php echo $showBreakStartAndEndTimer; ?>">
                <div class="form-group col-md-3">
                    <?php echo readableFieldName('break_time_start'); ?>
                </div>
                <div class="form-group col-md-3">
                    <div class="input-group">
                        <input id="break_time_start" name="break_time_start" class="form-control timepicker" value="<?php echo @$timeslips['break_time_start']; ?>">
                    </div>
                </div>

                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-2">
                    <?php echo readableFieldName('break_time_end'); ?>
                </div>
                <div class="form-group col-md-3">
                    <div class="input-group">
                        <input id="break_time_end" name="break_time_end" class="form-control timepicker" value="<?php echo @$timeslips['break_time_end']; ?>">
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_hours'); ?>
                </div>
                <div class="form-group col-md-4">
                    <input id="slip_hours" name="slip_hours" class="form-control" value="<?php echo @$timeslips['slip_hours']; ?>">
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_description'); ?>
                    <span class="redstar">*</span>
                </div>
                <div class="form-group col-md-4">
                    <textarea id="slip_description" name="slip_description" class="form-control"><?php echo @$timeslips['slip_description']; ?>"</textarea>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_rate'); ?>
                </div>
                <div class="form-group col-md-4">
                    <input id="slip_rate" name="slip_rate" class="form-control" value="<?php echo @$timeslips['slip_rate']; ?>">
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('slip_timer_accumulated_seconds'); ?>
                </div>
                <div class="form-group col-md-4">
                    <input id="slip_timer_accumulated_seconds" name="slip_timer_accumulated_seconds" class="form-control" value="<?php echo @$timeslips['slip_timer_accumulated_seconds']; ?>">
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php echo readableFieldName('billing_status'); ?>
                </div>
                <div class="form-group required col-md-4">
                    <select id="billing_status" name="billing_status" class="form-control dashboard-dropdown">
                        <option value="">--Selected--</option>
                        <option value="Non chargeable" <?=('Non chargeable'== @$timeslips['billing_status'])?'selected':'' ?>>Non chargeable</option>
                        <option value="chargeable" <?=('chargeable'== @$timeslips['billing_status'])?'selected':'' ?>>chargeable</option>
                        <option value="Billed" <?=('Billed'== @$timeslips['billing_status'])?'selected':'' ?>>Billed</option>
                    </select>
                </div>

            </div>
            
            <div class="form-row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


 <?php require_once (APPPATH.'Views/common/footer.php'); ?>
<script>
    $(function(){
        $("#break_time").change(function(){
            var el = $(this);
            if (el.is(':checked')) {
                el.closest('.form-row').next().slideDown('slow');
            } else {
                el.closest('.form-row').next().slideUp('slow');
            }
        });
    })
</script>
