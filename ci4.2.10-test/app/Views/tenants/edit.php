<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<div class="white_card_body">
    <div class="card-body">
        
        <form id="addcat" method="post" action="<?php echo $actionUrl; ?>" enctype="multipart/form-data">
            <div class="form-row">

                <div class="form-group required col-md-4">
                    <label for="inputState">Choose User</label>
                    <select id="uuid" name="uuid" class="form-control required dashboard-dropdown">
                        <option value="" selected="">--Selected--</option>
                      <?php foreach($users as $row):?>
                        <option value="<?= $row['uuid'];?>" <?=($row['uuid']== @$tenant->uuid)?'selected':'' ?>><?= $row['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>


                <div class="form-group col-md-4">
                    <label for="inputState">Choose Service</label>
                    <select id="sid" name="sid[]" multiple class="form-control js-example-basic-multiple">                                            
                <?php foreach($services as $row):?>
                        <option value="<?= $row['id'];?>" <?=(in_array($row['id'],$tservices))?'selected':'' ?>><?= $row['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>


                <div class="form-group required col-md-4">
                    <label for="inputEmail4">Name</label>
                    <input type="text" class="form-control required" id="name" name="name" placeholder="" value="<?=@$tenant->name ?>">
                  </div>
                  <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$tenant->id ?>" />
             
                
            </div>
            
            <div class="form-row">
                   <div class="form-group  required col-md-4">
                    <label for="inputPassword4">Address</label>
                    <input type="address" class="form-control required" id="address" name="address" placeholder=""  value="<?=@$tenant->address ?>">
                </div>
                  <div class="form-group required col-md-4">
                    <label for="inputPassword4">Contact Name</label>
                    <input type="text" class="form-control required" id="contact_name" name="contact_name" placeholder=""  value="<?=@$tenant->contact_name ?>">
                </div>
                <div class="form-group required col-md-4">
                    <label for="inputAddress">Contact Email</label>
                    <input type="email" class="form-control required email" id="contact_email" name="contact_email" placeholder=""  value="<?=@$tenant->contact_email ?>">                                       
                </div>
            </div>

              <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputPassword4">Notes</label>
                  <textarea class="form-control" name="notes" ><?=@$tenant->notes ?></textarea> 
                </div>
                
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


 <?php require_once (APPPATH.'Views/common/footer.php'); ?>
