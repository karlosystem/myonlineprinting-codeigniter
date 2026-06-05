<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<?php
	$page_slug = $this->uri->segment(3); if($page_slug == '') { $page_slug = 'HOME'; } if ( isset($title) ) { $page_slug = $title; } if ( isset($page_title) ) { $page_slug = $page_title; } ?> <title>Copy Service:: <?php echo $page_slug; ?>
</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin/niceforms-default.css" media="screen" />


<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/clockp.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/clockh.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/ddaccordion.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/jconfirmaction.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/niceforms.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/jquery.jclock-1.2.0.js.txt" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/general.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/ankit.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/additional-methods.js"></script>

<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='<?php echo base_url();?>assets/images/admin/plus.gif' class='statusicon' />", "<img src='<?php echo base_url();  ?>assets/images/admin/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/timepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/timepicker/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/timepicker/jquery.ui.core.js"></script>
	
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin/timepicker/jquery-ui-1.8.13.custom.css" />
<!------------script for tiny mce--------------->
<script src="<?php echo base_url(); ?>tinymce/tinymce.min.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
	tinymce.init({
		 selector: "textarea#p_desc",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	 	tinymce.init({
		selector:"textarea#p_about",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	 	tinymce.init({
		selector:"textarea#p_artwork",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	 tinymce.init({
		selector:"textarea#p_turnaround",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	  tinymce.init({
		selector:"textarea#p_paper",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	 tinymce.init({
		selector:"textarea#p_cat_about",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	tinymce.init({
		selector:"textarea#p_cat_paper",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	tinymce.init({
		selector:"textarea#p_cat_turnaround",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	tinymce.init({
		selector:"textarea#p_cat_artwork",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	tinymce.init({
		selector:"textarea#p_cat_description",
		theme: "modern",
		width: 340,
		height: 100,
	
	 });
	 tinymce.init({
		selector:"textarea#p_a_about",
		theme: "modern",
		width: 380,
		height: 100,
	
	 });
	  tinymce.init({
		selector:"textarea#sub_description",
		theme: "modern",
		width: 380,
		height: 100,
	
	 });
	
	
	 $('#p_date').datepicker();
});
</script>


<script type="text/javascript">
$(function($) {
    $('.jclock').jclock();
});
</script>
<style>
.statusicon{
display:none;
}
.mce-tinymce{
float:left !important;
}
</style>
<?php
	if ( !isset($admin_main_link) ) {
		$admin_main_link = "";
	}

	$admin_main_link;
	
	global $current_main_link;

	$current_main_link = $admin_main_link;

	function admin_main_link_active($curr_link = "") {
		global $current_main_link; 
		if ( $curr_link == $current_main_link ) {
			echo ' class="current" ';
		}
	}

?>

<body>
<div id="main_container">
	<div class="header">
		<div class="logo">
			<a href="<?php  echo base_url(); ?>admin/admin/home">
				<img src="<?php echo base_url(); ?>assets/images/logo-admin.png"/></a>
		</div>
		<?php if($this->session->userdata('admin_id')){ ?>
		<div class="right_header">
			Bienvenido Admin, <a href="<?php echo base_url(); ?>" target="_blank">Visit site</a> | <a href="<?php  echo base_url()  ?>admin/admin/logout" class="logout">Logout</a>
		</div>
		<?php } ?>
		<div class="jclock">
		</div>
	</div>
	<div class="main_content">
		<div class="menu">
			<ul>
			<?php if($this->session->userdata('admin_id')){ ?>
			
				<li><a  href="<?php echo base_url(); ?>admin/admin/home" <?php admin_main_link_active("MANAGE_ADMIN"); ?>>Admin Home</a></li>
				
				<li><a href="<?php  echo base_url();?>admin/users" <?php admin_main_link_active("MANAGE_USERS"); ?>>Manage Users
				<!--[if IE 7]><!-->
				</a>
				<!--<![endif]-->
				</li>
				<li><a href="javascript:void(0)" <?php admin_main_link_active("MANAGE_PRODUCTS"); ?>>Manage Products
				<!--[if IE 7]><!-->
				</a>
				<!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="<?php echo base_url(); ?>admin/products/manage_products" title="">All Products</a></li>
					<li><a href="<?php echo base_url(); ?>admin/sub_products/manage_subproducts" title="">Sub Products</a></li>
				
					<li><a href="<?php echo base_url(); ?>admin/assign_attributes" title="">Assign Attributes</a></li>
					<li><a href="<?php echo base_url(); ?>admin/pricing/manage_price" title="">Assign Prices</a></li>
					
					
			
				</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>
				<li><a href="javascript:void(0)">Manage Attributes</a>
					<ul>
							<li><a href="<?php echo base_url(); ?>admin/attributes/manage_attributes" title="">Attributes List</a></li>
							<li><a href="<?php echo base_url(); ?>admin/values/manage_values" title="">Attribute Value List</a></li>
			
					</ul>
	
				</li>
				<li><a href="javascript:void(0)" <?php admin_main_link_active("SETTING"); ?>>Settings
				<!--[if IE 7]><!-->
				</a>
				<!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="<?php echo base_url();  ?>admin/admin/change_password" title="">Change Password</a></li>
					<li><a href="<?php echo base_url();  ?>admin/admin/site_setting" title="">Change Credentials</a></li>
					<li><a href="<?php echo base_url();  ?>admin/admin/change_account" title="">Change Account</a></li>
				</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>
				
				
				<li><a href="<?php echo base_url();?>admin/slider">Manage Sliders</a></li>
				<li><a href="<?php echo base_url();?>admin/order">Manage Orders</a></li>
				<li><a href="<?php  echo base_url();  ?>admin/pages">Pages</a></li>
			<?php } else {?>
			<li><span style="color:#fff; font-size:16px;"><b>Admin Panel Login</b></span></li>
			
			<?php } ?>
			</ul>
		</div>
	</div>
	<div class="center_content">
