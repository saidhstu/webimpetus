<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<div class="white_card_body">
    <div class="card-body">
        <form id="addservice" method="post" action="/services/update" enctype="multipart/form-data">
        
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Service Detail</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Services Secrets</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0 col-md-12" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="form-row">
                                <div class="form-group required col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input autocomplete="off" autocomplete="off" type="text" class="form-control required" id="name" name="name" placeholder=""  value="<?=@$service->name ?>">
                                    
                                    <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$service->id ?>" />
                                </div>
                                <div class="form-group required col-md-6">
                                    <label for="inputState">Choose User</label>
                                    <select id="uuid" name="uuid" class="form-control required">
                                        <option value="" selected="">--Selected--</option>
                                        <?php foreach($users as $row):?>
                                        <option value="<?= $row['uuid'];?>" <?=($row['uuid']==@$service->uuid)?'selected':'' ?> ><?= $row['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputState">Choose Category</label>
                                    <select id="cid" name="cid" class="form-control">
                                        <option value="" selected="">--Selected--</option>
                                        <?php foreach($category as $row):?>
                                        <option value="<?= $row['id'];?>" <?=($row['id']==@$service->cid)?'selected':'' ?>><?= $row['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="inputState">Choose Tenant</label>
                                    <select id="tid" name="tid" class="form-control">
                                        <option value="" selected="">--Selected--</option>
                                        <?php foreach($tenants as $row):?>
                                        <option value="<?= $row['id'];?>" <?=($row['id']==@$service->tid)?'selected':'' ?>><?= $row['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-row">
                                <div class="form-group required col-md-6">
                                    <label for="inputPassword4">Code</label>
                                    <input autocomplete="off" autocomplete="off" type="text" class="form-control required" id="code" name="code" placeholder=""  value="<?=@$service->code ?>">
                                </div>
                                    <div class="form-group required col-md-6">
                                    <label for="inputPassword4">Notes</label>
                                    <textarea class="form-control required" id="notes" name="notes" placeholder=""><?=@$service->notes ?></textarea>
                                </div>                                      
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Logo Upload</label>
                                       
                                    <span class="all-media-image-files">
                                        <?php if(!empty(@$service->image_logo)) { ?>
                                            <img class="img-rounded" src="<?= @$service->image_logo;?>" width="100px">
                                            <a href="/services/rmimg/image_logo/<?=@$service->id ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        <?php } ?>
                                    </span>
                                    <div class="uplogInrDiv" id="drop_file_doc_zone">
                                        <input type="file" name="file" class="form-control fileUpload  form-control-lg" id="file">
                                        <div class="uploadBlkInr">
                                            <div class="uplogImg">
                                              <img src="/assets/img/fileupload.png" />
                                            </div>
                                            <div class="uploadFileCnt">
                                              <p>
                                                <a href="#">Upload a file </a> file chosen or drag
                                                and drop
                                              </p>
                                              <p>
                                                <span>Video, PNG, JPG, GIF up to 10MB</span>
                                              </p>
                                            </div>
                                        </div>
                                    </div>
                                   
                           
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Brand Upload</label>
                                    <span class="all-media-image-files2">
                                    <?php if(!empty(@$service->image_brand)) { ?>
                                        <img src="<?= @$service->image_brand;?>" width="100px">
                                        <a href="/services/rmimg/image_brand/<?=@$service->id ?>"  onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                    </span>
                                    <div class="uplogInrDiv " id="drop_file_doc_zone2">
                                 
                                        <input type="file" name="file2" class="fileUpload2" id="file2">
                                        <div class="uploadBlkInr">
                                            <div class="uplogImg">
                                              <img src="/assets/img/fileupload.png" />
                                            </div>
                                            <div class="uploadFileCnt">
                                              <p>
                                                <a href="#">Upload a file </a> file chosen or drag
                                                and drop
                                              </p>
                                              <p>
                                                <span>Video, PNG, JPG, GIF up to 10MB</span>
                                              </p>
                                            </div>
                                        </div>
                                    </div> 
                           
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="form-row">
                                <?php /*
                                    for($jak_i=0; $jak_i<count($defaultSecret); $jak_i++){
                                        $new_id = $jak_i + 1;
                                        
                                        if(empty($default_secrets_services[$jak_i]['secrets_default_value']))
                                            $default_secrets_services[$jak_i]['secrets_default_value'] = '';
                                ?>
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Secret Key</label>
                                        <input autocomplete="off" autocomplete="off" type="text" class="form-control" id="default_key_name_<?php echo $new_id; ?>" name="default_key_name[]" readonly placeholder="" value="<?=$defaultSecret[$jak_i]['secrets_default_key'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Secret Value</label>
                                        <input autocomplete="off" type="text" class="form-control" id="default_key_value_<?php echo $new_id; ?>" name="default_key_value[]" placeholder="" value="<?=$default_secrets_services[$jak_i]['secrets_default_value'] ?>">
                                    </div>
                                </div>
                                <?php
                                    }
                                */ ?>
                            </div>
                            
                            <?php
                                if(count($secret_services) > 0){
                            ?>
                            <div class="form-row addresscontainer">
                                <?php
                                    for($jak_i=0; $jak_i<count($secret_services); $jak_i++){
                                        $new_id = $jak_i + 1;
                                ?>
                                <div class="form-row col-md-12" id="office_address_<?php echo $new_id; ?>">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Secret Key</label>
                                        <input autocomplete="off" type="text" class="form-control" id="key_name_<?php echo $new_id; ?>" name="key_name[]" placeholder="" value="<?=$secret_services[$jak_i]['key_name'] ?>">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputEmail4">Secret Value</label>
                                        <input autocomplete="off" type="text" class="form-control" id="key_value_<?php echo $new_id; ?>" name="key_value[]" placeholder="" value="<?=$secret_services[$jak_i]['key_value'] ?>">
                                    </div>
                                    <?php
                                        if($jak_i == 0){
                                    ?>
                                        <div class="form-group col-md-1 change">
                                            <button class="btn btn-primary bootstrap-touchspin-up add " type="button" style="max-height: 35px;margin-top: 28px;margin-left: 10px;">+</button>
                                        </div>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="form-group col-md-1 change">
                                            <button class="btn btn-info bootstrap-touchspin-up deleteaddress" data-id="<?=$secret_services[$jak_i]['id'] ?>" id="deleteRow" type="button" style="max-height: 35px;margin-top: 28px;margin-left: 10px;">-</button>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                            
                            <input type="hidden" value="<?php echo count($secret_services); ?>" id="total_secret_services" name="total_secret_services">
                            
                            <?php
                                }else{
                            ?>
                                <div class="form-row" id="office_address_1">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Secret Key</label>
                                        <input autocomplete="off" type="text" class="form-control" id="key_name_1" name="key_name[]" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputEmail4">Secret Value</label>
                                        <input autocomplete="off" type="text" class="form-control" id="key_value_1" name="key_value[]" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-1 change">
                                        <button class="btn btn-primary bootstrap-touchspin-up add" type="button" style="max-height: 35px;margin-top: 28px;margin-left: 10px;">+</button>
                                    </div>
                                </div>
                                <div class="form-row addresscontainer">
                                
                                </div>
                                <input type="hidden" value="1" id="total_secret_services" name="total_secret_services">
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
                            
                            
            
            <!-- <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">nginx config</label>
                    <textarea autocomplete="off" type="text" class="form-control" id="nginx_config" name="nginx_config" placeholder=""  value=""><?=@$service->nginx_config ?></textarea>
                </div>
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">varnish config</label>
                    <textarea autocomplete="off" type="text" class="form-control" id="varnish_config" name="varnish_config" placeholder=""  value=""><?=@$service->varnish_config ?></textarea>
                </div>                                      
            </div>                                    
            ---> 
            
            <div class="form-row">
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="form-group col-md-2">
                    <button type="button" id="DeployService" class="btn btn-primary page_title_right">Deploy Service</button>
                </div>
                <div class="form-group col-md-2">
                    <button type="button" id="DeleteService" class="btn btn-primary page_title_right">Delete Service</button>
                </div>
            </div>
        </form>
        <?php /*<div class="btndata">
                <button type="button" id="RunCmd" class="btn btn-primary page_title_right">Run CMD</button>
        </div> */ ?>
    </div>
</div>

<?php require_once (APPPATH.'Views/common/footer.php'); ?>


<script>
    // Add the following code if you want the name of the file appear on select

</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
 <script>
   if ($("#addservice").length > 0) {
      $("#addservice").validate({
    rules: {
      name: {
        required: true,
      }, 
      notes: {
        required: true,
      }, 
      code: {
        required: true,
      }, 
      uuid: {
        required: true,
      },        
     /* nginx_config: {
        required: true,
      }, 
      varnish_config: {
        required: true,
      },   */
    },
    messages: {
      name: {
        required: "Please enter name",
      },      
     notes: {
        required: "Please enter notes",
      },      
     code: {
        required: "Please enter code",
      },      
     uuid: {
        required: "Please select user",
      },
        
    },
  })
}
</script>

<script type="text/javascript">
    


var id = "<?=@$service->id ?>";
   
$(document).on('drop', '#drop_file_doc_zone', function(e){
    // $("#ajax_load").show();
        if(e.originalEvent.dataTransfer){
            if(e.originalEvent.dataTransfer.files.length) {
                e.preventDefault();
                e.stopPropagation();
                var i = 0;
                while ( i < e.originalEvent.dataTransfer.files.length ){
                    newUploadDocFiles(e.originalEvent.dataTransfer.files[i], id);
                    i++;
                }
            }   
        }
    }
);
        
$(document).on("change", ".fileUpload", function() {

    for (var count = 0; count < $(this)[0].files.length; count++) {

        newUploadDocFiles($(this)[0].files[count], id);
    }

});



function newUploadDocFiles(fileobj, id) {

    $("#ajax_load").hide();

    var form = new FormData();

    form.append("file", fileobj);
    form.append("mainTable", class_name);
    form.append("id", id);

        $.ajax({
        url: '/services/uploadMediaFiles',
        type: 'post',
        dataType: 'json',
        maxNumberOfFiles: 1,
        autoUpload: false,
        success: function(result) {

            $("#ajax_load").hide();
            if (result.status == '1') {
                $(".all-media-image-files").html(result.file_path);
            } else {
                toastr.error(result.msg);
            }
         },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#ajax_load").hide();
           console.log(textStatus, errorThrown);
        },
        data: form,
        cache: false,
        contentType: false,
        processData: false
       
      
    });

 

}

$(document).on('drop', '#drop_file_doc_zone2', function(e){
    // $("#ajax_load").show();
        if(e.originalEvent.dataTransfer){
            if(e.originalEvent.dataTransfer.files.length) {
                e.preventDefault();
                e.stopPropagation();
                var i = 0;
                while ( i < e.originalEvent.dataTransfer.files.length ){
                    newUploadDocFiles2(e.originalEvent.dataTransfer.files[i], id);
                    i++;
                }
            }   
        }
    }
);
        
$(document).on("change", ".fileUpload2", function() {

    for (var count = 0; count < $(this)[0].files.length; count++) {

        newUploadDocFiles2($(this)[0].files[count], id);
    }

});



function newUploadDocFiles2(fileobj, id) {

    $("#ajax_load").hide();

    var form = new FormData();

    form.append("file", fileobj);
    form.append("mainTable", class_name);
    form.append("id", id);

        $.ajax({
        url: '/services/uploadMediaFiles2',
        type: 'post',
        dataType: 'json',
        maxNumberOfFiles: 1,
        autoUpload: false,
        success: function(result) {

            $("#ajax_load").hide();
            if (result.status == '1') {
                $(".all-media-image-files2").html(result.file_path);
            } else {
                toastr.error(result.msg);
            }
         },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#ajax_load").hide();
           console.log(textStatus, errorThrown);
        },
        data: form,
        cache: false,
        contentType: false,
        processData: false
       
      
    });

 

}

    $('#DeployService').on('click', function () {
        var Status = $(this).val();
        $.ajax({
        url: "/services/deploy_service/<?=@$service->id?>",
        type: "post",
        data: {'data':Status },
        success: function (response) {
            alert(response);


           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    	});
    });
	
    $('#DeleteService').on('click', function () {
        var Status = $(this).val();
        $.ajax({
        url: "/services/delete_service/<?=@$service->id?>",
        type: "post",
        data: {'data':Status },
        success: function (response) {
            alert(response);


           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    	});
    });
	
	
	$(document).ready(function() {

        var max_fields_limit = 10; //set limit for maximum input fields
		var x = $('#total_secret_services').val(); //initialize counter for text box
		$('.add').click(function(e){ //click event on add more fields button having class add_more_button
			// e.preventDefault();
			if(x < max_fields_limit){ //check conditions
				x++; //counter increment
				
				$('.addresscontainer').append('<div class="form-row col-md-12" id="office_address_'+x+'"><div class="form-group col-md-6">'+
												'<label for="inputSecretKey">Secret Key</label>'+
												'<input autocomplete="off" type="text" class="form-control" id="key_name_'+x+'" name="key_name[]" placeholder="" value="">'+
											'</div>'+
											'<div class="form-group col-md-5">'+
												'<label for="inputSecretValue">Secret Value</label>'+
												'<input autocomplete="off" type="text" class="form-control" id="key_value_'+x+'" name="key_value[]" placeholder="" value="">'+
											'</div>'+
											'<div class="form-group col-md-1 change">'+
												'<button class="btn btn-info bootstrap-touchspin-up deleteaddress" id="deleteRow" type="button" style="max-height: 35px;margin-top: 28px;margin-left: 10px;">-</button>'+
											'</div></div>'
											);
				
				
			}
			
			$('.deleteaddress').on("click", function(e){ //user click on remove text links
				e.preventDefault(); 
				$(this).parent().parent().remove();
				x--;
			})
		});   
	});

    $('.deleteaddress').on("click", function(e){ //user click on remove text links
    
        var current = $(this);
        var serviceId = current.attr("data-id");
        $.ajax({
            url: baseUrl + "/services/deleteRow",
            data:{ id: serviceId},
            method:'post',
            success:function(res){
                console.log(res)
                current.parent().parent().remove();

            }
        })

})
    
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
                   
    $("#file2").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings("#file2").addClass("selected").html(fileName);
    });

    $("#delete_image_logo").on("click", function(e){
        e.preventDefault();
        $(".all-media-image-files").html("");
    })
    $("#delete_image_logo2").on("click", function(e){
        e.preventDefault();
        $(".all-media-image-files").html("");
    })
</script>