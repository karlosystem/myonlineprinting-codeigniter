<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
//debug($assigned_attributes);
?>
<style>
	.right_content {
		width: 655px;
		float: right;
	}
</style>
<div class="right_content">
	<div id="warning_box1"></div>
	<h2><?php echo $title; ?></h2>

	<table id="rounded-corner">
		<thead>
			<tr>

				<th scope="col" class="rounded-company">

					<input type="checkbox" name="main_checkbox" id="main_checkbox" onclick="checkall();" />

				</th>
				<th scope="col" class="rounded">
					Sr No
				</th>

				<th scope="col" class="rounded">
					Product Name
				</th>

				<th scope="col" class="rounded">
					Subproduct Name
				</th>

				<th scope="col" class="rounded">
					Attribute Name
				</th>


				<th scope="col" class="rounded">
					Value
				</th>
				<th scope="col" class="rounded-q4">
					Edit
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($assigned_attributes)) {
				$cnt = 1;
				foreach ($assigned_attributes as $v) {

					$id = $v['id'];


			?>
					<tr>
						<td>
							<input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
						</td>
						<td>
							<?php echo $cnt; ?>
						</td>

						<td>
							<?php if (!empty($v['p_id'])) {

								$tbl_name = "exp_tbl_products";
								$col = "p_id";
								$value = $v['p_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['p_name'])) {
									echo $result['p_name'];
								}
							} ?>
						</td>
						<td>
							<?php if (!empty($v['sp_id'])) {
								$tbl_name = "exp_tbl_sub_products";
								$col = "sp_id";
								$value = $v['sp_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['sp_name'])) {
									echo $result['sp_name'];
								}
							} ?>
						</td>
						<td>
							<?php if (!empty($v['att_id'])) {
								$tbl_name = "exp_tbl_attributes";
								$col = "att_id";
								$value = $v['att_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['att_name'])) {
									echo $result['att_name'];
								}
							} ?>
						</td>
						<td>
							<?php if (!empty($v['val_id'])) {
								$tbl_name = "exp_tbl_attribute_values";
								$col = "value_id";
								$value = $v['val_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['value_name'])) {
									echo $result['value_name'];
								}
							} ?>
						</td>
						<td>
							<a href="<?php echo base_url(); ?>admin/assign_attributes/edit/<?php if (!empty($id)) {
																																								echo $id;
																																							} ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" alt="" title="" border="0" /></a>
						</td>

					</tr>
				<?php $cnt++;
				}
			} else { ?>
				<tr>
					<td colspan="9" style="text-align:center">No record found</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<div style="float:right;margin-right:25px">

		<span style="float:right;margin-top:10px;display:none" class="loader"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif"></span>
		<a href="<?php echo base_url(); ?>admin/assign_attributes/assign_new_attribute" class="bt_green"><span class="bt_green_lft"></span><strong>Assign Attribute</strong><span class="bt_green_r"></span></a>

		<a href="#" class="bt_red" onclick="delete_item('exp_tbl_assigned_attributes','id')"><span class="bt_red_lft"></span><strong>Delete</strong><span class="bt_red_r"></span></a>
	</div>
	<?php generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>