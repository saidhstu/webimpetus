<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<?php $customers = $additional_data["customers"]; ?>
    <div class="white_card_body">
        <div class="card-body">
            
            <form id="addcustomer" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
                <div class="form-row">
                  

                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Code</label>
                        <input type="input" class="form-control required" id="code" name="code" placeholder=""  value="<?= @$sales_invoices->code ?>">
                    </div>
                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Subject</label>
                        <input type="input" class="form-control required" id="subject" name="subject" placeholder=""  value="<?= @$sales_invoices->subject ?>">
                    </div>
                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">sales_invoices Content</label>
                        <textarea class="form-control required" id="sales_invoices_content" name="sales_invoices_content" placeholder=""  value=""><?= @$sales_invoices->sales_invoices_content ?></textarea>
                       
                    </div>
                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Comment</label>
                        <textarea row='40' col='40' class="form-control required" id="comment" name="comment" placeholder=""  value=""><?= @$sales_invoices->comment ?></textarea>
                      
                    </div>

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
