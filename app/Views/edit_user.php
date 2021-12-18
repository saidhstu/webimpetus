<?php include('common/header.php'); ?>
<!-- main content part here -->
 

<?php include('common/sidebar.php'); ?>

<section class="main_content dashboard_part large_header_bg">
       <?php include('common/top-header.php'); ?> 
   
<div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30" >Users </h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                        <div class="page_title_right">
                           <a href="/users" class="btn btn-primary"><i class="fa fa-table"></i> User List</a>
                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="row ">

                <div class="col-lg-12">
				
				<?php 
				// Display Response
				if(session()->has('message')){
				?>
				<div class="alert <?= session()->getFlashdata('alert-class') ?>">
				   <?= session()->getFlashdata('message') ?>
				</div>
				<?php
				}
				?>
                    <div class="white_card card_height_100 mb_30">
                       
                        <div class="white_card_body">
                            <div class="card-body">
                               
                                <form action="/users/update" method="post"  id="userform">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="" value="<?=$user->name ?>" />
											<input type="hidden" class="form-control" name="id" placeholder="" value="<?=$user->id ?>" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder=""  value="<?=$user->email ?>">
                                        </div>
                                       
                                    </div>
                                   
                                    <div class="form-row">
                                         <!--div class="form-group col-md-6">
                                            <label for="inputPassword4">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="">
                                        </div-->
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder=""  value="<?=$user->address ?>">                                       
                                        </div>
                                    </div>

                                     <div class="form-row">
                                         <div class="form-group col-md-12">
                                            <label for="inputPassword4">Notes</label>
                                          <textarea class="form-control" name="notes"><?=$user->notes ?></textarea> 
                                        </div>
                                       
                                    </div>
									
									<div class="form-row">
    									<div class="form-group col-md-12">
                                                <label for="inputState">Set Permissions</label>
                                                <select id="sid" name="sid[]" multiple class="form-control js-example-basic-multiple">                                            
    												<?php 
    												
    												$arr = json_decode($user->permissions);
    												foreach($menu as $row):?>
                                                    <option value="<?= $row['id'];?>" <?= in_array($row['id'],$arr)?'selected="selected"':''?>><?= $row['name'];?></option>
                                                   <?php endforeach;?>
                                                </select>
                                        </div>
                                    </div>
                                   


                                    
                                  

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
								
								
								<h3 class="f_s_25 f_w_700 dark_text mr_30" >Change Password </h3>
								
								<form action="/users/savepwd" method="post" id="chngpwd">
								
									
									<div class="form-row">
                                         <div class="form-group col-md-12">
                                            <label for="inputPassword4">New Password</label>
                                            <input type="password" id="npassword" class="form-control" name="npassword" placeholder="">
											<input type="hidden" class="form-control" name="id" placeholder="" value="<?=$user->id ?>" />
                                        </div>                                        
                                    </div>
                                    
                                   
                                    <div class="form-row">
                                         <div class="form-group col-md-12">
                                            <label for="inputPassword4">Confirm Password</label>
                                            <input type="password" class="form-control" name="cpassword" placeholder="">
                                        </div>                                        
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
								
								
                            </div>
                        </div>
                    </div>
                </div>
              

             
               
            </div>
        </div>
    </div>
    </div>
<?php include('common/footer.php'); ?>
</section>
<!-- main content part end -->

<?php include('common/scripts.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
 <script>
   if ($("#userform").length > 0) {
      $("#userform").validate({
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        maxlength: 50,
        email: true,
      }, 
      password: {
        required: true,
      },   
    },
    messages: {
      name: {
        required: "Please enter name",
      },
      email: {
        required: "Please enter valid email",
        email: "Please enter valid email",
        maxlength: "The email name should less than or equal to 50 characters",
        },      
     password: {
        required: "Please enter password",
      },
        
    },
  })
}


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