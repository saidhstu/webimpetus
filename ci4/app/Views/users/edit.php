<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
                       
<div class="white_card_body">
    <div class="card-body">

        <form action="/users/update" method="post"  id="userform">
            <div class="form-row">
                <div class="form-group required  col-md-4">
                    <label for="inputEmail4">Name</label>
                    <input type="text" class="form-control required" name="name" placeholder="" value="<?=@$user->name ?>" />
                </div>
                <input type="hidden" class="form-control " name="id" placeholder="" value="<?=@$user->id ?>" />
                <div class="form-group required col-md-4">
                    <label for="inputPassword4">Email</label>
                    <input type="email" class="form-control required" name="email" placeholder=""  value="<?=@$user->email ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" name="address" placeholder=""  value="<?=@$user->address ?>">
                </div>
                
            </div>
            <div class="form-row">
                    <div class="form-group col-md-12">
                    <label for="inputPassword4">Notes</label>
                    <textarea class="form-control" name="notes"><?=@$user->notes ?></textarea> 
                </div>
                
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                        <label for="inputState">Set User Module Permissions</label>
                        <select id="sid" name="sid[]" multiple class="form-control select2">                                            
                            <?php 
                            
                            $arr = json_decode(@$user->permissions);
                            foreach($menu as $row):?>
                            <option value="<?= $row['id'];?>" <?php  if($arr) echo 
                            in_array($row['id'],$arr)?'selected="selected"':''?>><?= $row['name'];?></option>
                            <?php endforeach;?>
                        </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        
        <h3 class="f_s_25 f_w_700 dark_text mr_30 mt_30" >Change Password </h3>
        
        <form action="/users/savepwd" method="post" id="chngpwd">

            <div class="form-row">
                <div class="form-group  col-md-6">
                    <label for="inputPassword4">New Password</label>
                    <input type="password" id="npassword" class="form-control" name="npassword" placeholder="">
                </div>                                        
                <input type="hidden" class="form-control" name="id" placeholder="" value="<?=@$user->id ?>" />
                <div class="form-group  npassword col-md-6">
                    <label for="inputPassword4">Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" placeholder="">
                </div> 
            </div>

           

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>
 
<?php require_once (APPPATH.'Views/common/footer.php'); ?>
<!-- main content part end -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
 <script>


if ($("#chngpwd").length > 0) {
      $("#chngpwd").validate({
    rules: {       
      npassword: {
        required: true,
      }, 
      cpassword: {
        required: true,
		equalTo : "#npassword"
      }  
    },
    messages: {
      name: {
        required: "Please enter name",
      }
        
    },
  })
}


</script>