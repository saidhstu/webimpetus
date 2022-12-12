<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<?php  ?>
    <div class="white_card_body">
        <div class="card-body">
            
            <form id="addcustomer" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
                <div class="form-row">
                   

                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Name</label>
                        <input type="input" class="form-control required" id="name" name="name" placeholder=""  value="<?= @$data->name ?>">
                    </div>
                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Link</label>
                        <input type="input" class="form-control required" id="link" name="link" placeholder=""  value="<?= @$data->link ?>">
                    </div>

                </div>
                <div class="form-row">
                   

                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Icon</label>
                        <input type="input" class="form-control required" id="icon" name="icon" placeholder=""  value="<?= @$data->icon ?>">
                    </div>
                   

                </div>
                    
               
                <input type="hidden" class="form-control" name="id" placeholder="" value="<?= @$data->id ?>" />

                </div>

              

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
