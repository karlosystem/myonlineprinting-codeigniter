<style>
	.right_content {
		width: 655px;
		float: right;
	}

	label.error {
		width: 50%;
	}
</style>

<div class="content p-5">
	<h2><?php echo $title ?></h2>

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
	<form action="<?php echo base_url(); ?>admin/products/save_product" id="add_product_form" name="add_product_form" method="POST" enctype="multipart/form-data">
		<ol>
			<li>
				<p>Product Name<span class="red">*</span></p>
				<input type="text" name="p_name" id="p_name" class="input-xlarge text">
			</li>
			<li>
				<p>Product Order<span class="red">*</span></p>
				<input type="text" name="p_order" id="p_order" class="input-xlarge text">
			</li>
			<li>
				<p>Meta Title<span class="red">*</span></p>
				<input type="text" name="p_metatitle" id="p_metatitle" class="input-xlarge text">
			</li>
			<li>
				<p>Meta Description<span class="red">*</span></p>
				<input type="text" name="p_metadescription" id="p_metadescription" class="input-xlarge text">
			</li>
			<li>
				<p>Meta Keywords<span class="red">*</span></p>
				<input type="text" name="p_metakeywords" id="p_metakeywords" class="input-xlarge text">
			</li>
			<li>
				<p>Product Image<span class="red">*</span></p>
				<input type="file" name="p_image" id="p_image" class="form-control">
			</li>
			<li>
				<p>Product Description<span class="red">*</span></p>
				<textarea name="p_desc" id="p_desc" class="input-xlarge text"></textarea>
			</li>
			<li>
				<p>About<span class="red">*</span></p>
				<textarea name="p_about" id="p_about" class="input-xlarge text"></textarea>
			</li>
			<li>
				<p>Paper Type<span class="red">*</span></p>
				<textarea name="p_paper" id="p_paper" class="input-xlarge text"></textarea>
			</li>
			<li>
				<p>Product Turnaround<span class="red">*</span></p>
				<textarea name="p_turnaround" id="p_turnaround" class="input-xlarge text"></textarea>
			</li>
			<li>
				<p>Artwork Guide<span class="red">*</span></p>
				<textarea name="p_artwork" id="p_artwork" class="input-xlarge text"></textarea>
			</li>
			<li>
				<p>Date</p>
				<input type="text" name="p_date" id="p_date" class="input-xlarge text" />
			</li>

			<li>
				<p>Destacado</p>
				<input type="checkbox" name="p_destacado" id="p_destacado" value="1" />
			</li>
			<li>
				<p>Promocion</p>
				<input type="checkbox" name="p_promocion" id="p_promocion" value="1" />
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