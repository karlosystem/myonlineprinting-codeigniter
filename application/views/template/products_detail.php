<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$product_id = $this->uri->segment(4); // .../printing/printing_cards/B.-Full-Color-Postcards/19
$tbl = "exp_tbl_products";
$col = "p_id ";
$product = $this->common_model->get_item_by_id($tbl, $col, $product_id);
?>
<!--Main Product Detail : Begin-->
<main class="main" id="product-detail">
	<!--Breadcrumb : Begin-->
	<section class="header-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 hidden-xs">
					<h1 class="mh-title">
						<?php if (!empty($product['p_name'])) {
							echo $product['p_name'];
						} ?>
					</h1>
				</div>
				<div class="breadcrumb-w col-sm-8">
					<span class="hidden-xs">You are here:</span>
					<ul class="breadcrumb">
						<li>
							<a href="<?php echo base_url(); ?>">Home</a>
						</li>
						<li>
							<span>
								<?php if (!empty($product['p_name'])) {
									echo $product['p_name'];
								} ?>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!--Breadcrumb : End-->



	<!--Product info : Begin-->
	<section class="product-info-w pr-main">
		<div class="container">

			<div class="row">
				<div class="col-md-12 col-xs-12">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#features" aria-controls="features" role="tab" data-toggle="tab">
								<?php if (!empty($product['p_name'])) {
									echo $product['p_name'];
								} ?>
							</a></li>
						<li role="presentation"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">About</a></li>
						<li role="presentation"><a href="#ideals" aria-controls="ideals" role="tab" data-toggle="tab">Paper Type</a></li>
						<li role="presentation"><a href="#paper" aria-controls="paper" role="tab" data-toggle="tab">Turnaround</a></li>
						<li role="presentation"><a href="#guide" aria-controls="guide" role="tab" data-toggle="tab">Free Artwork Guide Templates</a></li>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="tab-content clearfix">

					<div role="tabpanel" class="tab-pane active" id="features">
						<div class="product-image v-middle">
							<div class="col-sm-12 col-xs-12">
								<img src="<?php echo base_url(); ?>assets/images/products/<?php echo $product['p_id']; ?>/profile/<?php echo $product['p_image']; ?>">
							</div>
						</div>
						<div class="product-shortdescript v-middle">
							<div class="col-sm-12 col-xs-12">
								<div class="v-middle">
									<h3><?php if (!empty($product['p_name'])) {
												echo $product['p_name'];
											} ?></h3>
									<?php if (!empty($product['p_discription'])) {
										echo $product['p_discription'];
									} ?>
								</div>
							</div>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="about">

					</div>

					<div role="tabpanel" class="tab-pane" id="ideals">
						<div class="col-md-8 col-md-offset-2 col-xs-12 ideals-w">
							<div class="ideal">
								<img src="<?php echo base_url(); ?>assets/images/img-paper.png" alt="ideal 1">
							</div>
							<div class="ideal">
								<img src="<?php echo base_url(); ?>assets/images/product/details/ideal-2.jpg" alt="ideal 2">
							</div>
							<div class="ideal">
								<img src="<?php echo base_url(); ?>assets/images/product/details/ideal-3.jpg" alt="ideal 3">
							</div>
							<div class="ideal">
								<img src="<?php echo base_url(); ?>assets/images/product/details/ideal-4.jpg" alt="ideal 4">
							</div>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="paper">

						<div class="paper-des v-middle">
							<div class="col-sm-11 col-sm-offset-1">
								<div class="v-middle">
									<h3>13 pt. Cardstock, Uncoated Paper</h3>
									<ul>
										<li><i class="fa fa-check"></i> Lighter weight uncoated cardstock</li>
										<li><i class="fa fa-check"></i> Requires scoring prior to folding</li>
										<li><i class="fa fa-check"></i> Paper from sustainable sources, 30% recycled content</li>
										<li><i class="fa fa-check"></i> Some natural fibers may be visible</li>
										<li><i class="fa fa-check"></i> Excellent writability</li>
										<li><i class="fa fa-check"></i> Recommended for Appointment Cards, Invitations and Note Cards</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="product-image v-middle">
							<div class="col-sm-12">
								<img src="<?php echo base_url(); ?>assets/images/img-paper.png" alt="ideal 1" class="v-middle">
							</div>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="guide">

					</div>

				</div>

			</div>
	</section>
	<!--Product info : Begin-->

	<!-- <section class="product-step-order hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-12 pso-header">
					<i class="fa fa-angle-double-down border-radius-50"></i>
					<h3>Okay, Let’s Get Started.</h3>
				</div>
			</div>
			<div class="pso-content">
				<div class="pso-content-bottom row">
					<div class="col-md-3 col-md-offset-1 col-sm-4 step-select-option">
						<span class="pso-icon border-radius-50 d-block"></span>
						<h3>Browse Our Designs</h3>
						<p class="pso-text">
							1000s of pre made templates
						</p>
						<a class="view-more" href="<?php echo base_url(); ?>templates/template_designs" title="Browse Our Designs">Click Here</a>
					</div>
					<div class="col-sm-4 step-upload-design">
						<span class="pso-icon border-radius-50 d-block">
							<i class="fa fa-file-text-o"></i>
							<i class="fa fa-arrow-circle-o-up"></i>
						</span>
						<h3>Print My File</h3>
						<p class="pso-text">
							Upload your file, Price and Order
						</p>
						<a class="view-more" href="#" title="view more product">Click Here</a>
					</div>
					<div class="col-md-3 col-sm-4 step-checkout">
						<span class="pso-icon border-radius-50 d-block">
							<i class="fa fa-shopping-cart"></i>
						</span>
						<h3>Checkout & Order</h3>
						<p class="pso-text">
							Checkout and finish your order very easy
						</p>
						<a class="view-more" href="#" title="view more product">Click Here</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 pso-footer">
					<i class="fa fa-angle-double-down border-radius-50"></i>
				</div>
			</div>
		</div>
	</section> -->
	<!--Step order : End-->

	<!--Home ours service : Begin -->
	<section class="or-service">
		<div class="container">
			<div class="row">
				<div class="block-title-w">
					<h2 class="block-title">Alternatively select a product type</h2>
					<span class="icon-title">
						<span></span>
						<i class="fa fa-star"></i>
					</span>
					<span class="sub-title">Choose the design path that is right before upload file</span>
				</div>
				<div class="or-service-w">

					<?php
					if (!empty($subproduct_array)) {
						foreach ($subproduct_array as $sub_product) {
					?>
							<div class="col-md-3 col-sm-6 col-xs-6 or-block">
								<div class="or-image">
									<a href="<?php echo base_url(); ?>printing/order_print/<?php if (!empty($product['p_id'])) {
																																						echo $product['p_id'];
																																					}  ?>/<?php if (!empty($sub_product['sp_id'])) {
																																									echo $sub_product['sp_id'];
																																								} ?>">
										<img src="<?php echo base_url();  ?>assets/images/subproducts/<?php echo $sub_product['sp_id'] ?>/<?php echo $sub_product['sp_image'];  ?>" />
									</a>
								</div>
								<div class="or-title">
									<a href="<?php echo base_url(); ?>printing/order_print/<?php if (!empty($product['p_id'])) {
																																						echo $product['p_id'];
																																					}  ?>/<?php if (!empty($sub_product['sp_id'])) {
																																									echo $sub_product['sp_id'];
																																								} ?>"><?php echo substr($sub_product['sp_name'], 0, 50) . ".."; ?></a>
								</div>
								<div class="or-text">
									<p>
										let us design your next print project!
									</p>
								</div>
								<a href="<?php echo base_url(); ?>printing/order_print/<?php if (!empty($product['p_id'])) {
																																					echo $product['p_id'];
																																				}  ?>/<?php if (!empty($sub_product['sp_id'])) {
																																								echo $sub_product['sp_id'];
																																							} ?>" class="btn-readmore order-now">Order now</a>
							</div>

					<?php
						}
					}
					?>

				</div>
			</div>
		</div>
	</section>
	<!--Home out recent : Begin -->

</main><!-- Main Product Detail: End -->