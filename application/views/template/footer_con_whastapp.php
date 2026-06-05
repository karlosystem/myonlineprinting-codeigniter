	<?php
	$tbl_name = "exp_tbl_contact_address";
	$contact_array = $this->common_model->get_all_list($tbl_name);
	?>
	<!--Footer : Begin-->
	<footer>
		<div class="footer-main">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-12 about-us footer-col">
						<h2>About Us</h2>
						<div class="footer-content">
							<a href="<?php echo base_url(); ?>" title="MyOnlinePrinting" class="logo-footer">
								<img src="<?php echo base_url(); ?>assets/images/logo-myonline.png" alt="MyOnlinePrinting">
							</a>
							<ul class="info">
								<li>
									<i class="fa fa-home"></i>
									<span>
										<span><?php echo $contact_array[0]['address']; ?></span>
									</span>
								</li>
								<li>
									<i class="fa fa-phone"></i>
									<span><?php echo $contact_array[0]['fax']; ?></span>

								</li>
								<li>
									<i class="fa fa-envelope-o"></i>
									<span>
										<a href="mailto:order@MyOnlinePrinting.net" title="send mail to MyOnlinePrinting">
											<span><?php echo $contact_array[0]['email']; ?></span>
										</a>
									</span>
								</li>
							</ul>
							<ul class="footer-social">
								<li>
									<a href="#" title="Facebook">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<li>
									<a href="#" title="YouTube">
										<i class="fa fa-youtube"></i>
									</a>
								</li>
								<li>
									<a href="#" title="Instagram">
										<i class="fa fa-instagram"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12 corporate footer-col">
						<h2>Corporate</h2>
						<div class="footer-content">
							<ul>
								<li><a href="<?php echo base_url(); ?>common/static_pages/23">Who we are</a></li>
								<li><a href="<?php echo base_url(); ?>common/static_pages/24">Quality Commitment</a></li>
								<li><a href="<?php echo base_url(); ?>common/static_pages/21">Environment</a></li>
								<li><a href="<?php echo base_url(); ?>common/static_pages/22">Equipment List</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12 support footer-col">
						<h2>Artworks Guide</h2>
						<div class="footer-content">
							<ul>
								<li><a href="<?php echo base_url(); ?>common/static_pages/29">Specifications</a></li>
								<li><a href="<?php echo base_url(); ?>common/static_pages/25">What is bleed?</a></li>
								<li><a href="<?php echo base_url(); ?>common/static_pages/27">Templates</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-xs-12 other-info footer-col hidden-sm">
						<h2>Other Info</h2>
						<div class="footer-content">
							<p>
								Copiservice Online provides fast online printing for both homes and businesses. We provide high quality business cards, postcards, flyers, brochures, stationery and other premium online print products.
							</p>
							<img src="<?php echo base_url(); ?>assets/images/footer-payment.png" alt="Payment method">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copy-right">Copyright © <script>
								document.write(new Date().getFullYear())
							</script>
							<a href="http://www.myonlineprinting.net" title="MyOnlinePrinting">MyOnlinePrinting</a>. All Rights Reserved |
							Desarrollo: <a href="https://desarrolloweblima.com" target="_new" title="Diseño de Paginas Web en Lima">
								Carlos Marquina</a>
						</p>
						<a href="#" id="back-to-top">
							<i class="fa fa-chevron-up"></i>
							Top
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div id="sitebodyoverlay"></div>
	<nav id="mb-main-menu" class="main-menu">
		<div class="mb-menu-title">
			<h3>Navigation</h3>
			<span id="close-mb-menu">
				<i class="fa fa-times-circle"></i>
			</span>
		</div>

		<ul class="cate_list">
			<!-- <li class="level0 parent col1 all-product">
				<a href="#">
					<span>All Product</span>
					<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-right"></i>
				</a>
				<ul class="level0">
					<li class="level1">
						<a href="#" title="Business Card">Business Card</a>
					</li>
					<li class="level1">
						<a href="#" title="Premium Business Card">Premium Business Card</a>
					</li>
					<li class="level1">
						<a href="#" title="Free Business Card">Free Business Card</a>
					</li>
					<li class="level1">
						<a href="#" title="Marketing Materials">Marketing Materials</a>
					</li>
					<li class="level1">
						<a href="#" title="Dance Marketing Kit">Dance Marketing Kit</a>
					</li>
					<li class="level1 view-all-pro">
						<a href="#" title="view all product">View all</a>
					</li>
				</ul>
			</li>
			<li class="level0 parent col1">
				<a href="#" title="Business Cards">
					<span>Business Cards</span>
					<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-right"></i>
				</a>
				<ul class="level0">
					<li class="level1 nav-1-1 first item">
						<a href="#" title="Premium Business Cards">Premium Business Cards</a>
					</li>
					<li class="level1 nav-1-2 item">
						<a href="#" title="Free Business Cards">Free Business Cards</a>
					</li>
					<li class="level1 nav-1-3 item">
						<a href="#" title="Die-Cut Business Cards">Die-Cut Business Cards</a>
					</li>
					<li class="level1 nav-1-4 item">
						<a href="#" title="Standard Business Cards">Standard Business Cards</a>
					</li>
					<li class="level1 nav-1-5 item">
						<a href="#" class="Personal Business Cards">Personal Business Cards</a>
					</li>
					<li class="level1 nav-1-6 item">
						<a href="#" title="Business Card Holders">Business Card Holders</a>
					</li>
					<li class="level1 nav-1-7 item">
						<a href="#" title="Networking Cards">Networking Cards</a>
					</li>
					<li class="level1 nav-1-8 item">
						<a href="#" title="Appointment Cards">Appointment Cards</a>
					</li>
					<li class="level1 nav-1-9 last item">
						<a href="#" title="Mommy Cards">Mommy Cards</a>
					</li>
				</ul>
			</li> -->
			<?php
			if (!empty($products_top5)) {
				foreach ($products_top5 as $productmenu5) {
			?>
					<li class="level0">
						<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $productmenu5['p_name']);  ?>/<?php echo $productmenu5['p_id'];  ?>" title="<?php echo $productmenu5["p_name"]; ?>"><?php echo $productmenu5["p_name"]; ?></a>
					</li>
			<?php
				}
			}
			?>
		</ul>
	</nav>
	<!--Add js lib-->

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/doughnutit.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slideshow/jquery.themepunch.revolution.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slideshow/jquery.themepunch.plugins.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/theme-home.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/countdown/jquery.countdown.js"></script>

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

	<script src="<?php echo base_url(); ?>assets/js/dist/wpp_js/whatsappButton.js"></script>
	<script>
		new WhatsappButton('13054957881', 'Could we help you?', 'We are at your service! Want help at choosing a room? Any other thing we could help?', 'netWinez, can we help?', '1', 'green', '#FFFFFF', '#fff', 'https://fonts.googleapis.com/css?family=Roboto&display=swap');
	</script>


	</body>

	</html>