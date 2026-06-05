<?php

$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_countries';
$all_countries = $CI->common_model->get_all_list($tbl_name);

?>
<?php
require('Pest/PestJSON.php');
$apiClient = new PestJSON('http://api.templatecloud.com/sandbox');
$apiClient->setupAuth('manoj123', 'admin123');
$tcapi_key = 'd5f111e77c683150cb80860e197a66d0';
//debug($all_saved_design);
?>

<style>
	.amount_detail_table {
		margin-right: 30px;
		width: 300px;
		text-align: left;
		border-collapse: collapse;
		float: right;
	}

	.amount_detail_table td {
		padding: 8px;
		background: #D2E7F0;
		border-top: 1px solid #fff;
		color: #669;
	}

	.amount_detail_table th {
		padding: 8px;
		font-weight: normal;
		font-size: 13px;
		color: #039;
		background: #60c8f2;
	}

	.order_detail_table {

		margin: 0px;
		width: 625px;
		text-align: left;
		border-collapse: collapse;
	}

	.order_detail_table tr {

		background: #ecf8fd;

	}

	.order_detail_table td {
		padding: 8px;
		background: #D2E7F0;
		border-top: 1px solid #fff;
		color: #669;
	}

	.item_detail_table {

		margin: 0px;
		width: 625px;
		text-align: left;
		border-collapse: collapse;
	}

	.item_detail_table tr td {
		padding: 8px;
		background: #D2E7F0;
		border-top: 1px solid #fff;
		color: #669;
	}

	.item_detail_table tr th {
		padding: 8px;
		font-weight: normal;
		font-size: 13px;
		color: #039;
		background: #60c8f2;
	}

	.right_content {
		width: 655px;
		float: right;
	}

	.order_detail_td {
		color: black;
		font-weight: bold;
		font-size: 13px;
	}

	.style3 {

		float: none;
		padding: 10px 0px 10px 0px;
		font-weight: bold;
	}
</style>
<div class="right_content">
	<div id="main">
		<div class="full_w">
			<h2><?php echo $title ?></h2>
		</div>


		<?php

		if (!empty($order)) { ?>

			<div class="boxMain">

				<h3 style="font-size:14px;" class="style3">BILLING INFORMATION :</h3>

				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_detail_table">

					<tr>

						<td class="order_detail_td">User Name :</td>

						<td>
							<?php echo ($order['bill_f_name'] != "") ? $order['bill_f_name'] : "Not bentioned"; ?></td>

						<td class="order_detail_td">Company : </td>

						<td align="left" class="top">
							<?php echo $order['bill_c_name'] == "" ? "Not Mentioned" : $order['bill_c_name']; ?></td>



					</tr>



					<tr>
						<td class="order_detail_td">Country:</td>

						<td width="30%" class="top" align="left">
							<?php if (!empty($order["bill_country"])) {
								foreach ($all_countries as $row) {
									if ($row["country_id"] == $order["bill_country"]) {
										echo ($row['country_name']);
									}
								}
							} ?></td>
						<td class="order_detail_td">Street1 : </td>

						<td align="left" class="top">
							<?php echo ($order['bill_address1'] != "") ? $order['bill_address1'] : "Not Mentioned"; ?></td>


					</tr>



					<tr>
						<td class="order_detail_td">Street2 : </td>
						<td align="left" class="top">
							<?php echo ($order['bill_address2'] != "") ? $order['bill_address2'] : "Not Mentioned"; ?></td>
						<td class="order_detail_td">Zip : </td>

						<td align="left" class="top">
							<?php echo ($order['bill_postcode'] != "") ? $order['bill_postcode'] : "Not Mentioned"; ?></td>

					</tr>



					<tr>





						<td class="order_detail_td"> State : </td>

						<td align="left" class="top"> <?php

																					$state_id = $order['bill_town'];
																					$tbl = "exp_tbl_states";
																					$col = "state_id";
																					$state_name = $this->common_model->get_item_by_id($tbl, $col, $state_id);
																					if (!empty($state_name)) {
																						echo $state_name["state_name"];
																					} else {
																						echo "Not Mentioned";
																					}
																					?></td>

						<td class="order_detail_td"> Phone : </td>

						<td align="left" class="top">
							<?php echo ($order['bill_phone'] != "") ? $order['bill_phone'] : "Not Mentioned"; ?></td>

					</tr>
				</table>
				<h3 style="font-size:14px;" class="style3">SHIPPING INFORMATION :</h3>

				<div class="headingLine"></div>



				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_detail_table">



					<tr>

						<td class="order_detail_td">User Name :</td>

						<td width="30%" class="top" align="left">
							<?php echo ($order['ship_f_name'] != "") ? $order['ship_f_name'] : "Not Mentioned"; ?></td>
						<td class="order_detail_td">Company : </td>

						<td align="left" class="top">
							<?php echo $order['ship_c_name'] == "" ? "Not Mentioned" : $order['ship_c_name']; ?></td>




					<tr>



						<td class="order_detail_td">Country:</td>

						<td width="30%" class="top" align="left">
							<?php if (!empty($order["ship_country"])) {
								foreach ($all_countries as $row) {
									if ($row["country_id"] == $order["ship_country"]) {
										echo ($row['country_name']);
									}
								}
							} ?>
						</td>

						<td class="order_detail_td">Street1 : </td>

						<td align="left" class="top">
							<?php echo ($order['ship_address1'] != "") ? $order['ship_address1'] : "Not Mentioned"; ?></td>


					</tr>



					<tr>



						<td class="order_detail_td">Street2 : </td>

						<td align="left" class="top">
							<?php echo ($order['ship_address2'] != "") ? $order['ship_address2'] : "Not Mentioned"; ?></td>

						<td class="order_detail_td">Zip : </td>

						<td align="left" class="top">
							<?php echo ($order['ship_postcode'] != "") ? $order['ship_postcode'] : "Not Mentioned"; ?></td>

					</tr>



					<tr>





						<td class="order_detail_td"> State: </td>

						<td align="left" class="top">
							<?php
							$state_id = $order['ship_town'];
							$tbl = "exp_tbl_states";
							$col = "state_id";
							$state_name = $this->common_model->get_item_by_id($tbl, $col, $state_id);
							if (!empty($state_name)) {
								echo $state_name["state_name"];
							}
							?>
						</td>

						<td class="order_detail_td"> Phone : </td>

						<td align="left" class="top">
							<?php echo ($order['ship_phone'] != "") ? $order['ship_phone'] : "Not Mentioned"; ?></td>

					</tr>




				</table>
				<!-----------ordfer Items detail---------------->
				<h3 style="font-size:14px;" class="style3">ITEMS DETAIL :</h3>
				<table width="100%" class="item_detail_table">
					<tr>
						<th>Image</th>
						<th>Product</th>
						<th>SubProduct</th>
						<th>Attributes</th>
						<th>Size</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Shipping</th>
					</tr>
					<?php
					$total_amount = '';
					$total_shipping = '';
					$overall = 0;
					$order_id = $order['order_id'];
					$tbl_name = 'exp_tbl_order_items';
					$col = "o_id";
					$items_array = $CI->common_model->get_result_array_by_id($tbl_name, $col, $order_id);
					//debug($items_array);
					if (!empty($items_array)) {
						foreach ($items_array as $row) {
							if ($row['order_template_type'] == 'custom_template') {

								$template_id = $row['order_template_id'];
								$instance_id = $row['order_instance_id'];
								try {

									$result = $apiClient->get('/templates/' . $template_id . '?user_key=' . $tcapi_key . '&format=json&include=tags%2Csize%2Ccolour%2Ctags%2Ctag_group%2Cimages&filter_options=0&exclusive_tag_types=0');
								} catch (Exception $e) {
									die($e->getMessage());
								}
								//debug($result);

					?>
								<tr>
									<td><a href="<?php echo base_url(); ?>admin/template/edit_template/<?php echo $template_id; ?>/<?php echo $instance_id; ?>" target="_blank"><img src="<?php echo $result['template']['images'][0][0]; ?>" alt="" style="height: 70px;width: 100%;"></a></td>
									<td>Buisness Card</td>
									<td><?php echo $row['order_template_name']; ?></td>
									<td>NA</td>
									<td>NA</td>
									<td><?php echo $row['qty']; ?></td>
									<td><?php echo $row['p_amount']; ?></td>
									<td>
										<?php echo $row["p_ship_amount"];
										$total_shipping += (int)$row["p_ship_amount"]; ?>
									</td>
								</tr>
							<?php } else { ?>
								<tr>
									<td style="width:16%;">

										<?php
										$tbl_name = "exp_tbl_sub_products";
										$col = "sp_id";
										$subproduct = $CI->common_model->get_item_by_id($tbl_name, $col, $row["sp_id"]);
										if (!empty($subproduct)) { ?>
											<img src="<?php echo base_url() ?>images/subproducts/<?php echo $subproduct['sp_id'] ?>/thumbs/<?php echo $subproduct['sp_image'] ?>" style="height:70px;width:100%;">
											<br />
											<a href="<?php echo base_url(); ?>cart/download_file/<?php echo $row['r_id'] ?>/<?php echo $row['artwork_file'] ?>">Download File</a>
										<?php 	}
										?>

									</td>
									<td>
										<?php
										$tbl_name = "exp_tbl_products";
										$col = "p_id";
										$product_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["p_id"]);
										if (!empty($product_name)) {
											echo $product_name['p_name'];
										}
										?>
									</td>
									<td>
										<?php
										$tbl_name = "exp_tbl_sub_products";
										$col = "sp_id";
										$subproduct_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["sp_id"]);
										if (!empty($subproduct_name)) {
											echo $subproduct_name['sp_name'];
										}
										?>
									</td>
									<td>
										<?php
										$value_array =	explode(",", $row["att_combination"]);
										foreach ($value_array as $val) {
											$tbl_name = "exp_tbl_attribute_values";
											$col = "value_id";
											$value_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["sp_id"]);
											if (!empty($value_name)) {
												echo $value_name['value_name'] . ",";
											} else {
												echo 'NA';
											}
										}
										?>
									</td>
									<td>
										<?php
										$tbl_name = "tbl_size";
										$col = "size_id";
										$size_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["size"]);
										if (!empty($size_name)) {
											echo $size_name['size_name'];
										}
										?>
									</td>
									<td>
										<?php echo $row["qty"]; ?>
									</td>
									<td>
										<?php echo $row["p_amount"]; ?>
									</td>
									<td>
										<?php

										echo $row["p_ship_amount"];
										$total_shipping += (int)$row["p_ship_amount"];
										?>
									</td>
								</tr>


					<?php

							}
							$total_amount += (int)$row["p_amount"];
						}
					}
					?>
				</table>



				<table class="amount_detail_table">
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<td>
							<h4>Sub Total:</h4>
						</td>
						<td> <?php echo CURRENCY . $total_amount;  ?></td>
					</tr>
					<tr>
						<td>
							<h4>Vat(20%):</h4>
						</td>
						<td><?php

								$total = (int)$order["total_amt"];
								$vat = ($total_amount * 20) / 100;
								echo CURRENCY . $vat;
								?>
						</td>
					</tr>
					<tr>
						<td>
							<h4>Total Shipping:</h4>
						</td>
						<td><?php echo CURRENCY . $total_shipping; ?></td>
					</tr>
					<tr>
						<td>
							<h4>Total:</h4>
						</td>
						<td><?php
								$overall = $total_amount + $vat + $total_shipping;
								echo CURRENCY . number_format($overall, 2);

								?>
						</td>
					</tr>
				</table>


			</div>
			<!-----------end ordfer Items detail---------------->
	</div>

<?php } else {

			echo '<h1 align="center">NO INFORMATION</h1>';
		}

?>

</div>
</div>