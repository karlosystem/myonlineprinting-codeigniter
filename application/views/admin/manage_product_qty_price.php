<div class="right_content" >
<h2><?php echo $title; ?></h2>
<?php 
if ( $this->session->userdata("valid_box") ) 
{
echo "<div class='valid_box'>";
echo $this->session->userdata("success_message");
$this->session->unset_userdata("valid_box");
$this->session->unset_userdata("success_message");
echo "</div>";	
}
else if ( $this->session->userdata("error_box") ) 
{
	echo "<div class='error_box'>";
	echo $this->session->userdata("success_message");
	$this->session->unset_userdata("error_box");
	$this->session->unset_userdata("success_message");
	echo "</div>";
}
?>
	<div id="warning_box1"></div>	
		<table id="rounded-corner" >
				<thead>
				<tr>
				
				<th scope="col" class="rounded-company">
					<input type="checkbox" name="main_checkbox" id="main_checkbox"  onclick="checkall();"/>
				</th>
				<th scope="col" class="rounded">
					Sr. No.
				</th>
				<th scope="col" class="rounded">
					Cat name
				</th>
				<th scope="col" class="rounded">
					Attribute Name
				</th>
				<th scope="col" class="rounded">
					Turnaround
				</th>
				<th scope="col" class="rounded">
					Print
				</th>
				<th scope="col" class="rounded">
					Qty Option
				</th>
				<th scope="col" class="rounded">
					Qty
				</th>
				<th scope="col" class="rounded">
					 Qty Price
				</th>
				<th scope="col" class="rounded-q4">
					Edit
				</th>
				</tr>
				</thead>
				<tbody>
					<?php 
					//debug($all_products_qty_pric);
					
					if(!empty($all_products_qty_pric))
					{
					$cnt = 1;
					foreach($all_products_qty_pric as $p_cat)
					{
					
					$id= $p_cat['p_qty_price_id'];
					
						
					?>
							<tr>
								
									<td>
										<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
									</td>
									<td>
										<?php echo $cnt;?>
									</td>
									<td>
										<?php if(!empty($p_cat['p_cat_name'])){ echo $p_cat['p_cat_name']; }?>
									</td>
									<td>
										<?php if(!empty($p_cat['p_a_type'])){ echo $p_cat['p_a_type']; }?>
									</td>
									<td>
										<?php if(!empty($p_cat['p_qty_option_name'])){ echo $p_cat['p_qty_option_name']; }?>
									</td>
									<?php if($p_cat['p_color'] == '1') { ?>
									<td>
										<?php if(!empty($p_cat['p_color'])){ echo "Full Print 1 Side"; } ?>
									</td>
									<?php } else { ?>
									<td>
										<?php if(!empty($p_cat['p_qty_option_name'])){ echo "Full Print 2 Side"; }?>
									</td>
									<?php } ?>
									<?php if($p_cat['p_turnaround'] == '1') { ?>
									<td>
										<?php if(!empty($p_cat['p_color'])){ echo "48 Hour Dispatch"; }?>
									</td>
									<?php } else { ?>
									<td>
										<?php if(!empty($p_cat['p_qty_option_name'])){ echo "5 Day Dispatch"; }?>
									</td>
									<?php } ?>
									<td>
										<?php if(!empty($p_cat['p_qty'])){ echo $p_cat['p_qty']; }?>
									</td>
									<td>
										<?php if(!empty($p_cat['p_price'])){ echo CURRENCY.' '.$p_cat['p_price']; }?>
									</td>
								
									<td>
										<a href="<?php echo base_url(); ?>admin/products/edit_p_qty_option_price/<?php echo $id; ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" alt="" title="" border="0" /></a>
									</td>
								
							</tr>
					<?php $cnt++; }} else { ?>
						<tr>
									<td colspan='7' style='text-align:center'><b>No Record Found</b></td>
						</tr>
					<?php } ?>
					</tbody>
		</table>
	<div style="float:right;margin-right:25px">


	<span style="float:right;margin-top:10px;display:none" class="loader"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif"></span>	
	<a href="javascript:void(0)" onclick="delete_item('exp_tbl_products_qty_price','p_qty_price_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete items</strong><span class="bt_red_r"></span></a>
	<a href="<?php echo base_url(); ?>admin/products/add_product_qty_option_price" class="bt_green"><span class="bt_green_lft"></span><strong>Add new item</strong><span class="bt_green_r"></span></a>
	</div>
	<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>