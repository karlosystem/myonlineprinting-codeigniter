	<!--Main index : End-->
	<main class="main">
		<section class="header-page">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 hidden-xs">
						<h1 class="mh-title"><?php if (!empty($page["page_name"])) {
																		echo $page["page_name"];
																	}  ?></h1>
					</div>
					<div class="breadcrumb-w col-sm-9">
						<span class="hidden-xs">You are here:</span>
						<ul class="breadcrumb">
							<li>
								<a href="/">Home</a>
							</li>
							<li>
								<span><?php if (!empty($page["page_name"])) {
												echo $page["page_name"];
											}  ?></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section id="aboutus" class="pr-main">
			<div class="container">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<img src="<?php echo base_url(); ?>assets/images/admin/main_page_image/<?php echo $page['page_id']; ?>/thumbs/<?php echo $page['page_image']; ?>">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="top">
						<h2><span><?php if (!empty($page["page_name"])) {
												echo $page["page_name"];
											}  ?></span></h2>
						<?php if (!empty($page["page_description"])) {
							echo $page["page_description"];
						}  ?>
					</div>

				</div>

			</div>
		</section>

	</main>
	<!--Main index : End-->