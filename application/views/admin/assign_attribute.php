<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_products';
$product_array = $this->common_model->get_all_list($tbl_name);


$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_attributes';
$attrib_array = $this->common_model->get_all_list($tbl_name);
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


	<form action="<?php echo base_url(); ?>admin/assign_attributes/save" id="assign_attribute_form" name="assign_attribute_form" class="contact-form" method="POST">


		<ol>

			<li>
				<p>Select Product<span class="red">*</span></p>
				<select type="text" name="p_id" id="p_id" class="input-xlarge text" onchange="get_subproducts(this.value)">
					<option value="">Select Product</option>
					<?php
					foreach ($product_array as $a) { ?>
						<option value="<?php echo $a['p_id'] ?>"><?php echo $a['p_name']; ?></option>

					<?php  } ?>
				</select>
			</li>
			<li>
				<p>Select Subproduct<span class="red">*</span></p>
				<select type="text" name="sp_id" id="sp_id" class="input-xlarge text">
					<option value="">Select Subproduct</option>
				</select>
			</li>

			<li>
				<p>Select Attribute<span class="red">*</span></p>
				<select type="text" name="att_id" id="att_id" class="input-xlarge text" onchange="get_attrib_value(this.value)">
					<option value="">Select Attribute</option>
					<?php
					foreach ($attrib_array as $a) { ?>
						<option value="<?php echo $a['att_id'] ?>"><?php echo $a['att_name']; ?></option>

					<?php  } ?>
				</select>
			</li>

			<li>
				<p>Select Attribute value<span class="red">*</span></p>
				<select type="text" name="value_id" id="value_id" class="input-xlarge text">
					<option value="">Select attribute value</option>
				</select>
			</li>
			<li>
				<div style="margin-left:130px;">
					<span class="bt_green_lft"></span>
					<input type="submit" value="Assign" class="submit_btn" />
					<span class="bt_green_r"></span>
				</div>
				<span class="loader" style="margin-left:10px;display:none"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif" /></span>
			</li>

		</ol>

	</form>

</div>
<!-- end of right content-->
</div>