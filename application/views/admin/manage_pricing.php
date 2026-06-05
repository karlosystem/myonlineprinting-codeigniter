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
					Name
				</th>
				<th scope="col" class="rounded-q4">
					Edit
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($all_pricing)) {
				foreach ($all_pricing as $a) {
					$cnt = 1;
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
							<?php if (!empty($a['att_name'])) {
								echo $a['att_name'];
							} ?>
						</td>

						<td>
							<a href="<?php echo base_url(); ?>admin/attributes/edit_attribute/<?php if (!empty($a['att_id'])) {
																																									echo $a['att_id'];
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
		<a href="<?php echo base_url(); ?>admin/pricing/add" class="bt_green"><span class="bt_green_lft"></span><strong>Add Price</strong><span class="bt_green_r"></span></a>

		<a href="#" class="bt_red" onclick="delete_item('exp_tbl_assigned_attributes','pricing_id')"><span class="bt_red_lft"></span><strong>Delete </strong><span class="bt_red_r"></span></a>
	</div>
	<?php generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>