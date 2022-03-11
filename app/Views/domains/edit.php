<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
                       
<div class="white_card_body">
    <div class="card-body">
        <form id="addcat" method="post" action="/domains/update" enctype="multipart/form-data">
            <div class="form-row">
            
            <div class="form-group required col-md-12">
                    <label for="inputState">Choose User</label>
                    <select id="uuid" name="uuid" class="form-control required">
                        <option value="" selected="">--Selected--</option>
                        <?php foreach($users as $row):?>
                        <option value="<?= $row['uuid'];?>" <?=($row['uuid']==@$domain->uuid)?'selected':'' ?>><?= $row['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                
                
                <div class="form-group required col-md-12">
                    <label for="inputState">Choose Service</label>
                    <select id="sid" name="sid" class="form-control required">
                        <option value="" selected="">--Selected--</option>
                        <?php foreach($services as $row):?>
                        <option value="<?= $row['id'];?>" <?=($row['id']==@$domain->sid)?'selected':'' ?>><?= $row['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                
                <div class="form-group required col-md-12">
                    <label for="inputEmail4">Name</label>
                    <input type="text" class="form-control required" id="title" name="name" placeholder=""  value="<?=@$domain->name ?>">
                    
                    <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$domain->id ?>" />
                </div>

                    <div class="form-group col-md-12">
                    <label for="inputAddress">Upload</label>
                    <?php if(!empty(@$domain->image_logo)) { ?>
                    <img src="<?=@$domain->image_logo;?>" width="100px">
                        <a href="/domains/deleteImage/<?=@$domain->id ?>"  onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                <?php } ?>
                    <div class="uplogInrDiv">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
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
            
            <div class="form-row">
                    <div class="form-group col-md-12">
                    <label for="inputPassword4">Notes</label>
                    <textarea class="form-control" name="notes" ><?=@$domain->notes ?></textarea> 
                </div>
                
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<!-- main content part end -->

<?php require_once (APPPATH.'Views/common/footer.php'); ?>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
