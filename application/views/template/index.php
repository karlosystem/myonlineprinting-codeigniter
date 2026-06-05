	<!--Main index : Begin-->
	<main class="main index">
		<!--Home slider : Begin-->
		<section class="home-slidershow">
			<div class="slide-show">
				<div class="vt-slideshow">
					<ul>
						<?php
						if (!empty($sliders)) {
							foreach ($sliders as $s) {
								if ($s['status'] == 1) {
						?>
									<li class="slide2" data-transition="random">
										<img src="<?php echo base_url(); ?>assets/images/admin/main_slider_image/<?php echo $s['banner_id']; ?>/thumbs/<?php echo $s['banner_image'];  ?>" />
										<div class="tp-caption lfr" data-x="left" data-hoffset="" data-y="170" data-start="800" data-speed="2000" data-endspeed="300">
											<span class="style1">
												<span class="textcolor"><?php echo $s['banner_title']; ?></span>
												<?php echo $s['banner_title_gray']; ?>
											</span>
										</div>
										<div class="tp-caption lfb" data-x="left" data-hoffset="" data-y="225" data-start="800" data-speed="2000" data-endspeed="300">
											<span class="style2">
												<?php echo $s['banner_description']; ?>
											</span>
										</div>
										<div class="tp-caption lfr" data-x="left" data-y="367" data-start="1300" data-speed="2000" data-easing="easeInOutQuint" data-endspeed="300"><a class="btn-sn" href="#">buy now</a></div>
									</li>
						<?php
								}
							}
						}
						?>

					</ul>
				</div>
			</div>
		</section>

		<!--Home Trust : Begin-->
		<!-- <section class="trust-w hidden-xs">
			<div class="container">
				<div class="row">
					<?php
					if (!empty($pages)) {
						foreach ($pages as $p) {
							if ($p['page_status'] == 1) {
					?>
								<div class="col-md-3 col-sm-6 block-trust trust-col-quantity">
									<div class="tr-icon"><i class="<?php echo $p['page_icono']; ?>"></i></div>
									<div class="tr-text">
										<h3><?php echo $p['page_title']; ?></h3>
										<span class="tr-line"></span>
										<p><?php echo $p['page_leyenda']; ?></p>
										<a href="<?php echo base_url(); ?>common/static_pages/<?php echo $p['page_id']; ?>" class="btn-readmore" title="Quality Printing">Read more</a>
									</div>
								</div>
					<?php
							}
						}
					}
					?>
				</div>
			</div>
		</section> -->
		<!--Home Trust : End-->


		<!--Home ours service : Begin -->
		<section class="or-service">
			<div class="container">
				<div class="row">
					<div class="block-title-w">
						<h2 class="block-title">our services</h2>
						<span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
						<span class="sub-title">Choose the design path that is right before upload file</span>
					</div>
					<div class="or-service-w">
						<?php
						if (!empty($product_array)) {
							foreach ($product_array as $product) {
						?>
								<div class="col-md-3 col-sm-6 col-xs-6 or-block">
									<div class="or-image">
										<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $product['p_name']); ?>/<?php echo $product['p_id']; ?>">
											<img src="<?php echo base_url(); ?>assets/images/products/<?php echo $product['p_id'] ?>/profile/<?php echo $product['p_image']; ?>" alt="service-01" />
										</a>
									</div>
									<div class="or-title">
										<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $product['p_name']); ?>/<?php echo $product['p_id']; ?>"><?php echo $product["p_name"]; ?></a>
									</div>
									<div class="or-text">
										<p>

										</p>
									</div>
									<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $product['p_name']); ?>/<?php echo $product['p_id']; ?>" class="btn-readmore order-now">Order now</a>
								</div>
							<?php  }
						} else { ?>
							<h1 style="width:100%;text-align:center;">No Product Found</h1>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

		<!--Home make print : Begin -->
		<section class="home-make-print">
			<div class="container">
				<div class="row">
					<div class="block-title-w">
						<h2 class="block-title">HOW WE MAKE PRINTING AS EASY</h2>
						<span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
					</div>
					<!--make print Title : End -->
					<div class="print-content">
						<div class="col-md-4 col-sm-4 print-block print-block-left">
							<div class="w-print-block frist">
								<div class="print-icon">
									<i class="fa fa-hand-o-up"></i>
									<i class="fa fa-newspaper-o"></i>
								</div>
								<div class="print-title">
									<a href="#">Select Options</a>
								</div>
								<div class="print-number">
									<span>01</span>
								</div>
								<div class="print-txt">
									<p>Choose options that you want for your prints.We will make you happy with your choices.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 print-block print-block-center">
							<div class="w-print-block">
								<div class="print-icon">
									<i class="fa fa-file-text-o"></i>
									<i class="fa fa-arrow-circle-o-up"></i>
								</div>
								<div class="print-title">
									<a href="#">Upload your design</a>
								</div>
								<div class="print-number">
									<span>02</span>
								</div>
								<div class="print-txt">
									<p>Upload your finished design here and we'll print it for you with your choices</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 print-block print-block-right">
							<div class="w-print-block">
								<div class="print-icon">
									<i class="fa fa-shopping-cart"></i>
								</div>
								<div class="print-title">
									<a href="#">Checkout & Order</a>
								</div>
								<div class="print-number">
									<span>03</span>
								</div>
								<div class="print-txt">
									<p>Checkout and finish your order very easy with one step checkout extension.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg_make_print">

			</div>
		</section>



	</main>