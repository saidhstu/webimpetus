<?php require_once(APPPATH . 'Views/common/edit-title.php'); ?>
<?php //$customers = $additional_data["customers"]; 
?>
<div class="white_card_body">
    <div class="row">
        <div class="col-lg-8">
            <div class="card-body">
                <form id="addcustomer" method="post" action=<?php echo "/" . $tableName . "/update"; ?> enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="hidden" class="form-control" name="id" placeholder="" value="<?= @$template->id ?>" />
                        <div class="form-group required col-md-6">
                            <label for="inputEmail4">Code</label>
                            <input type="input" class="form-control required" id="code" name="code" placeholder="" value="<?= @$template->code ?>">
                        </div>
                        <div class="form-group required col-md-6">
                            <label for="inputEmail4">Subject</label>
                            <input type="input" class="form-control required" id="subject" name="subject" placeholder="" value="<?= @$template->subject ?>">
                        </div>
                        <div class="form-group required col-md-12">
                            <label for="inputEmail4">Template Content</label>
                            <textarea class="form-control required" id="template_content" name="template_content" placeholder="" rows="12" column="20" value=""><?= @$template->template_content ?></textarea>
                        </div>
                        <div class="form-group required col-md-6">
                            <label for="inputEmail4">Comment</label>
                            <textarea row='40' col='40' class="form-control required" id="comment" name="comment" placeholder="" value=""><?= @$template->comment ?></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-center bg-light pt-3">
            <div class="card-body">
                <h5>Drag and drop tokens in "Content"</h5>
                <div class="input-group mb-3">
                    <input type="text" name="search-token" class="form-control" placeholder="Search here.." aria-label="Search here.." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary search-token-button" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <ul class="list-group token-list overflow-auto tokenlist">
                    <?php foreach($blocks_lists as $row):?>
                        <li class="list-group-item list-group-item-action dragtoken" aria-current="true">
                            <?= $row['code'];?>
                        </li>
                    <?php endforeach;?>                       
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once(APPPATH . 'Views/common/footer.php'); ?>
<!-- main content part end -->
<script>
    $(document).on("click", ".form-check-input", function() {
        if ($(this).prop("checked") == false) {
            $(this).val(0);
        } else {
            $(this).val(1);
        }
    });
</script>