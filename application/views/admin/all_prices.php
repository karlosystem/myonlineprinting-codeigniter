<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
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
					Product
				</th>
				<th scope="col" class="rounded">
					Subproducts
				</th>
				<th scope="col" class="rounded">
					Attributes
				</th>
				<th scope="col" class="rounded">
					Price
				</th>
				<th scope="col" class="rounded">
					Action
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($price_array)) {
				$cnt = 1;
				foreach ($price_array as $a) {

					$id = $a['pricing_id'];


			?>
					<tr>
						<td>
							<input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
						</td>
						<td>
							<?php echo $cnt; ?>
						</td>

						<td>
							<?php
							if (!empty($a['p_id'])) {
								$tbl_name = "exp_tbl_products";
								$col = "p_id";
								$value = $a['p_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['p_name'])) {
									echo $result['p_name'];
								}
							}
							?>
						</td>
						<td>
							<?php if (!empty($a['sp_id'])) {

								$tbl_name = "exp_tbl_sub_products";
								$col = "sp_id";
								$value = $a['sp_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['sp_name'])) {
									echo $result['sp_name'];
								}
							} ?>
						</td>
						<td>
							<?php if (!empty($a['combination'])) {
								$c_array = explode(",", $a['combination']);

								foreach ($c_array as $c) {
									$tbl_name = "exp_tbl_attribute_values";
									$col = "value_id";
									$value = $c;
									$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
									if (!empty($result['value_name'])) {
										echo $result['value_name'] . ",<br/>";
									}
								}
							} ?>
						</td>
						<td>
							<?php if (!empty($a['price'])) {
								echo $a['price'];
							} ?>
						</td>
						<td>
							<a href="<?php echo base_url(); ?>admin/pricing/edit_pricing/<?php echo $id; ?>">Edit Price</a>
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
		<a href="<?php echo base_url(); ?>admin/pricing/all_products_pricing" class="bt_green"><span class="bt_green_lft"></span><strong>Add Price</strong><span class="bt_green_r"></span></a>

		<a href="#" class="bt_red" onclick="delete_item('exp_tbl_pricing','pricing_id')"><span class="bt_red_lft"></span><strong>Delete Price</strong><span class="bt_red_r"></span></a>
	</div>

	<?php generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>