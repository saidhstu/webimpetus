

<?php require_once (APPPATH.'Views/common/edit-title.php');

$blocks_list = getResultArray("blocks_list", ["webpages_id" => @$webpage->id]);
?>

<div class="white_card_body">
	<div class="card-body">

		<form id="addcat" method="post" action="/webpages/update" enctype="multipart/form-data">

			<input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$webpage->id ?>" />

			<div class="row">
				<div class="col-xs-12 col-md-12">
					<nav>
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Page Editor</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Search Optimisation</a>
							<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Pictures</a>
							<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Page Setup</a>					  
							<a class="nav-item nav-link" id="nav-blocks-tab" data-toggle="tab" href="#nav-blocks" role="tab" aria-controls="nav-blocks" aria-selected="false">Blocks</a>					  

						</div>
					</nav>
					<div class="tab-content py-3 px-3 px-sm-0 col-md-12" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputEmail4">Title*</label>
									<input type="text" class="form-control" value="<?=@$webpage->title?>" id="title" name="title" placeholder="">
								</div>

								<div class="form-group col-md-12">
									<label for="inputEmail4">Sub Title</label>
									<input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="" value="<?=@$webpage->sub_title?>">
								</div>



								<div class="form-group col-md-12">
									<label for="inputPassword4">Body*</label>
									<textarea class="form-control" name="content" id="content" ><?=@$webpage->content?></textarea> 
								</div>


								
								<div class="form-group col-md-12">
									<div ><label for="inputEmail4">Status</label></div>

									<label for="inputEmail4" class="pr_10"><input type="radio" value="1" class="form-control " id="status" name="status" <?=@$webpage->status==1?'checked':''?> placeholder=""> Active</label>

									<label for="inputEmail4"><input type="radio" <?=@$webpage->status==0?'checked':''?> value="0" class="form-control" id="status" name="status" placeholder=""> Inactive</label>
								</div>


							</div>


						</div>
						<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							<div class="form-row">

								<div class="form-group col-md-12">
									<label for="inputEmail4">URL Code*</label>
									<input type="text" class="form-control" id="code" name="code" placeholder="" readonly="readonly" value="<?=@$webpage->code?>" onchange="format_manual_code('Code')">
									<span class="help-block">URL (SEO friendly)</span><br>

									<span class="help-block">
										<input type="checkbox" name="chk_manual" id="chk_manual">
									I want to manually enter code</span>


								</div>


								<div class="form-group col-md-12">
									<label for="inputEmail4">Meta keywords</label>
									<input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="" value="<?=@$webpage->meta_keywords?>">
								</div>

								<div class="form-group col-md-12">
									<label for="inputEmail4">Meta Title</label>
									<input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="" value="<?=@$webpage->meta_title?>">
								</div>



								<div class="form-group col-md-12">
									<label for="inputPassword4">Meta Description</label>
									<textarea class="form-control" name="meta_description"><?=@$webpage->meta_description?></textarea> 
								</div>


							</div>
						</div>
						<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
							<div class="form-row">

								<div class="form-group col-md-12">

								<span class="all-media-image-files">
									<?php 
									$json = @$webpage->custom_assets?json_decode(@$webpage->custom_assets):[]; ?>

								<?php foreach($images as $image){
									if(!empty(@$image)) { ?>
										<img class="img-rounded" src="<?= $image['image'];?>" width="100px">
										<a href="/webpages/rmimg/<?=@$image['id'].'/'.@$webpage->id; ?>" onclick="return confirm('Are you sure?')" class=""><i class="fa fa-trash"></i></a>
										<?php 
									} 

								}
									?>
									</span>

									<div class="form-group col-md-12" id="divfile">

										<label for="inputAddress">Upload</label>
										<div class="uplogInrDiv" id="drop_file_doc_zone">
											<input type="file" name="file[]" class=" fileUpload" id="customFile">
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
						</div>
						<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputState">Choose User</label>
									<select id="uuid" name="uuid" class="form-control">
										<option value="0" selected="">--Selected--</option>
										<?php foreach($users as $row):?>
											<option value="<?= $row['uuid'];?>"><?= $row['name'];?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label for="inputState">Publish Date</label>

									<input id="publish_date" class="form-control" name="publish_date" width="250" type="datepicker"  value="<?=@$webpage->publish_date?>" />

								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="nav-blocks" role="tabpanel" aria-labelledby="nav-blocks-tab">
						<?php
							if(count($blocks_list) > 0){
							?>
							<div class="form-row addresscontainer">
								<?php
									for($jak_i=0; $jak_i<count($blocks_list); $jak_i++){
										$new_id = $jak_i + 1;
								?>
								<div class="form-row col-md-12 each-row" id="  office_address_<?php echo $new_id; ?>">
									<div class="form-group col-md-6">
										<label for="inputEmail4">Code</label>
										<input autocomplete="off" type="text" class="form-control" id="blocks_code<?php echo $new_id; ?>" name="blocks_code[]" placeholder="" value="<?=$blocks_list[$jak_i]['code'] ?>">
									
										<label for="inputEmail4">Title</label>
										<input autocomplete="off" type="text" class="form-control" id="blocks_title<?php echo $new_id; ?>" name="blocks_title[]" placeholder="" value="<?=$blocks_list[$jak_i]['title'] ?>">
									</div>
									<div class="form-group col-md-5">
										<label for="inputEmail4">Text</label>
									
										<textarea class="form-control myClassName" id="blocks_text<?php echo $new_id; ?>" name="blocks_text[]" ><?=$blocks_list[$jak_i]['text'] ?></textarea> 
									</div>
									<input type="hidden" value="<?=$blocks_list[$jak_i]['id'] ?>" id="blocks_id" name="blocks_id[]">
									<?php
										if($jak_i == 0){
									?>
										<div class="form-group col-md-1 change">
											<button class="btn btn-primary bootstrap-touchspin-up add" type="button" style="max-height: 35px;margin-top: 38px;margin-left: 10px;">+</button>
										</div>
									<?php
										}else{
									?>
										<div class="form-group col-md-1 change">
											<button class="btn btn-info bootstrap-touchspin-up deleteaddress" id="deleteRow" type="button" style="max-height: 35px;margin-top: 38px;margin-left: 10px;">-</button>
										</div>
									<?php
										}
									?>
								</div>
								<?php
									}
								?>
							</div>
							
							<input type="hidden" value="<?php echo count($blocks_list); ?>" id="total_blocks" name="total_blocks" />
							
							<?php
								}else{
							?>
								<div class="form-row" id="office_address_1">
									<div class="form-group col-md-6">
										<label for="inputEmail4">Code</label>
										<input autocomplete="off" type="text" class="form-control" id="first_name_1" name="blocks_code[]" placeholder="" value="">
									
										<label for="inputEmail4">Title</label>
										<input autocomplete="off" type="text" class="form-control" id="surname" name="blocks_title[]" placeholder="" value="">
									</div>
									<div class="form-group col-md-5">
										<label for="inputEmail4">Text</label>
									
										<textarea class="form-control myClassName" id="content" name="blocks_text[]" ></textarea> 
									</div>
									<div class="form-group col-md-1 change">
										<button class="btn btn-primary bootstrap-touchspin-up add" type="button" style="max-height: 35px;margin-top: 28px;margin-left: 10px;">+</button>
									</div>
								</div>
								<input type="hidden" value="0" id="contact_id" name="contact_id">
								<div class="form-row addresscontainer">
								
								</div>
								<input type="hidden" value="1" id="total_blocks" name="total_blocks">
							<?php
								}
							?>
						</div>
					</div>

				</div>
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>

<?php require_once (APPPATH.'Views/common/footer.php'); ?>
<script>

CKEDITOR.replaceAll( 'myClassName' ); 
	
var id = "<?=@$webpage->id ?>";
   
   $(document).on('drop', '#drop_file_doc_zone', function(e){
   
       // $("#ajax_load").show();
       console.log(e.originalEvent.dataTransfer);
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
            url: '/webpages/uploadMediaFiles',
            type: 'post',
            dataType: 'json',
            maxNumberOfFiles: 1,
            autoUpload: false,
            success: function(result) {

                $("#ajax_load").hide();
                if (result.status == '1') {
                    $(".all-media-image-files").append(result.file_path);
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

   $("#delete_image_logo").on("click", function(e){
      e.preventDefault();
      $(".all-media-image-files").html("");
   })


		// Add the following code if you want the name of the file appear on select
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>
	
	<style>
	.custom-file{
		margin:30px;
	}</style>




<script>
$(document).ready(function() {

var max_fields_limit = 10; //set limit for maximum input fields
var x = $('#total_contacts').val(); //initialize counter for text box
$('.add').click(function(e){ //click event on add more fields button having class add_more_button
  
        
        $('.addresscontainer').append('<div class="form-row col-md-12" id="office_address_'+x+'"><div class="form-group col-md-6">'+
            '<label for="inputSecretKey">Code</label>'+
            '<input type="text" class="form-control" id="blocks_code'+x+'" name="blocks_code[]" placeholder="" value="">'+
       
            '<label for="inputSecretValue">Title</label>'+
            '<input type="text" class="form-control" id="blocks_title'+x+'" name="blocks_title[]" placeholder="" value="">'+
        '</div>'+
        '<div class="form-group col-md-5">'+
            '<label for="inputSecretValue">Text</label>'+
			'<textarea class="form-control myClassName" id="blocks_text'+x+'" name="blocks_text[]" placeholder="" value="" ></textarea> '+
        '</div> <input type="hidden" value="0" id="blocks_id" name="blocks_id[]">'+
        '<div class="form-group col-md-1 change">'+
            '<button class="btn btn-info bootstrap-touchspin-up deleteaddress" id="deleteRow" type="button" style="max-height: 35px;margin-top: 28px;margin-left: 10px;">-</button>'+
        '</div></div>'
        );
        
        
		CKEDITOR.replaceAll( 'myClassName' ); 
    
    $('.deleteaddress').on("click", function(e){ //user click on remove text links
        
        $(this).parent().parent().remove();
        x--;
    })
});   
});
$('.deleteaddress').on("click", function(e){ //user click on remove text links
    
    var current = $(this);
    var blocks_id = current.closest(".each-row").find("#blocks_id").val();
    $.ajax({
        url: baseUrl + "/webpages/deleteBlocks",
        data:{ blocks_id: blocks_id},
        method:'post',
        success:function(res){
            console.log(res)
            current.parent().parent().remove();

        }
    })
   
    x--;
})

</script>