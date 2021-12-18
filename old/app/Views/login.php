<!DOCTYPE html>
<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Panel</title>

    <link rel="icon" href="img/logo-icon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css" />
       <link rel="stylesheet" href="/assets/vendors/font_awesome/css/all.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="/assets/vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="/assets/css/metisMenu.css">
  <!-- sidebarmenu -->
    <!-- style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/select2.min.css" />
</head>
<body class="crm_body_bg">   


<!-- main content part here -->
 



<section class="loginBlkMain dashboard_part large_header_bg">
      
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
              
                <div class="col-lg-12">
				
                    <div class="mb_30">
                        <div class="row justify-content-center">
                          
                            <div class="col-lg-4">
							
                              
                                <!-- sign_in  -->
                                <div class="modal-content cs_modal loginModel">
                                   
                                    <div class="modal-body">
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
                                        <div class="logo  text-center">
                                            <a class="large_logo" href="/"><img src="<?=$logo->meta_value?'data:image/jpeg;base64,'.$logo->meta_value:'/assets/img/logo.jpg'?>" style="width: 100%;" alt=""></a>
                                        </div>
                                        <br/><br/>
                                        <form id="loginform" method="post" action="/home/login">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn_1 full_width text-center">Log in</button>
                                            <!--div class="text-center">
                                                <a href="/forgot" class="pass_forget_btn">Forget Password?</a>
                                            </div-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- footer part -->
<div class="footer_part_Login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
               <div class="footer_iner text-center">
                  <p>2021 © Tenthmatrix - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> Balinder Walia</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


<!-- footer  -->
<script src="/assets/js/jquery-3.4.1.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
 <script>
   if ($("#loginform").length > 0) {
      $("#loginform").validate({
    rules: {
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
      email: {
        required: "Please enter valid email",
        email: "Please enter valid email",
        maxlength: "The email name should less than or equal to 50 characters",
        },      
     password: {
        required: "Please enter your password",
      },
        
    },
  })
}
</script>
</body>
</html>