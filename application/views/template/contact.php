<style type="text/css">
	.g-recaptcha {
		transform: scale(0.77);
		-webkit-transform: scale(0.77);
		transform-origin: 0 0;
		-webkit-transform-origin: 0 0;
	}
</style>
<?php
$tbl_name = "exp_tbl_contact_address";
$contact_array = $this->common_model->get_all_list($tbl_name);
$tblname = "exp_tbl_countries";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$country = $CI->common_model->get_all_list($tblname);
?>
<!--Main index : End-->
<main class="main">
	<section class="header-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 hidden-xs">
					<h1 class="mh-title">Contact</h1>
				</div>
				<div class="breadcrumb-w col-sm-8">
					<span class="hidden-xs">You are here:</span>
					<ul class="breadcrumb">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<span>Contact</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section id="pr-contact" class="pr-main">
		<div class="container">
			<h1 class="ct-header">Contact us</h1>
			<?php
			if ($this->session->userdata("valid_box")) {
				echo "<div class='alert alert-success' role='alert'>";
				echo $this->session->userdata("success_message");
				$this->session->unset_userdata("success_message");
				$this->session->unset_userdata("valid_box");
				echo "</div>";
			} else if ($this->session->userdata("error_box")) {
				echo "<div class='alert alert-danger' role='alert'>";
				echo $this->session->userdata("success_message");
				$this->session->unset_userdata("success_message");
				$this->session->unset_userdata("error_box");
				echo "</div>";
			}
			?>
		</div>
		
		<div class="container">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="address">
					<i class="fa fa-home"></i>
					<p>
						<!-- <span>Stress: 15 Sweet Love Stress</span><br/> -->
						<span><?php
									if (!empty($contact_array[0]['heading'])) {
										echo $contact_array[0]['heading'];
									}
									?></span><br />
						<span><?php
									if (!empty($contact_array[0]['address'])) {
										echo $contact_array[0]['address'] . ' , ' . $contact_array[0]['zip_code'];
									}
									?></span><br />

					</p>
				</div>
				<div class="phone">
					<i class="fa fa-phone"></i>
					<p>
						<span><?php
									if (!empty($contact_array[0]['tel'])) {
										echo $contact_array[0]['tel'];
									}
									?></span>
					</p>
				</div>



				<div class="website">
					<i class="fa fa-globe"></i>
					<p>
						<span><?php
									if (!empty($contact_array[0]['opening_hours'])) {
										echo $contact_array[0]['opening_hours'];
									}
									?></span>
					</p>
				</div>

				<div class="website">
					<i class="fa fa-envelope"></i>
					<p>
						<span><?php
									if (!empty($contact_array[0]['email'])) {
										echo $contact_array[0]['email'];
									}
									?></span>
					</p>
				</div>


			</div>
			<!-- <form id="contact-form" name="contact-form" id="contact_form" class="form-validate form-horizontal" method="post" action="<?php echo base_url(); ?>contact/save">
				<div class="col-md-3 col-sm-3 col-xs-12">
					<input id="name" name="name" title="Enter your name" class="name" type="text" placeholder="Enter your name *">
					<input id="email" name="email" title="Enter your Email" class="email" type="text" placeholder="Enter E-mail *">
					<input id="mobile" name="mobile" title="Enter your Number of Mobile" class="mesage" type="text" placeholder="Enter Mobile *">
					<div class="button">
						<input class="subject" type="checkbox" placeholder="Enter Mesage Subject *">
						<span>Send copy to yourself</span>
						<br>
						<?php echo $this->recaptcha->render(); ?>
					</div>
					<button type="submit" name="send_contact" id="send_contact" class="sendmail">Submit</button>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<textarea aria-required="true" title="Enter your message" class="required invalid" rows="10" cols="50" id="enquiry" name="enquiry" aria-invalid="true" placeholder="Message *"></textarea>
					<p>Ask us a question and we'll write back to you promptly! Simply fill out the form below and click Send Email.</p>
					<p>Thanks. Items marked with an asterisk (<span class="star">*</span>) are required fields.</p>
				</div>

			</form> -->
		</div>
	</section>
</main>
<!--Main index : End-->