 <!-- sidebar  -->
<nav class="sidebar mini_sidebar">
    <div class="logo d-flex justify-content-between">
        <?php if(!empty($_SESSION['logo'])) { ?>
        <a class="large_logo" href="/"><img src="<?='data:image/jpeg;base64,'.$_SESSION['logo']?>" alt=""></a>
        <!--<a class="small_logo" href="/"><img src="<?='data:image/jpeg;base64,'.$_SESSION['logo']?>" alt=""></a>-->
		<a class="small_logo" href="/"><img src="/assets/img/smallLogo.png" alt=""></a>
		<?php } ?>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <?php if(empty($_SESSION['permissions'])) { ?><li class="mm-active">
          <a   class="has-arrow" href="/dashboard" aria-expanded="true">
            <div class="nav_icon_small">
                <img src="/assets/img/menu-icon/dashboard.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Dashboard</span>
            </div>
          </a>
        
        </li>
		<?php } else { 
	
		$menu = getWithOutUuidResultArray("menu", [], true, "sort_order");
		$userMenus = getRowArray("users", ["id" => $_SESSION['uuid']])->permissions;
        if($userMenus){
            $userMenus = json_decode($userMenus);
        }
      
        if(isset($_SESSION["menucode"])){

            $menucode = $_SESSION["menucode"];
        }else{
            $menucode = 1;
        }
        // prd($menu);
		foreach($menu as $val) { 

            if(in_array($val['id'], $userMenus)){
                $activeIcon =  $val['icon'];
            
        ?>
			<li><a href="<?php echo $val['link']; ?>" class="<?php if(@$menucode == $val['id'])echo "active";?>"><i class="<?php echo $val['icon']; ?>"></i> <span><?php echo $val['name']; ?> </span></a></li>		
		
		<?php } }
        
        }  
        $_SESSION["menucode"] = 0;?>
    </ul>
</nav>

 <!--/ sidebar  -->

 <style type="text/css">
     
     .footer_iner.text-center {
    display: block;
}
.f_s_12.f_w_400.text_color_1 img {
    width: 130px;
    padding: 15px;
    height: auto;
}
 </style>