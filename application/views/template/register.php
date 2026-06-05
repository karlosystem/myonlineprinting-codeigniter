<?php
$tblname = "exp_tbl_countries";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$country = $CI->common_model->get_all_list($tblname);
#debug($result);

?>

<style>
	.error {
		color: red !important;
	}
</style>
<!--Main index : End-->
<main class="main">
	<section class="header-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 hidden-xs">
					<h1 class="mh-title">Register</h1>
				</div>
				<div class="breadcrumb-w col-sm-9">
					<span class="hidden-xs">You are here:</span>
					<ul class="breadcrumb">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<span>Register</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section id="checkout" class="pr-main">
		<div class="container">
			<?php
			if ($this->session->userdata("error_box")) {
				echo '<div class="alert alert-danger" role="alert">';
				echo $this->session->userdata("success_message");
				echo '</div>';
				$this->session->unset_userdata("success_message");
				$this->session->unset_userdata("error_box");
			}
			if ($this->session->userdata("valid_box")) {
				echo '<div class="alert alert-success" role="alert">';
				echo $this->session->userdata("success_message");
				echo '</div>';
				$this->session->unset_userdata("success_message");
				$this->session->unset_userdata("valid_box");
			}
			?>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="cart-top">
					<img alt="Cart top banner" src="<?php echo base_url(); ?>assets/images/banner/cart/top-banner.jpg">
				</div>
			</div>

			<div class="cart-view-top">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<h1>Welcome to My Online Printing LLC., create an account now!</h1>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 right">
					<h1>Register</h1>
				</div>
				<div id="login-pane" class="col-md-12 col-sm-12 col-xs-12">
					<p>Enter your details below to allow you to checkout quicker and track multiple orders at once:</a></p>
				</div>
			</div>

			<div class="onepage">

				<div class="col-md-4 col-sm-6 col-xs-12">
					<div id="div_billto">
						<div class="pane round-box">
							<h3 class="title"><span class="icon icon-one">1</span>REGISTER USER</h3>
							<form id="register_form" name="register_form" method="POST" action="<?php echo base_url(); ?>users/save_user">
								<div class="pane-inner">
									<ul id="table_billto" class="adminform user-details no-border">

										<li class="short">
											<div class="field-wrapper">
												<label for="username_field" class="company">User Name <em>*</em></label>
												<br>
												<input type="text" title="Enter your name" maxlength="64" size="30" name="u_name" id="u_name">
											</div>
										</li>

										<li class="short right">
											<div class="field-wrapper">
												<label for="password_field" class="email">Password <em>*</em></label>
												<br>
												<input type="password" maxlength="100" title="Enter your Password" size="30" name="u_password" id="u_password">
											</div>
										</li>

										<li class="short">
											<div class="field-wrapper">
												<label for="company_field" class="company">Company:</label>
												<br>
												<input type="text" maxlength="64" title="Enter Your Company" size="30" name="u_comp" id="u_comp">
											</div>
										</li>

										<li class="short right">
											<div class="field-wrapper">
												<label for="first_name_field" class="first_name">Address Line 1</label>
												<br>
												<input type="text" maxlength="32" title="Enter your address 1" size="30" name="u_add_line1" id="u_add_line1">
											</div>
										</li>

										<li class="short">
											<div class="field-wrapper">
												<label for="middle_name_field" class="middle_name">Address Line 2</label>
												<br>
												<input type="text" maxlength="32" title="Enter your address 2" size="30" name="u_add_line2" id="u_add_line2">
											</div>
										</li>

										<li class="short right">
											<div class="field-wrapper">
												<label for="last_name_field" class="last_name">Country</label>
												<br>
												<select style="width: 210px" class="vm-chzn-select required" name="u_country" onchange="get_states(this.value)">
													<option selected="selected" value="">-- Select --</option>
													<option value="">select country</option>
													<?php
													foreach ($country as $c) {
														echo '<option value=' . $c["country_id"] . '>' . $c["country_name"] . '</option>';
													}
													?>
												</select>
											</div>
										</li>

										<li class="short">
											<div class="field-wrapper">
												<label for="virtuemart_country_id_field" class="virtuemart_country_id">State<em>*</em></label>
												<br>
												<select style="width: 210px" class="vm-chzn-select required" name="u_state" id="u_state">
													<option value="">Select state</option>
												</select>
											</div>
										</li>
										<li class="short right">
											<div class="field-wrapper">
												<label for="virtuemart_city" class="virtuemart_state_id">Postcode <em>*</em></label>
												<br>
												<input type="text" maxlength="32" size="30" name="u_postcode" id="u_postcode">
											</div>
										</li>

										<li class="short">
											<div class="field-wrapper">
												<label for="virtuemart_state_id_field" class="virtuemart_state_id">Phone:<em>*</em> </label>
												<br>
												<input type="text" maxlength="32" size="30" name="u_phone" id="u_phone">
											</div>
										</li>

										<li class="short right">
											<div class="field-wrapper">
												<label for="phone_1_field" class="phone_1">Email</label>
												<br>
												<input type="text" maxlength="32" size="30" name="u_email" id="u_email">
											</div>
										</li>
										<li class="long">
											<div class="field-wrapper agreed">
												<label for="agreed_field" class="agreed">
													<?php echo $this->recaptcha->render(); ?>
												</label>
												<div class="checkout-button-top" class="mt-5">
													<input type="submit" value="Send Now" class="vm-button-correct mt-5">
												</div>
											</div>
										</li>
									</ul>


								</div>
							</form>
						</div>
					</div>

				</div>

			</div>
			<div class="col-md-2"></div>
			<div class="col-md-6 float-right">
				<img src="<?php echo base_url(); ?>assets/images/register.png" class="img-fluid">
			</div>

		</div> <!-- cierro contaider -->


	</section>
</main>