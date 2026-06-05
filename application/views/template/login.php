<!--Main index : End-->
<main class="main">
	<section class="header-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 hidden-xs">
					<h1 class="mh-title">Login</h1>
				</div>
				<div class="breadcrumb-w col-sm-9">
					<span class="hidden-xs">You are here:</span>
					<ul class="breadcrumb">
						<li>
							<a href="<?php echo base_url(); ?>">Home</a>
						</li>
						<li>
							<span>Login</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section id="checkout" class="pr-main">
		<div class="container">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="cart-top">
					<img alt="Cart top banner" src="<?php echo base_url(); ?>assets/images/banner/cart/top-banner.jpg">
				</div>
			</div>

			<div class="cart-view-top">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<h1>Please login to access your account</h1>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 right">
					<h1><a href="<?php echo base_url(); ?>users/register">Register</a></h1>
				</div>
				<div id="login-pane" class="col-md-12 col-sm-12 col-xs-12">
					<p>Please fill in the fields below to complete your access.<a id="login-modal-trigger" href="#"> Already registered? Click here to login.</a></p>
				</div>
			</div>

			<div class="onepage">
				<div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
					<?php
					if ($this->session->userdata("error_box")) {
						echo '<div class="alert alert-danger" role="alert">';
						echo $this->session->userdata("success_message");
						echo '</div>';
					}
					$this->session->unset_userdata("success_message");
					$this->session->unset_userdata("error_box");
					?>

					<div id="div_billto">
						<div class="pane round-box">
							<h3 class="title"><span class="icon icon-one">1</span>LOGIN</h3>
							<form method="POST" action="<?php echo base_url(); ?>users/ckeck_login" id="login_form">
								<div class="pane-inner">
									<ul id="table_billto" class="adminform user-details no-border">
										<li class="long">
											<div class="field-wrapper">
												<label for="shipto_address_1_field" class="shipto_address_1">Username<em>*</em></label>
												<br>
												<input type="text" maxlength="64" class="required" value="<?php if (isset($_COOKIE["username"]) && ($_COOKIE['username'] != "")) {
																																										echo $_COOKIE["username"];
																																									}  ?>" size="30" name="username" id="username">
											</div>
										</li>
										<li class="long">
											<div class="field-wrapper">
												<label for="shipto_fax_field" class="shipto_fax">Password<em>*</em></label>
												<br>
												<input type="password" maxlength="32" value="<?php if (isset($_COOKIE["password"]) && ($_COOKIE['password'] != "")) {
																																				echo $_COOKIE["password"];
																																			}  ?>" size="30" name="password" id="password">
											</div>
										</li>
									</ul>


									<fieldset class="vm-fieldset-tos mb-5">
										<input id="remember" name="remember" onclick="remember_me()" class="terms-of-service" type="checkbox" value="<?php
																																																																	if (isset($_COOKIE['username'])) {
																																																																		echo '1';
																																																																	} else {
																																																																		echo '0';
																																																																	}

																																																																	?>" <?php
																																																																			if (isset($_COOKIE['username'])) {
																																																																				echo 'checked="checked"';
																																																																			} else {
																																																																				echo '';
																																																																			}
																																																																			?>>
										<span>Remember Login</span><br><br>
										<div class="checkout-button-top mt-5">
											<input type="image" src="<?php echo base_url(); ?>assets/images/loginbtn.png">
										</div><br>
									</fieldset>
								</div>
							</form>
						</div>
					</div>
					<h1><strong>Don't have an account?</strong></h1>
					<p>Register today with Need A Print (optional for checkout) and benefit from having an account. With an account you can checkout faster and track all your orders from one page.
						<a class="text-primary" href="<?php echo base_url(); ?>users/register">Register here!</a>
					</p>
				</div>
			</div>

		</div> <!-- cierro contaider -->


	</section>
</main>