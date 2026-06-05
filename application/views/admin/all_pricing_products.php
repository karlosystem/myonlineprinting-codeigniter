<?php

//debug($product_array);

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
					Name
				</th>
				<th scope="col" class="rounded">
					Subproducts
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($product_array)) {
				$cnt = 1;
				foreach ($product_array as $a) {

					$id = $a['p_id'];


			?>
					<tr>
						<td>
							<input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
						</td>
						<td>
							<center>
								<?php echo $cnt; ?></center>
						</td>

						<td>
							<center><?php if (!empty($a['p_name'])) {
												echo $a['p_name'];
											} ?></center>
						</td>

						<td>
							<center><a href="<?php echo base_url(); ?>admin/pricing/all_subproducts/<?php if (!empty($a['p_id'])) {
																																												echo $a['p_id'];
																																											} ?>"><img src="<?php echo base_url(); ?>assets/images/admin/user_edit.png" alt="" title="" border="0" /></a></center>
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


	<?php generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>