<?php
$tbl_name = "exp_tbl_contact_address";
$contact_array = $this->common_model->get_all_list($tbl_name);
?>
<!--Main category : Begin-->
<main id="main category">
	<section class="header-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 hidden-xs">
					<h1 class="mh-title">Services</h1>
				</div>
				<div class="breadcrumb-w col-sm-9">
					<span>You are here:</span>
					<ul class="breadcrumb">
						<li>
							<a href="<?php echo base_url(); ?>">Home</a>
						</li>
						<li>
							<span>Services</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section class="category-w parten-bg">
		<div class="container">
			<div class="row">
				<aside id="sidebar_cate" class="col-sm-3 hidden-xs">
					<h3 class="sidebar-title">Services</h3>
					<ul id="cate_list" class="cate_list">
						<li class="level0 parent">
							<a href="#" title="All Services of MyOnlinePrinting">
								<span>All Services</span>
								<i class="fa fa-minus"></i><i class="fa fa-plus"></i>
							</a>
							<ul class="level0">
								<?php
								if (!empty($product_count)) {
									foreach ($product_count as $productos) {
								?>
										<li class="level1 nav-1-<?php echo $productos["p_id"]; ?> item">
											<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $productos['p_name']);  ?>/<?php echo $productos['p_id'];  ?>" title="<?php echo $productos["p_name"]; ?>">
												<?php echo $productos["p_name"]; ?>
												<span class="count-item">(<?php echo $productos["Total"]; ?>)</span>
											</a>
										</li>
								<?php
									}
								}
								?>

							</ul>
						</li>
						<li class="level0 parent">
							<a href="#" title="Business Cards">
								<span>Business Cards</span>
								<i class="fa fa-minus"></i><i class="fa fa-plus"></i>
							</a>
							<ul class="level0">
								<?php
								if (!empty($bussiness_cards)) {
									foreach ($bussiness_cards as $bussiness) {
								?>
										<li class="level1 nav-1-1 item">
											<a href="#" title="<?php echo $bussiness["sp_name"]; ?>">
												<?php echo $bussiness["sp_name"]; ?>
											</a>
										</li>
								<?php
									}
								}
								?>
							</ul>
						</li>
						<?php
						if (!empty($not_bussiness_cards)) {
							foreach ($not_bussiness_cards as $notbussiness) {
						?>
								<li class="level0">
									<a href="#" title="<?php echo $notbussiness["p_name"]; ?>">
										<?php echo $notbussiness["p_name"]; ?>
										<span class="count-item">(<?php echo $notbussiness["Total"]; ?>)</span>
									</a>
								</li>
						<?php
							}
						}
						?>
					</ul>
					<div class="category-left-banner">
						<a href="#" title="category left banner">
							<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner02']; ?>"> </a>
					</div>
				</aside>
				<!--Category product grid : Begin -->
				<section class="category grid col-sm-9 col-xs-12">
					<div class="row">
						<div class="col-xs-12 category-image visible-md visible-lg">
							<a href="#" title="category image">
								<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner01']; ?>">
							</a>
						</div>
						<div class="col-xs-12 category-image visible-sm">
							<a href="#" title="category image">
								<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner01']; ?>">
							</a>
						</div>
						<div class="col-xs-12 category-image visible-xs">
							<a href="#" title="category image">
								<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner01']; ?>">
							</a>
						</div>
					</div>

					<div class="row products-grid category-product">
						<ul>
							<?php
							if (!empty($product_array)) {
								foreach ($product_array as $product) {
							?>
									<li class="pro-item col-md-4 col-sm-6 col-xs-12">
										<div class="product-image-action">
											<img src="<?php echo base_url(); ?>assets/images/products/<?php echo $product['p_id'] ?>/profile/<?php echo $product['p_image']; ?>" alt="<?php echo $product["p_name"]; ?>">
										</div>
										<div class="product-info">
											<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $product['p_name']); ?>/<?php echo $product['p_id']; ?>" title="<?php echo $product["p_name"]; ?>" class="product-name"><?php echo $product["p_name"]; ?></a>
											<div class="price-box" style="margin-top: -10px;">
												<a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $product['p_name']); ?>/<?php echo $product['p_id']; ?>" class="btn-readmore order-now">View More</a>
											</div>

										</div>
									</li>
								<?php  }
							} else { ?>
								<h1 style="width:100%;text-align:center;">No Product Found</h1>
							<?php } ?>
						</ul>
					</div>

				</section><!-- Category product grid : End -->
			</div>
			<div class="row">
				<div class="col-md-12 visible-md visible-lg cate-bottom-banner">
					<a href="#" title="category bottom banner">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner03']; ?>">
					</a>
				</div>
				<div class="col-sm-12 visible-sm cate-bottom-banner">
					<a href="#" title="category bottom banner">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner03']; ?>">
					</a>
				</div>
				<div class="col-xs-12 visible-xs cate-bottom-banner">
					<a href="#" title="category bottom banner">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner03']; ?>">
					</a>
				</div>
			</div>
		</div>
	</section>
</main><!-- Main Category: End -->
<!--Footer : Begin-->