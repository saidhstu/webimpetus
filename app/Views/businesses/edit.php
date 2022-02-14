<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
                       
<div class="white_card_body">
    <div class="card-body">
        
        <form id="adddomain" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
            <div class="form-row">
            
                <div class="form-group required col-md-12">
                    <label for="inputEmail4">Name</label>
                    <input type="text" class="form-control required" id="title" name="name" placeholder=""  value="<?=@$businesse->name?>">
                </div>
                <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$businesse->id ?>" />

                    
                 
                <div class="form-group col-md-12">
                    <!-- <label for="inputEmail4">Default Business</label> -->
                   
                    <span class="help-block">Default Business</span><br>

                    <span class="help-block">
                        <input type="checkbox" name="default_business" id="default_business">
                    </span>


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
