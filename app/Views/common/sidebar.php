 <!-- sidebar  -->
<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <?php if(!empty($_SESSION['logo'])) { ?>
        <a class="large_logo" href="/"><img src="<?='data:image/jpeg;base64,'.$_SESSION['logo']?>" alt=""></a>
        <a class="small_logo" href="/"><img src="<?='data:image/jpeg;base64,'.$_SESSION['logo']?>" alt=""></a>
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
		$menu = $_SESSION['permissions'];
		
		//echo '<pre>'; print_r($menu); die;
		foreach($menu as $val) { ?>
			<li><a href="<?php echo $val['link']; ?>" class=""><i class="fa fa-table"></i> <span><?php echo $val['name']; ?> </span></a></li>		
		
		<?php } }  ?>
       <?php /* <li><a href="/categories" class=""><i class="fa fa-table"></i> <span>Categories</span></a></li>
         <li><a href="/users" class=""><i class="fa fa-users"></i> <span>Users</span></a></li>
        <li><a href="/tenants" class=""><i class="fa fa-building"></i> <span>Tenants</span></a></li>
        
        <li><a href="/services" class=""><i class="fa fa-wrench"></i> <span>Services</span></a></li>
        <li><a href="/domains" class=""><i class="fa fa-globe"></i> <span>Domains</span></a></li>
		
		<li><a href="/webpages" class=""><i class="fa fa-table"></i> <span>Web Pages</span></a></li>
		<li><a href="/blog" class=""><i class="fa fa-wrench"></i> <span>Blog</span></a></li>
		<li><a href="/blog/blogcomments" class=""><i class="fa fa-globe"></i> <span>Blog Comments</span></a></li>
        <li><a href="/jobs" class=""><i class="fa fa-users"></i> <span>Job Vacancies</span></a></li>
        <li><a href="/jobapps" class=""><i class="fa fa-building"></i> <span>Job Applications</span></a></li>        
		<li><a href="/gallery" class=""><i class="fa fa-globe"></i> <span>Image Gallery</span></a></li>
		<li><a href="/blocks" class=""><i class="fa fa-globe"></i> <span>Blocks</span></a></li>
		<li><a href="/enquiries" class=""><i class="fa fa-globe"></i> <span>Enquiries</span></a></li> */ ?>
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