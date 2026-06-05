<?php
//debug($slider);

?>
<style>
	.right_content {
		width: 655px;
		float: right;
	}

	#rounded-corner td {
		text-align: center;
	}

	#rounded-corner th {
		text-align: center;
	}
</style>
<div class="right_content">
	<h2><?php if (!empty($title)) {
				echo $title;
			} ?></h2>
	<div id="warning_box1"></div>

	<table id="rounded-corner">
		<thead>
			<tr>
				<th scope="col" class="rounded-company">

					<input type="checkbox" name="main_checkbox" id="main_checkbox" onclick="checkall();" />

				</th>
				<th scope="col" class="rounded" style="width:10%;">
					Sr No
				</th>
				<th scope="col" class="rounded">
					User Name
				</th>
				<th scope="col" class="rounded">
					User Email
				</th>
				<th scope="col" class="rounded" style="width:20%;">
					Total Amount (<?php echo CURRENCY; ?>)
				</th>
				<th scope="col" class="rounded">
					Date
				</th>

				<th scope="col" class="rounded">
					Detail
				</th>

			</tr>
		</thead>

		<tbody>
			<?php
			if (!empty($order_array)) {
				$cnt = 1;
				foreach ($order_array as $order) {

					$id = $order['order_id'];


			?>
					<tr>

						<td>
							<input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
						</td>
						<td><?php echo $cnt; ?></td>
						<td>
							<?php if (!empty($order['cust_id'])) {



								$tbl_name = "exp_tbl_users";
								$col = "u_id";
								$value = $order['cust_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['u_name'])) {
									echo $result['u_name'];
								}
							} ?></td>
						<td><?php if (!empty($order['bill_email'])) {
									echo $order['bill_email'];
								} ?></td>
						<td><?php if (!empty($order['total_amt'])) {
									echo $order['total_amt'];
								} ?>
						</td>
						<td><?php if (!empty($order['order_date'])) {
									echo $order['order_date'];
								} ?></td>
						<td>
							<a href="<?php echo base_url(); ?>admin/order/order_detail/<?php echo $id; ?>">
								<img src="<?php echo base_url(); ?>assets/images/admin/user_edit.png" /></a>
						</td>

					</tr>
				<?php $cnt++;
				}
			} else { ?>
				<tr>
					<td colspan='8' style='text-align:center'><b>No Record Found</b></td>
				</tr>
			<?php } ?>
		</tbody>



	</table>

	<div style="float:right;margin-right:60px">

		<span style="float:right;margin-top:10px;display:none" class="loader">
			<img src="<?php echo base_url(); ?>assets/images/admin/ajax-loader.gif"></span>

		<a href="javascript:void(0)" onclick="delete_main_slider('exp_tbl_orders','order_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete Order</strong><span class="bt_red_r"></span></a>


	</div>

	<?php generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>