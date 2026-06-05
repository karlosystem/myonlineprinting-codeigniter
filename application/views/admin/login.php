<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<style>
		.error_box {
			width: 517px !important;
		}

		.login_form {
			background: none repeat scroll 0 0 #FFFFFF !important;
			float: left;
			height: auto !important;
			margin: 20px 0 0 145px;
			padding: 0;
			width: 600px;
			border-radius: 6px;
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IN Admin Panel </title>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/niceforms.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/general.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/ankit.js"></script>



	<script type="text/javascript">
		jQuery(document).ready(function() {

			jQuery('#login_form').validate({
				rules: {
					username: {

						required: true
					},
					password: {
						required: true,

					},

				}

			});
		});
	</script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/admin/niceforms-default.css" />

</head>

<body>

	<div id="main_container">




		<div class="login_form" style="background-color:#EFEFEF !important;">

			<h3>Admin Panel Login</h3>

			<!-- <a href="#" class="forgot_pass">Forgot password</a> -->
			<?php
			//debug( $this->session->userdata("success_message"));die;  
			?>

			<?php
			if ($this->session->userdata("error_box")) {
				echo '<div class="error_box">';
				echo $this->session->userdata("success_message");
				echo '</div>';
			}
			$this->session->unset_userdata("success_message");
			$this->session->unset_userdata("error_box");

			?>
			<form method="post" class="contact-form" id="login_form" action="<?php echo base_url(); ?>admin/admin/check_login">

				<fieldset>
					<ol>
						<li>
							<div class="control-group">
								<p>Usuario<span class="red">*</span></p>
								<input type="text" value="" name="username" class="input-xlarge text">
							</div>
						</li>

						<li>
							<p>Password<span class="red">*</span></p>
							<input type="password" class="input-xlarge text" name="password">
						</li>

						<li>
							<div style="margin-left:130px;">
								<span class="bt_green_lft"></span>
								<input type="submit" value="Login" class="submit_btn" />
								<span class="bt_green_r"></span>
							</div>
						</li>

					</ol>

				</fieldset>

			</form>
		</div>
	</div>




	</div>