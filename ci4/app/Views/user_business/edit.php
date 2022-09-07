<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
                       
<div class="white_card_body">
    <div class="card-body">

        <form action="/user_business/update" method="post"  id="userform">
       
            
            <div class="form-row">
                <div class="form-group col-md-12">
                        <label for="inputState">Users</label>
                        <select id="user_id" name="user_id" class="form-control select2">                                            
                            <?php 

                            foreach($allUsers as $row):?>
                            <option value="<?= $row->id;?>" <?php  
                            if($row->id == @$result[0]->user_id){ echo 'selected'; }?>><?= $row->name; ?></option>
                            <?php endforeach;?>
                        </select>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo @$result[0]->id; ?>" />
            <?php
                $arr = json_decode(@$result[0]->user_business_id);
                                    

            ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                        <label for="inputState">All Business</label>
                        <select id="user_business_id" name="user_business_id[]" multiple class="form-control select2">                                            
                            <?php 
                      
                            foreach($userBusiness as $row):?>
                            <option value="<?= $row->uuid;?>" <?php  
                           if($arr && in_array($row->uuid, $arr)){ echo "selected"; }?>><?= $row->name; ?></option>
                            <?php endforeach;?>
                        </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    

    </div>
</div>
 
<?php require_once (APPPATH.'Views/common/footer.php'); ?>
<!-- main content part end -->

