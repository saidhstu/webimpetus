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
                            <h3 class="f_s_25 f_w_700 dark_text mr_30" >Change Password </h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Change Password</li>
                            </ol>
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
                               
                                <form action="/dashboard/savepwd" method="post" id="userform">
								
								<div class="form-row">
                                         <div class="form-group col-md-12">
                                            <label for="inputPassword4">Old Password</label>
                                            <input type="password" class="form-control" name="opassword" placeholder="">
                                        </div>                                        
                                    </div>
									
									
									<div class="form-row">
                                         <div class="form-group col-md-12">
                                            <label for="inputPassword4">New Password</label>
                                            <input type="password" id="npassword" class="form-control" name="npassword" placeholder="">
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
      opassword: {
        required: true,
      }, 
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
</script>