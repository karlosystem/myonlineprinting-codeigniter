<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> :: Miami FL Printing</title>
	<meta name="description" content="<?php print $description_header_page; ?>" />
	<meta name="keywords" content="<?php print $keywords_header_page; ?>" />
	<meta name="author" content="Carlos Marquina">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes" />

	<!--Add css lib-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style-main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/subproducto.css">

	<!--chat css Whastapp-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/whatsappButton.css">

	<link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Arimo:500,300,700,400' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:500,300,700,400' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/general.js"></script>

	<!--Icono de favicon-->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.ico" />

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148804986-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'UA-148804986-1');
	</script>

	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
	</script>

</head>

<body>
	<!--Header: Begin-->
	<header>
		<!--Top Header: Begin-->
		<section id="top-header" class="clearfix">
			<div class="container">
				<div class="row">

					<div class="top-links col-lg-7 col-md-6 col-sm-5 col-xs-6">
						<ul>
							<?php if (!$this->session->userdata("u_id")) { ?>
								<li>
									<a href="<?php echo base_url(); ?>users/login">
										<i class="fa fa-user"></i>
										Login
									</a>
								</li>
								<li class="hidden-xs">
									<a href="<?php echo base_url(); ?>users/register">
										<i class="fa fa-pencil"></i>
										Sign Up
									</a>
								</li>
							<?php } else { ?>
								<li class="visible-md visible-lg">
									<a title="My Account" alt="My Account" href="<?php echo base_url(); ?>users/my_account">
										<i class="fa fa-lock"></i>
										My Account
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-user"></i>
										Welcome: <?php echo ucfirst($this->session->userdata("u_name")); ?>
								</li>
								</a>
								<li class="visible-md visible-lg">
									<a title="Salir" alt="Salir" href="<?php echo base_url(); ?>users/logout">
										<i class="fa fa-heart"></i>
										salir
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>



					<div class="top-header-right f-right col-lg-5 col-md-6 col-sm-7 col-xs-6">
						<div class="w-header-right">
							<div class="th-hotline">
								<i class="fa fa-phone"></i>
								<span>305.495.7881</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--Top Header: End-->
		<!--Main Header: Begin-->
		<section class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 w-logo">
						<div class="logo hd-pd">
							<a alt="Home" title="Home" href="<?php echo base_url(); ?>">
								<img src="<?php echo base_url(); ?>assets/images/logo2.jpg" alt="Copiservice Online" title="Copiservice Online">
							</a>
						</div>
					</div>
					<div class="col-lg-7 col-md-8 visible-md visible-lg">
						<nav id="main-menu" class="main-menu clearfix">
							<ul>

								<li class="level0 hd-pd">
									<a href="<?php echo base_url(); ?>" title="Contact">Home</a>
								</li>

								<li class="level0 parent col1 hd-pd" title="About Us">
									<a href="javascript:void(0);">
										<span>About Us</span><i class="fa fa-chevron-down"></i>
									</a>
									<ul class="level0">
										<li class="level1 nav-1-1 first item">
											<a href="<?php echo base_url(); ?>common/static_pages/23" title="Who we are">Who we are</a>
										</li>
										<li class="level1 nav-1-2 item">
											<a href="<?php echo base_url(); ?>common/static_pages/28" title="Why Choose Us?">Why Choose Us?</a>
										</li>
										<li class="level1 nav-1-3 item">
											<a href="<?php echo base_url(); ?>common/static_pages/24" title="Sponsorships">Sponsorships</a>
										</li>
										<li class="level1 nav-1-4 item">
											<a href="<?php echo base_url(); ?>common/static_pages/21" title="Why Large Format Printing?">Why Large Format Printing?</a>
										</li>
										<li class="level1 nav-1-5 item">
											<a href="<?php echo base_url(); ?>common/static_pages/22" title="Equipment List">Equipment List</a>
										</li>
									</ul>
								</li>

								<li class="level0 parent col1 all-product hd-pd">
									<a href="<?php echo base_url(); ?>products"><span>All Products</span><i class="fa fa-chevron-down"></i></a>
									<ul class="level0">
										<li class="level1">
											<span class="menu-title">Most Popular</span>
											<ul class="level1">
												<?php
												if (!empty($products_top5)) {
													foreach ($products_top5 as $productmenu5) {
												?>
														<li class="level2">
															<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $productmenu5['p_name']);  ?>/<?php echo $productmenu5['p_id'];  ?>" title="<?php echo $productmenu5["p_name"]; ?>"><?php echo $productmenu5["p_name"]; ?></a>
														</li>
												<?php
													}
												}
												?>
												<li class="level2 view-all-pro">
													<a href="<?php echo base_url(); ?>products" title="view all product">View all</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<!-- <li class="level0 parent col1 hd-pd">
									<a href="#" title="Business Cards">
										<span>Business Cards</span>
										<i class="fa fa-chevron-down"></i>
									</a>
									<ul class="level0">
										<?php
										if (!empty($bussinesscard)) {
											foreach ($bussinesscard as $bussiness) {
										?>
												<li class="level1 nav-1-1 item">
													<a href="<?php echo base_url(); ?>printing/order_print/<?php if (!empty($bussiness['p_id'])) {
																																										echo $bussiness['p_id'];
																																									}  ?>/<?php if (!empty($bussiness['sp_id'])) {
																																													echo $bussiness['sp_id'];
																																												} ?>" title="<?php echo $bussiness["sp_name"]; ?>"><?php echo $bussiness["sp_name"]; ?></a>
												</li>
										<?php
											}
										}
										?>
									</ul>
								</li> -->
								<li class="level0 parent col1 hd-pd">
									<a href="javascript:void(0);" title="Artworks Guides">
										<span>Artworks Guides</span><i class="fa fa-chevron-down"></i>
									</a>
									<ul class="level0">
										<li class="level1 nav-1-1 first item">
											<a href="<?php echo base_url(); ?>common/static_pages/29" title="Specifications">Quality Printing</a>
										</li>
										<li class="level1 nav-1-2 item">
											<a href="<?php echo base_url(); ?>common/static_pages/25" title="What is bleed?">What is bleed?</a>
										</li>
										<li class="level1 nav-1-3 item">
											<a href="<?php echo base_url(); ?>common/static_pages/27" title="Templates">Templates</a>
										</li>
									</ul>

								</li>
								<li class="level0 hd-pd">
									<a href="<?php echo base_url(); ?>contact" title="Contact">Contact</a>
								</li>

							</ul>
						</nav>
					</div>
					<div class="col-sm-1 col-sm-offset-5 col-xs-offset-2 col-xs-2 visible-sm visible-xs mbmenu-icon-w">
						<span class="mbmenu-icon hd-pd">
							<i class="fa fa-bars"></i>
						</span>
					</div>
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-3 headerCS">
						<div class="cart-w SC-w hd-pd ">
							<span class="mcart-icon dropdowSCIcon">
								<i class="fa fa-shopping-cart"></i>
								<?php
								$total_items = 0;
								if ($this->cart->contents()) {
									foreach ($this->cart->contents() as $a) {
										$total_items = $total_items + 1;
									}
								}
								?>
								<span class="mcart-dd-qty"><?php echo $total_items ?></span>
							</span>
							<div class="mcart-dd-content dropdowSCContent clearfix">
								<!-- <div class="mcart-item-w clearfix1">
									<ul>
										<li class="mcart-item">
											<img src="<?php echo base_url(); ?>assets/images/product/mcart-postcard.jpg" alt="postcard cards">
											<div class="mcart-info">
												<a href="#" class="mcart-name">Postcards Cards</a>
												<span class="mcart-qty">1 x </span>
												<span class="mcart-price">$ 10.09</span>
												<span class="mcart-remove-item">
													<i class="fa fa-times-circle"></i>
												</span>
											</div>
										</li>
									</ul>
								</div>
								<div class="mcart-item-w clearfix">
									<ul>
										<li class="mcart-item iteam2">
											<img src="<?php echo base_url(); ?>assets/images/product/mcart-postcard.jpg" alt="postcard cards">
											<div class="mcart-info">
												<a href="#" class="mcart-name">Postcards Cards</a>
												<span class="mcart-qty">1 x </span>
												<span class="mcart-price">$ 10.09</span>
												<span class="mcart-remove-item">
													<i class="fa fa-times-circle"></i>
												</span>
											</div>
										</li>
									</ul>
								</div>
								<div class="mcart-total clearfix">
									<table>
										<tr>
											<td>Sub-Total</td>
											<td>$ 10.09</td>
										</tr>
										<tr>
											<td>Eco Tax (-2.00)</td>
											<td>$ 2.00</td>
										</tr>
										<tr>
											<td>VAT (20%)</td>
											<td>$ 2.018</td>
										</tr>
										<tr class="total">
											<td>Total</td>
											<td>$ 10.108</td>
										</tr>
									</table>
								</div> -->
								<br>
								<div class="mcart-links buttons-set clearfix">
									<a href="<?php echo base_url(); ?>cart" class="gbtn mcart-link-cart">View Cart</a>
									<a href="<?php echo base_url(); ?>cart/bill_ship_info" class="gbtn mcart-link-checkout">Checkout</a>
								</div>
							</div>
						</div>
						<div class="search-w SC-w hd-pd ">
							<span class="search-icon dropdowSCIcon">
								<i class="fa fa-search"></i>
							</span>
							<div class="search-safari">
								<div class="search-form dropdowSCContent">
									<form action="<?php echo base_url();  ?>products/search_product" method="POST">
										<input type="text" name="keyword" placeholder="Search" />
										<input type="submit" name="search" value="Search">
										<i class="fa fa-search"></i>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--Main Header: End-->
	</header>
	<!--Header: End-->