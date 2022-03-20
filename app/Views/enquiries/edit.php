<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>

<div class="white_card_body">
	<div class="card-body">
		
		<form id="addcat" method="post" action="/enquiries/update" enctype="multipart/form-data">
			
			<input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$enquiries->id ?>" />
			
			<input type="hidden" class="form-control" name="type" placeholder="" value="4" />
			
			<div class="row">
				<div class="col-xs-12 col-md-12">

						<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<div class="form-row">
								<div class="form-group col-md-12 required">
									<label for="inputEmail4">Name</label>
									<input type="text" class="form-control required" value="<?=@$enquiries->name?>" id="name" name="name" placeholder="">
								</div>
								
								<div class="form-group col-md-12 required">
									<label for="inputEmail4">Email</label>
									<input type="text" class="form-control required" id="email" name="email" placeholder="" value="<?=@$enquiries->email?>">
								</div>

								
								
								<div class="form-group col-md-12 required">
									<label for="inputPassword4">Phone</label>
									<input class="form-control required" name="phone" id="phone" <?=@$enquiries->phone?> />
								</div>
								
								
								<div class="form-group col-md-12 ">
									<label for="inputPassword4">Message</label>
									<textarea class="form-control " name="message" id="message" ><?=@$enquiries->message?></textarea> 
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
	

