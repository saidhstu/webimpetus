<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
    
<div class="white_card_body">
    <div class="card-body">
        
        <form id="addcustomer" method="post" action="/customers/update" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group required col-md-4">
                    <label for="selectCustomer">Company Name</label>
                    <input type="text" class="form-control required" id="company_name" name="company_name" placeholder=""  value="<?= @$customer->company_name ?>">
                </div>

                  

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Account No</label>
                    <input type="text" class="form-control required" id="acc_no" name="acc_no" placeholder=""  value="<?= @$customer->acc_no ?>">
                </div>
                <div class="form-check col-md-1">
                </div>
                <div class="form-check checkbox-section col-md-3">
                    <div class = "checkbox-label" >

                    <input class="form-check-input" type="checkbox" name="status" id="status"  <?php if(@$customer->status == "1"){echo 
                        "checked"; }?> value="<?php echo @$customer->status; ?>" >
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        Inactive
                    </label>
                    </div>
                </div>
            </div>
                
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4"> Contact First Name</label>
                    <input type="text" class="form-control" id="company_name" name="contact_firstname" placeholder=""  value="<?= @$customer->contact_firstname ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Contact Last Name</label>
                    <input type="text" class="form-control" id="contact_lastname" name="contact_lastname" placeholder=""  value="<?= @$customer->contact_lastname ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4"> Address 1</label>
                    <input type="text" class="form-control" id="address1" name="address1" placeholder=""  value="<?= @$customer->address1 ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Address 2</label>
                    <input type="text" class="form-control" id="address2" name="address2" placeholder=""  value="<?= @$customer->address2 ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder=""  value="<?= @$customer->city ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder=""  value="<?= @$customer->country ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4"> Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder=""  value="<?= @$customer->postal_code ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder=""  value="<?= @$customer->phone ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Website</label>
                    <input type="text" class="form-control" id="website" name="website" placeholder=""  value="<?= @$customer->website ?>">
                </div>

                <div class="form-check col-md-1">
                </div>
                <div class="form-check checkbox-section col-md-3">
                    <div class = "checkbox-label" >

                    <input class="form-check-input" name="supplier" id="supplier" value="<?php echo @$customer->supplier; ?>" type="checkbox" <?php if(@$customer->status == "1"){echo 
                        "checked"; }?>>
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        Suppier
                    </label>
                    </div>
                </div>
            </div>
                
                <div class="form-group ">
                    <label for="inputEmail4">Email</label>
                    <input type="text" class="form-control email" id="email" name="email" placeholder=""  value="<?= @$customer->email ?>">
                </div>
                <input type="hidden" class="form-control" name="id" placeholder="" value="<?= @$customer->id ?>" />


            
            <div class="form-row">
                    <div class="form-group col-md-12">
                    <label for="inputPassword4">Notes</label>
                    <textarea class="form-control" name="notes" ><?= @$customer->notes ?></textarea> 
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