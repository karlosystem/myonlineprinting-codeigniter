<?php
//$assign_attributes come from controller




$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_products';
$product_array = $this->common_model->get_all_list($tbl_name);


$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_attributes';
$attrib_array = $this->common_model->get_all_list($tbl_name);


//getting all sub product name
$tbl_name = 'exp_tbl_sub_products';
$col = "p_id";
$p_id = $assign_attributes['p_id'];
$subproduct_array = $this->common_model->get_item_by_id($tbl_name, $col, $p_id);


//getting  all value name
$tbl_name = 'exp_tbl_attribute_values';
$col = "att_id";
$sp_id = $assign_attributes['att_id'];
$value_array = $this->common_model->get_item_by_id($tbl_name, $col, $sp_id);

?>
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


	<form action="<?php echo base_url(); ?>admin/assign_attributes/update" id="add_attribute_form" name="add_attribute_form" class="contact-form" method="POST">
		<input type="hidden" name="id" value="<?php echo $assign_attributes['id']; ?>">

		<ol>

			<li>
				<p>Select Product<span class="red">*</span></p>
				<select type="text" name="p_id" id="p_id" class="input-xlarge text" onchange="get_subproducts(this.value)">
					<option value="">Select Product</option>
					<?php
					if (!empty($product_array)) {
						foreach ($product_array as $a) { ?>
							<option value="<?php echo $a['p_id'] ?>" <?php if ($a['p_id'] == $assign_attributes['p_id']) {
																													echo  "selected='selected'";
																												} ?>><?php echo $a['p_name']; ?></option>

					<?php  }
					} ?>
				</select>
			</li>
			<li>
				<p>Select Subproduct<span class="red">*</span></p>
				<select type="text" name="sp_id" id="sp_id" class="input-xlarge text">
					<?php
					if (!empty($subproduct_array)) {
						foreach ($subproduct_array as $s) { ?>
							<option value="<?php echo $s['sp_id'] ?>" <?php if ($s['sp_id'] == $assign_attributes['sp_id']) {
																													echo "selected='selected'";
																												} ?>><?php echo $s['sp_name'] ?></option>
					<?php }
					} ?>

				</select>
			</li>

			<li>
				<p>Select Attribute<span class="red">*</span></p>
				<select type="text" name="att_id" id="att_id" class="input-xlarge text" onchange="get_attrib_value(this.value)">
					<option value="">Select Attribute</option>
					<?php
					if (!empty($attrib_array)) {
						foreach ($attrib_array as $a) { ?>
							<option value="<?php echo $a['att_id'] ?>" <?php if ($a['att_id'] == $assign_attributes['att_id']) {
																														echo  "selected='selected'";
																													} ?>><?php echo $a['att_name']; ?></option>

					<?php  }
					} ?>
				</select>
			</li>

			<li>
				<p>Select Attribute Value<span class="red">*</span></p>
				<select type="text" name="value_id" id="value_id" class="input-xlarge text">
					<option value="<?php echo $value_array['value_id'];  ?>" <?php if ($value_array['value_id'] == $assign_attributes['val_id']) {
																																			echo  "selected='selected'";
																																		} ?>><?php echo $value_array['value_name'];  ?></option>
				</select>
			</li>
			<li>
				<div style="margin-left:130px;">
					<span class="bt_green_lft"></span>
					<input type="submit" value="Update" class="submit_btn" />
					<span class="bt_green_r"></span>
				</div>
				<span class="loader" style="margin-left:10px;display:none"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif" /></span>
			</li>

		</ol>

	</form>

</div>
<!-- end of right content-->
</div>