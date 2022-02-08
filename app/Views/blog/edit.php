<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<div class="white_card_body">
	<div class="card-body">

		<form id="addcat" method="post" action="/blog/update" enctype="multipart/form-data">

			<input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$content->id ?>" />

			<input type="hidden" class="form-control" name="type" placeholder="" value="2" />

			<div class="row">
				<div class="col-xs-12 col-md-12">
					<nav>
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Page Editor</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Search Optimisation</a>
							<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Pictures</a>
							<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Page Setup</a>					  

						</div>
					</nav>
					<div class="tab-content py-3 px-3 px-sm-0 col-md-9" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputEmail4">Title*</label>
									<input type="text" class="form-control" value="<?=@$content->title?>" id="title" name="title" placeholder="">
								</div>

								<div class="form-group col-md-12">
									<label for="inputEmail4">Sub Title</label>
									<input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="" value="<?=@$content->sub_title?>">
								</div>



								<div class="form-group col-md-12">
									<label for="inputPassword4">Body*</label>
									<textarea class="form-control" name="content" id="content" ><?=@$content->content?></textarea> 
								</div>


								<div class="form-group col-md-12">
									<label for="inputEmail4">Status</label>
								</div>
								<div class="form-group col-md-12">

									<label for="inputEmail4"><input type="radio" value="1" class="form-control" id="status" name="status" <?=@$content->status==1?'checked':''?> placeholder=""> Yes</label>

									<label for="inputEmail4"><input type="radio" <?=@$content->status==0?'checked':''?> value="0" class="form-control" id="status" name="status" placeholder=""> No</label>
								</div>


							</div>


						</div>
						<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							<div class="form-row">

								<div class="form-group col-md-12">
									<label for="inputEmail4">URL Code*</label>
									<input type="text" class="form-control" id="code" name="code" placeholder="" readonly="readonly" value="<?=@$content->code?>" onchange="format_manual_code('Code')">
									<span class="help-block">URL (SEO friendly)</span><br>

									<span class="help-block">
										<input type="checkbox" name="chk_manual" id="chk_manual">
									I want to manually enter code</span>


								</div>



								<div class="form-group col-md-12">
									<label for="inputEmail4">Meta keywords</label>
									<input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="" value="<?=@$content->meta_keywords?>">
								</div>

								<div class="form-group col-md-12">
									<label for="inputEmail4">Meta Title</label>
									<input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="" value="<?=@$content->meta_title?>">
								</div>



								<div class="form-group col-md-12">
									<label for="inputPassword4">Meta Description</label>
									<textarea class="form-control" name="meta_description"><?=@$content->meta_description?></textarea> 
								</div>


							</div>
						</div>
						<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
							<div class="form-row">
								<?php 
								$json = @$content->custom_assets?json_decode(@$content->custom_assets):[]; ?>

								<?php foreach($json as $k=>$val){
									if(!empty(@$content->custom_assets)) { ?>
										<img class="img-rounded" src="<?= 'data:image/jpeg;base64,'.$val;?>" width="100px">
										<a href="/blog/rmimg/<?=@$content->id.'/'.$k ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
										<?php 
									} 

								}
								?>
								<div class="form-group col-md-12" id="divfile">

									<label for="inputAddress">Upload</label>
									<div class="custom-file">
										<input type="file" name="file[]" class="custom-file-input filee" id="customFile">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>


								</div>												


							</div>
						</div>
						<div class=" fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputState">Choose User</label>
									<select id="uuid" name="uuid" class="form-control">
										<option value="0" selected="">--Selected--</option>
										<?php foreach($users as $row):?>
											<option value="<?= $row['uuid'];?>"  <?=($row['uuid']==@$content->uuid)?'selected':''?>><?= $row['name'];?></option>
										<?php endforeach;?>
									</select>
								</div>

								<div class="form-group col-md-12">
									<label for="inputState">Choose Category</label>
									<select id="catid" name="catid[]" multiple class="form-control js-example-basic-multiple">                                            
										<?php foreach($cats as $row):?>
											<option value="<?= $row['id'];?>" <?=in_array($row['id'],$selected_cats)?'selected':''?>><?= $row['name'];?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label for="inputState">Publish Date</label>

									<input id="publish_date" class="form-control" name="publish_date" width="250" type="datetime-local"  value="<?=@$content->publish_date?>" />

								</div>
							</div>
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
		// Add the following code if you want the name of the file appear on select
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
	<script src="/assets/ckeditor/ckeditor.js"></script>

	<script>
		if ($("#addcat").length > 0) {
			$("#addcat").validate({
				ignore : [], rules: {
					title: {
						required: true,
					}, 
					content: {
						required: function(textarea) {
							CKEDITOR.instances[textarea.id].updateElement();
							var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
							return editorcontent.length === 0;
						}
					}
				},
				messages: {
					name: {
						required: "Please enter title",
					},

				},
			})
		}

		if ($("#chk_manual").length > 0) {
			$("#chk_manual").click(function(){
				if($(this).is(':checked')){
					$('#code').attr("readonly",false);
				}
				else
				{
					$('#code').attr("readonly",true);
				}

			});
		}

		var sr = 0;	
		$(document).on('change','.filee', function() { 
	 //alert($(this).val()); 
	 $('#'+$(this).attr('id')).after($(this).val())
	 
	 var inc = sr++; $("#divfile").append('<div class="custom-file"><input type="file" name="file[]" class="custom-file-input filee" id="customFile'+inc+'"><label class="custom-file-label" for="customFile'+inc+'">Choose file</label></div>') });


	</script>



	<script type="text/javascript">
		CKEDITOR.replace( 'content' , {
			filebrowserBrowseUrl: '/assets/ckfinder/ckfinder.html',
			filebrowserUploadUrl: '/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserWindowWidth: '900',
			filebrowserWindowHeight: '700'
		});
	</script>

	<!-- Include Bootstrap Datepicker -->

	<script>
		$('#publish_date').datepicker({ format: "dd/mm/yyyy" });
	</script>
	<style>
	.custom-file{
		margin:30px;
	}</style>