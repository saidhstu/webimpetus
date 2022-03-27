<?php require_once (APPPATH.'Views/common/edit-title.php');

$businessContacts = getResultArray("business_contacts");

?>
                       
<div class="white_card_body">
    <div class="card-body">
        
        <form id="adddomain" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
            <div class="form-row">
            
               
            <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$businesse->id ?>" />

                <div class=" col-md-6">
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Business No</label>
                        <input autocomplete="off" type="text" disabled="disabled" class="form-control"  value="<?=@$businesse->uuid_business_id ?>" />
                    </div>
                    <div class="form-group required col-md-12">
                        <label for="inputEmail4">Name</label>
                        <input autocomplete="off" type="text" class="form-control required" id="title" name="name" placeholder=""  value="<?=@$businesse->name?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Email</label>
                        <input autocomplete="off" type="text" class="form-control " id="title" name="email" placeholder=""  value="<?=@$businesse->email?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Company Address</label>
                        <input autocomplete="off" type="text" class="form-control " id="title" name="company_address" placeholder=""  value="<?=@$businesse->company_address?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Company Number</label>
                        <input autocomplete="off" type="text" class="form-control " id="title" name="company_number" placeholder=""  value="<?=@$businesse->company_number?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Vat Number</label>
                        <input autocomplete="off" type="text" class="form-control " id="title" name="vat_number" placeholder=""  value="<?=@$businesse->vat_number?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">No Of Shares</label>
                        <input autocomplete="off" type="text" class="form-control " id="title" name="no_of_shares" placeholder=""  value="<?=@$businesse->no_of_shares?>">
                    </div>
                   
                    
                    
                </div>

                <div class=" col-md-6">
                   
                   
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Web Site</label>
                        <input autocomplete="off" type="text" class="form-control " id="title" name="web_site" placeholder=""  value="<?=@$businesse->web_site?>">
                    </div>
                   
                  
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Payment Page Url</label>
                        <input autocomplete="off" type="text" class="form-control " id="payment_page_url" name="payment_page_url" placeholder=""  value="<?=@$businesse->payment_page_url?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Country Code</label>
                        <input autocomplete="off" type="text" class="form-control " id="country_code" name="country_code" placeholder=""  value="<?=@$businesse->country_code?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Telephone No</label>
                        <input autocomplete="off" type="text" class="form-control " id="telephone_no" name="telephone_no" placeholder=""  value="<?=@$businesse->telephone_no?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Trading As</label>
                        <input autocomplete="off" type="text" class="form-control " id="trading_as" name="trading_as" placeholder=""  value="<?=@$businesse->trading_as?>">
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="inputEmail4">Business Contact</label>
                        <select id="business_contacts" name="business_contacts[]" multiple class="form-control select2">                                            
                            <?php 
                            
                            $arr = json_decode(@$businesse->business_contacts);
                           
                            foreach($businessContacts as $row):?>
                            <option value="<?= $row['id'];?>" <?php  if($arr){ echo  in_array($row['id'],$arr)?'selected="selected"':'';}?>>
                            <?= $row['surname']; ?>
                            </option>
                            <?php endforeach;?>
                        </select>
                      
                    </div>
                    <div class="form-group col-md-12">
                   <br><span class="help-block">Default Business</span><br>
                        <span class="help-block">
                            <input type="checkbox" name="default_business" id="default_business" <?= !empty(@$businesse->default_business)?"checked":'';?>>
                        </span>
                    </div>
                    
                </div>

                
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

     
<?php require_once (APPPATH.'Views/common/footer.php'); ?>

<script>

    $("#status").on("change", function(){
        var vall = '<?=base64_encode(@$secret->key_value)?>';
        if($(this).is(":checked")===true){
            $('#key_value').val(atob(vall))
        }else{
            $('#key_value').val("*************")
        }
        //alert($(this).is(":checked"))
    })
</script>
