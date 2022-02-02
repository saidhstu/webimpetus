<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<?php $customers = $additional_data["customers"]; ?>
    <div class="white_card_body">
        <div class="card-body">
            
            <form id="addcustomer" method="post" action="/contacts/update" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Client Name</label>
                        <select id="client_id" name="client_id" class="form-control required dashboard-dropdown">
                            <option value="" selected="">--Selected--</option>
                            <?php foreach($customers as $row):?>
                            <option value="<?= $row['id'];?>" <?php if($row['id'] == @$contact->client_id){ echo "selected"; }?>><?= $row['company_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">First Name</label>
                        <input type="text" class="form-control required" id="first_name" name="first_name" placeholder=""  value="<?= @$contact->first_name ?>">
                    </div>

                </div>
                    
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder=""  value="<?= @$contact->surname ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder=""  value="<?= @$contact->title ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4"> Salutation</label>
                        <input type="text" class="form-control" id="saludation" name="saludation" placeholder=""  value="<?= @$contact->saludation ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">News Letter Status</label>
                        <input type="text" class="form-control" id="news_letter_status" name="news_letter_status" placeholder=""  value="<?= @$contact->news_letter_status ?>">
                    </div>
                </div>
                <input type="hidden" class="form-control" name="id" placeholder="" value="<?= @$contact->id ?>" />

                <div class="form-row">
                    <div class="form-group required col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="text" class="form-control required email" id="email" name="email" placeholder=""  value="<?= @$contact->email ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder=""  value="<?= @$contact->password ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Direct Phone</label>
                        <input type="text" class="form-control" id="direct_phone" name="direct_phone" placeholder=""  value="<?= @$contact->direct_phone ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder=""  value="<?= @$contact->mobile ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Direct Fax</label>
                        <input type="text" class="form-control" id="direct_fax" name="direct_fax" placeholder=""  value="<?= @$contact->direct_fax ?>">
                    </div>

                    <div class="form-check col-md-1">
                    </div>
                    <div class="form-check checkbox-section col-md-3">
                        <div class = "checkbox-label" >

                        <input class="form-check-input" name="allow_web_access" id="allow_web_access" value="<?php echo @$contact->allow_web_access; ?>" type="checkbox" <?php if(@$contact->allow_web_access == "1"){echo 
                            "checked"; }?>>
                        <label class="form-check-label" for="flexCheckIndeterminate">
                            Allow WebAccess
                        </label>
                        </div>
                    </div>
                </div>

                
                <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputPassword4">Comments</label>
                        <textarea class="form-control"  id="comments" name="comments" ><?= @$contact->comments ?></textarea> 
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