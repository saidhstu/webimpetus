<?php require_once (APPPATH.'Views/media_list/edit-title.php'); ?>
<div class="white_card_body">
    <div class="card-body">

        <form id="adddomain" method="post" action="/gallery/update" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Code</label>
                    <input type="text" class="form-control" id="title" name="code" value="<?=@$media_list->code?>" placeholder="">
                    <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$media_list->id ?>" />
                </div>

                <div class="form-group col-md-12">
                    <?php if(!empty(@$media_list->name)) { ?>
                        <img src="<?=@$media_list->name?>" width="140px">
                    <?php } ?>
                    <label for="inputAddress">Upload Image</label>
                    <div class="custom-file">

                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>

                </div>


                <div class="form-group col-md-12">
                    <label for="inputEmail4">Status</label>
                </div>
                <div class="form-group col-md-12">

                    <label for="inputEmail4"><input type="radio" value="1" class="form-control" id="status" name="status" <?=@$media_list->status==1?'checked':''?> placeholder=""> Yes</label>

                    <label for="inputEmail4"><input type="radio" <?=@$media_list->status==0?'checked':''?> value="0" class="form-control" id="status" name="status" placeholder=""> No</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


<?php require_once (APPPATH.'Views/common/footer.php'); ?>
