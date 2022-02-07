
     <?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
    <div class="white_card_body">
        <div class="card-body">
            
            <form id="addcat" method="post" action="/categories/update" enctype="multipart/form-data">
                <div class="form-row">
                
                <div class="form-group  col-md-12 required">
                        <label for="inputState" class="control-label">Choose User</label>
                        <select id="uuid" name="uuid" class="form-control required dashboard-dropdown">
                            <option value="" selected="">--Selected--</option>
                            <?php foreach($users as $row):?>
                            <option value="<?= $row['uuid'];?>" <?=($row['uuid']== @$category->uuid)?'selected':'' ?>><?= $row['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group required col-md-12">
                        <label for="inputEmail4">Name</label>
                        <input type="text" class="form-control required" id="title" name="name" placeholder=""  value="<?= @$category->name ?>">
                        
                    </div>
                    
                    <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$category->id ?>" />
                    <div class="form-group col-md-12">
                        <label for="inputAddress">Upload</label>
                        <?php if(!empty(@$category->image_logo)) { ?>
                        <img src="<?= @$category->image_logo;?>" width="150px">
                        <a href="/categories/deleteImage/<?=@$category->id ?>"  onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    <?php } ?>
                        <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    
                    </div>
                    
                </div>
                
                <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputPassword4">Notes</label>
                        <textarea class="form-control" name="notes" ><?=@$category->notes ?></textarea> 
                    </div>
                    
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

                        
<?php require_once (APPPATH.'Views/common/footer.php'); ?>

<!-- main content part end -->

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
	