<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<?php 
$projects = getResultArray("projects");
$customers = getResultArray("customers");
 ?>
    <div class="white_card_body">
        <div class="card-body">
            
            <form id="addcustomer" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" placeholder="" value="<?= @$task->id ?>" />
                <div class="row">

                    <div class=" col-md-6">
                    <!-- <?php if(isset($task->id))echo "readonly"?> -->
                    <div class="form-group ">
                        <label for="inputEmail4">Task ID <span class="required"></span></label>
                        <input readonly autocomplete="off" type="input" class="form-control " id="task_id" name="task_id" placeholder=""  value="<?= @$task->task_id ?>">
                    </div>
                    <div class="form-group   ">
                        <label for="inputEmail4">Task Name <span class="required">*</span></label>
                        <input autocomplete="off" type="input" class="form-control required" id="name" name="name" placeholder=""  value="<?= @$task->name ?>">
                    </div>

                    <div class="form-group   ">
                        <label for="inputEmail4">Reported By <span class="required">*</span></label>
                        <select id="reported_by" name="reported_by" class="form-control required dashboard-dropdown">
                            <option value="" selected="">--Selected--</option>
                            <?php foreach($customers as $row):?>
                            <option value="<?= $row['id'];?>" <?php if($row['id'] == @$task->reported_by){ echo "selected"; }?>><?= $row['company_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                    <div class="form-group   ">
                        <label for="inputEmail4">Project Name <span class="required">*</span></label>
                        <select id="projects_id" name="projects_id" class="form-control required dashboard-dropdown">
                            <option value="" selected="">--Selected--</option>
                            <?php foreach($projects as $row):?>
                            <option value="<?= $row['id'];?>" <?php if($row['id'] == @$task->projects_id){ echo "selected"; }?>><?= $row['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    

               
                    <div class="form-group  ">
                        <label for="inputEmail4">Task Start Date</label>
                        <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder=""  value="<?= render_date(@$task->start_date) ?>">
                    </div>
                    <div class="form-group  ">
                        <label for="inputEmail4">Task End Date</label>
                        <input type="text" class="form-control datepicker" id="end_date" name="end_date" placeholder=""  value="<?= render_date(@$task->end_date) ?>">
                    </div>

                    </div>
                    <div class="form-group col-md-6">

                
                    <div class="form-group  ">
                        <label for="inputEmail4"> Task Estimated Hour</label>
                        <input type="number" class="form-control" id="estimated_hour" name="estimated_hour" placeholder=""  value="<?= @$task->estimated_hour ?>">
                    </div>

                    <div class="form-group  ">
                        <label for="inputEmail4"> rate</label>
                        <input type="number" class="form-control" id="rate" name="rate" placeholder=""  value="<?= @$task->rate ?>">
                    </div>

                    <div class="form-group   ">
                        <label for="inputEmail4">Status</label>
                        <select id="status" name="status" class="form-control  dashboard-dropdown">
                            <option value="" selected="">--Selected--</option>
                            <option value="assigned" <?php if("assigned" == @$task->status){ echo "selected"; }?>>
                        
                            Assigned
                        </option>
                        </select>
                    </div>

                    <div class="form-group   ">
                        <label for="inputEmail4">Assigned To <span class="required">*</span></label>
                        <select id="assigned_to" name="assigned_to" class="form-control required dashboard-dropdown">
                            <option value="" selected="">--Selected--</option>
                            <?php foreach($customers as $row):?>
                            <option value="<?= $row['id'];?>" <?php if($row['id'] == @$task->assigned_to){ echo "selected"; }?>><?= $row['company_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>


                    <div class="form-group  ">
                        <label for="inputEmail4">Task Active</label>
                        <select name="active" id="active" class="form-control select2">
                            <option value="1" <?php if( @$task->currency == 1)echo "active" ?>>Active</option>
                            <option value="2" <?php if( @$task->currency == 2)echo "active" ?>>Completed</option>
                        </select>
                       
                    </div>
                </div>
                </div>
               

              
                                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
   
<?php require_once (APPPATH.'Views/common/footer.php'); ?>
<!-- main content part end -->

<script>
$(document).on("click", ".form-check-input", function(){
    if($(this).prop("checked") == false){
        $(this).val(0);
    }else{
        $(this).val(1);
    }
});
</script>
