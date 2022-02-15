<?php
$business = getAllBusiness();
if(empty($_SESSION['uuid'])){?>
<script>
window.location.href="/";
</script>
<?php
//print_r($_SESSION); die;
}
?><!-- menu  -->
    <div class="container-fluid no-gutters">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="line_icon open_miniSide d-none d-lg-block">
                      <i class="ti-menu"></i>
                    </div>
                    
                    <div class="header_right d-flex  ">
                        <select name="uuid_business_id" id="uuid_business_id" class="form-control dashboard-dropdown">
                            <?php foreach($business as $eachUuid):?>
                            <option value="<?php echo $eachUuid['uuid']?>"<?php if($_SESSION['uuid_business'] == $eachUuid['uuid']) { echo "selected"; } ?>>  <?php echo $eachUuid['name']?></option>
                        
                            <?php endforeach;?>
                        </select>

             
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        
                        <div class="profile_info">
                            <img src="/assets/img/client_img.png" alt="#">
                            <div class="profile_info_iner">
                                <div class="profile_author_name">                                    
                                    <h5><?=!empty($_SESSION['uname'])?$_SESSION['uname']:''?></h5>
                                </div>
                                <div class="profile_info_details">
                                     <span><?=!empty($_SESSION['uemail'])?$_SESSION['uemail']:''?></span>
                                    <a href="/dashboard/chgpwd">Change Password</a>
                                    <a href="/dashboard/settings">Settings</a>
                                    <a href="/home/logout">Log Out </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ menu  -->