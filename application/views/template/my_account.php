<?php
//debug($detail["u_country"]);
$tblname = "exp_tbl_countries";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$country = $CI->common_model->get_all_list($tblname);
//debug($result);


//getting state nme
$tbl = "exp_tbl_states";
$col = "state_id";
$val = $detail["u_state"];
$state = $CI->common_model->get_item_by_id($tbl, $col, $val);
//debug($get_order_by_user_id);
?>
<!--Main index : End-->
<main class="main">
	<section class="header-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 hidden-xs">
					<h1 class="mh-title">My Account!</h1>
				</div>
				<div class="breadcrumb-w col-sm-9">
					<span class="hidden-xs">You are here:</span>
					<ul class="breadcrumb">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<span>My Account!</span>
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
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
					<h1>Welcome to My Online Printing LLC., create an account now!</h1>
					<p>Enter your details below to allow you to checkout quicker and track multiple orders at once:</a></p>

				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 right">
					<h1>
						<a href="<?php echo base_url(); ?>users/order_history">
							Order History
						</a>
					</h1>
				</div>
			</div>

			<div class="onepage">
				<div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
					<div id="div_billto">
						<div class="pane round-box">
							<h3 class="title"><span class="icon icon-one">1</span>My Account!</h3>
							<div class="pane-inner">
								<?php
								if ($this->session->userdata("error_box")) {
									echo '<div class="error_box">';
									echo $this->session->userdata("success_message");
									echo '</div>';
									$this->session->unset_userdata("success_message");
									$this->session->unset_userdata("error_box");
								}
								if ($this->session->userdata("valid_box")) {
									echo '<div class="valid_box">';
									echo $this->session->userdata("success_message");
									echo '</div>';
									$this->session->unset_userdata("success_message");
									$this->session->unset_userdata("valid_box");
								}
								?>
								<form id="my_account_form" name="my_account_form" method="POST" action="<?php echo base_url(); ?>users/update_user">
									<ul id="table_billto" class="adminform user-details no-border">
										<li class="short">
											<div class="field-wrapper">
												<label for="company_field" class="company">Company Name </label>
												<br>
												<input type="text" name="u_comp" value="<?php if (!empty($detail['u_comp'])) {
																																	echo $detail['u_comp'];
																																} ?>">
											</div>
										</li>

										<li class="short right">
											<div class="field-wrapper">

												<label for="email_field" class="email">
													Your name<em>*</em> </label>
												<br>
												<input type="text" name="u_name" id="u_name" value="<?php if ($detail['u_name']) {
																																							echo $detail['u_name'];
																																						} ?>">
											</div>
										</li>


										<li class="long">
											<div class="field-wrapper">

												<label for="address_1_field" class="address_1">
													Address 1<em>*</em> </label>
												<br>
												<input type="text" name="u_add_line1" id="u_add_line1" value="<?php if ($detail['u_add_line1']) {
																																												echo $detail['u_add_line1'];
																																											} ?>">
											</div>
										</li>
										<br>
										<li class="long">
											<div class="field-wrapper">

												<label for="address_1_field" class="address_1">
													Address 2 </label>
												<input type="text" name="u_add_line2" id="u_add_line2" value="<?php if ($detail['u_add_line2']) {
																																												echo $detail['u_add_line2'];
																																											} ?>">
											</div>
										</li>
										<br>
										<li class="short">
											<div class="field-wrapper">

												<label for="virtuemart_city" class="virtuemart_state_id">
													City<em>*</em> </label>
												<br>
												<select style="width: 210px" class="vm-chzn-select" name="u_country" id="u_country" onchange="get_by_id(this.value);">
													<option value="">select country</option>
													<?php
													foreach ($country as $c) {
													?>
														<option value="<?php echo $c['country_id']; ?>" <?php if ($detail['u_country'] == $c['country_id']) {
																																							echo "selected='selected'";
																																						} ?>>
															<?php echo $c['country_name']; ?></option>;
													<?php }
													?>
												</select>
											</div>
										</li>

										<li class="short right">
											<div class="field-wrapper">

												<label for="virtuemart_state_id_field" class="virtuemart_state_id">
													State / Province / Region<em>*</em> </label>
												<br>
												<select style="width: 210px" class="vm-chzn-select" name="u_state" id="u_state">
													<option value="<?php echo $state["state_id"]; ?>"><?php echo $state["state_name"]; ?></option>
												</select>
											</div>
										</li>

										<li class="short">
											<div class="field-wrapper">

												<label for="phone_1_field" class="phone_1">
													Zip Code:</label>
												<br>
												<input type="text" name="u_postcode" id="u_postcode" value="<?php if ($detail['u_postcode']) {
																																											echo $detail['u_postcode'];
																																										} ?>">
											</div>
										</li>
										<br>
										<div style="display:none;">
											<img src="<?php echo base_url(); ?>assets/images/ajax-loader-front.gif" />
										</div>

										<li class="short right">
											<div class="field-wrapper">

												<label for="phone_2_field" class="phone_2">
													Mobile phone </label>
												<br>
												<input type="text" name="u_phone" id="u_phone" value="<?php if ($detail['u_phone']) {
																																								echo $detail['u_phone'];
																																							} ?>">
											</div>
										</li>
										<li class="long">
											<div class="field-wrapper">

												<label for="address_1_field" class="address_1">
													Email<em>*</em> </label>
												<br>
												<input type="text" name="u_email" id="u_email" value="<?php if ($detail['u_email']) {
																																								echo $detail['u_email'];
																																							} ?>">
											</div>
										</li>

										<li class="long">
											<div class="field-wrapper agreed">
												<div class="checkout-button-top" class="mt-5">
													<input type="submit" value="Update" class="vm-button-correct mt-5">
												</div>
											</div>
										</li>
										<br>
									</ul>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div> <!-- cierro contaider -->


	</section>
</main>