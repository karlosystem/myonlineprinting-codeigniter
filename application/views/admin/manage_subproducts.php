<?php
//debug($subproducts);

?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/blue/style.css" media="screen" />
<script>
	$(document).ready(function() {
		$("#myTable").tablesorter({
			// sort on the first column and third column, order asc 
			headers: {
				0: {
					sorter: false
				},
				1: {
					sorter: false
				},
				4: {
					sorter: false
				},
				5: {
					sorter: false
				},
				6: {
					sorter: false
				}
			}
		});
	});
</script>
<style>
	.right_content {
		width: 655px;
		float: right;
	}

	.header {
		width: auto;
		height: auto;
	}
</style>
<div class="right_content">
	<h2><?php echo $title; ?></h2>
	<div id="warning_box1"></div>

	<table id="myTable" class="tablesorter">
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
					Image
				</th>

				<!--<th scope="col" class="rounded">
	Status
</th>-->
				<th scope="col" class="rounded">
					Special status
				</th>
				<th scope="col" class="rounded">
					Edit
				</th>

			</tr>
		</thead>

		<tbody>
			<?php
			if (!empty($subproducts)) {
				$cnt = 1;
				foreach ($subproducts as $p) {

					$id = $p['sp_id'];

					if ($p['sp_status'] == '1') {
						$str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'sp_status\',\'0\', \'sp_id\',\'' . $id . '\');" />';
					} else {
						$str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'sp_status\',\'1\', \'sp_id\',\'' . $id . '\');" />';
					}

					if ($p['special_status'] == '1') {
						$str_special = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'special_status\',\'0\', \'sp_id\',\'' . $id . '\');" />';
					} else {
						$str_special = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'special_status\',\'1\', \'sp_id\',\'' . $id . '\');" />';
					}
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
							if (!empty($p['p_id'])) {
								$tbl_name = "exp_tbl_products";
								$col = "p_id";
								$value = $p['p_id'];
								$result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
								if (!empty($result['p_name'])) {
									echo $result['p_name'];
								}
							} ?>
						</td>
						<td>
							<?php if (!empty($p['sp_name'])) {
								echo $p['sp_name'];
							} ?>
						</td>
						<td>
							<?php if (!empty($p['sp_name'])) { ?>
								<img src="<?php echo base_url(); ?>assets/images/subproducts/<?php echo $p['sp_id'] ?>/thumbs/<?php echo $p['sp_image']; ?>" style="width:80px;height:80px;">
							<?php } ?>
						</td>

						<!--<td>
										<?php echo $str; ?>
									</td>-->
						<td>
							<?php echo $str_special; ?>
						</td>
						<td>
							<a href="<?php echo base_url(); ?>admin/sub_products/edit_subproduct/<?php echo $id; ?>">
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
	<div style="float:right;margin-right:25px">

		<span style="float:right;margin-top:10px;display:none" class="loader"><img src="<?php echo base_url(); ?>assets/images/admin/ajax-loader.gif"></span>
		<a href="javascript:void(0)" onclick="delete_subproduct('exp_tbl_sub_products','sp_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete subproduct</strong><span class="bt_red_r"></span></a>

		<a href="<?php echo base_url(); ?>admin/sub_products/add_subproduct" class="bt_green"><span class="bt_green_lft"></span><strong>Add Subproduct</strong><span class="bt_green_r"></span></a>
	</div>
	<?php generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>