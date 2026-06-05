<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<?php
	$page_slug = $this->uri->segment(3); if($page_slug == '') { $page_slug = 'HOME'; } if ( isset($title) ) { $page_slug = $title; } if ( isset($page_title) ) { $page_slug = $page_title; } ?> 
	<title>Copy Service:: <?php echo $page_slug; ?>
</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin/niceforms-default.css" media="screen" />


<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
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
			<img src="<?php echo base_url(); ?>assets/images/logo-admin.png" alt="" title="" border="0" /></a>
		</div>
		<?php if($this->session->userdata('admin_id')){ ?>
		<div class="right_header">
			Welcome Admin, 
			<a href="<?php echo base_url(); ?>" target="_blank">Visit site</a> | 
			<a href="<?php  echo base_url()  ?>admin/admin/logout" class="logout">Logout</a>
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
