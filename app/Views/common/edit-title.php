<?php require_once (APPPATH.'Views/common/header.php'); ?>
<!-- main content part here -->

<?php require_once (APPPATH.'Views/common/sidebar.php'); ?>
<section class="main_content dashboard_part large_header_bg">
<?php require_once (APPPATH.'Views/common/top-header.php'); ?>
<div class="main_content_iner overly_inner ">
<div class="container-fluid p-0 ">
    <!-- page title  -->
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left d-flex align-items-center">
                    <h3 class="f_s_25 f_w_700 dark_text mr_30" ><?php
                        if(isset($menuName)){
                            echo ucfirst($menuName);
                        }else{
                            echo render_head_text($tableName);
                        } ?> </h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/<?php echo strtolower($tableName); ?>"><?php if(isset($menuName)){
                            echo ucfirst($menuName);
                        }else{
                            echo render_head_text($tableName);
                        } ?> </a></li>
                    </ol>
                </div>
                <div class="page_title_right">
                    <a href="/<?php echo strtolower($tableName); ?>" class="btn btn-primary"><i class="<?php echo @$activeIcon; ?>"></i> <?php 
                        if(isset($menuName)){
                            echo ucfirst($menuName);
                        }else{
                            echo render_head_text($tableName);
                        } ?></a>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row ">

        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">

            <?php  if(session()->has('message')){ ?>

            <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('message') ?>
            </div>
            <?php } ?>

            <!-- BEGIN LOGIN -->
<div id="ajax_loader" style="position: fixed;
    top: 0px;
    background: rgba(0, 0, 0, 0.25);
    height: 100%;
    width: 100%;
    z-index: 99999;display: none;">
	<img style="position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -16px;
    margin-top: -16px;
    z-index: 9999999;" alt="" src="/assets/img/ajax-loader.gif"?>>
</div>
                                