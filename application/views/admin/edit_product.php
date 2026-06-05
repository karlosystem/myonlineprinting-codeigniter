<style>
	.right_content {
		width: 655px;
		float: right;
	}
</style>

<div class="right_content" style="min-height:400px;">
	<h2><?php echo $title ?></h2>
	<?php
	if ($this->session->userdata("valid_box")) {
		echo "<div class='valid_box'>";
		echo $this->session->userdata("success_message");
		$this->session->unset_userdata("success_message");
		$this->session->unset_userdata("valid_box");
		echo "</div>";
	} else if ($this->session->userdata("error_box")) {
		echo "<div class='error_box'>";
		echo $this->session->userdata("success_message");
		$this->session->unset_userdata("success_message");
		$this->session->unset_userdata("error_box");
		echo "</div>";
	}
	?>
	<form action="<?php echo base_url(); ?>admin/products/update_product" id="add_product_form" name="add_product_form" class="contact-form" method="POST" enctype="multipart/form-data">

		<input type="hidden" name="p_id" value="<?php echo $result['p_id'] ?>">
		<input type="hidden" id="	old_image" name="old_image" value="<?php echo $result['p_image']; ?>" />
		<ol>
			<li>
				<p>Product Name<span class="red">*</span></p>
				<input type="text" name="p_name" id="p_name" class="input-xlarge text" value="<?php if (!empty($result['p_name'])) {
																																												echo $result['p_name'];
																																											} ?>">
			</li>
			<li>
				<p>Product Order<span class="red">*</span></p>
				<input type="text" name="p_order" id="p_order" class="input-xlarge text" value="<?php if (!empty($result['p_order'])) {
																																													echo $result['p_order'];
																																												} ?>">
			</li>
			<li>
				<p>Meta Title<span class="red">*</span></p>
				<input type="text" name="p_metatitle" id="p_metatitle" class="input-xlarge text" value="<?php if (!empty($result['p_meta_title'])) {
																																																	echo $result['p_meta_title'];
																																																} ?>">
			</li>
			<li>
				<p>Meta Description<span class="red">*</span></p>
				<textarea class="input-xlarge text" name="p_metadescription" id="p_metadescription" cols="30" rows="10"><?php if (!empty($result['p_meta_description'])) {
																																																									echo $result['p_meta_description'];
																																																								} ?></textarea>
			</li>
			<li>
				<p>Meta Keywords<span class="red">*</span></p>
				<input type="text" name="p_metakeywords" id="p_metakeywords" class="input-xlarge text" value="<?php if (!empty($result['p_meta_keywords'])) {
																																																				echo $result['p_meta_keywords'];
																																																			} ?>">
			</li>
			<li>
				<p>Product Image<span class="red">*</span></p>
				<input type="file" name="p_image" id="p_image" class="input-xlarge text">
			</li>
			<li>
				<p>Product Image<span class="red">*</span></p>
				<img src="<?php echo base_url(); ?>assets/images/products/<?php echo $result['p_id']; ?>/thumbs/<?php echo $result['p_image'] ?>" style="width:80px;">

			<li>
				<p>Product Description<span class="red">*</span></p>
				<textarea name="p_desc" id="p_desc" class="input-xlarge text"><?php if (!empty($result['p_discription'])) {
																																				echo $result['p_discription'];
																																			} ?></textarea>
			</li>
			<li>
				<p>About<span class="red">*</span></p>
				<textarea name="p_about" id="p_about" class="input-xlarge text"> <?php if (!empty($result['p_about'])) {
																																						echo $result['p_about'];
																																					} ?></textarea>
			</li>
			<li>
				<p>Paper Type<span class="red">*</span></p>
				<textarea name="p_paper" id="p_paper" class="input-xlarge text"><?php if (!empty($result['p_paper_type'])) {
																																					echo $result['p_paper_type'];
																																				} ?></textarea>
			</li>
			<li>
				<p>Product Turnaround<span class="red">*</span></p>
				<textarea name="p_turnaround" id="p_turnaround" class="input-xlarge text"><?php if (!empty($result['p_trunaround'])) {
																																										echo $result['p_trunaround'];
																																									} ?></textarea>
			</li>
			<li>
				<p>Artwork Guide<span class="red">*</span></p>
				<textarea name="p_artwork" id="p_artwork" class="input-xlarge text"><?php if (!empty($result['p_free_artwork_guide'])) {
																																							echo $result['p_free_artwork_guide'];
																																						} ?></textarea>
			</li>

			<li>
				<p>Date</p>
				<input type="text" name="p_date" id="p_date" class="input-xlarge text" value="<?php if (!empty($result['date'])) {
																																												echo $result['date'];
																																											} ?>" />
			</li>
			<li>
				<p>Destacado</p>
				<input type="checkbox" name="p_destacado" id="p_destacado" value="1" <?php if ($result['p_destacado'] == 1) echo "checked"; ?> />
			</li>
			<li>
				<p>Promocion</p>
				<input type="checkbox" name="p_promocion" id="p_promocion" value="1" <?php if ($result['p_promocion'] == 1) echo "checked"; ?> />
			</li>

			<li>
				<div style="margin-left:130px;">
					<span class="bt_green_lft"></span>
					<input type="submit" value="Submit" class="submit_btn" />
					<span class="bt_green_r"></span>
				</div>
			</li>

		</ol>

	</form>

</div>
<!-- end of right content-->
</div>