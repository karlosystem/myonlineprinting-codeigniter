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
					Quantity
				</th>
				<th scope="col" class="rounded-q4">
					Edit
				</th>
				</tr>
				</thead>
				<tbody>
					<?php 
					if(!empty($qty_array))
					{
					$cnt = 1;
					foreach($qty_array as $qty)
					{
		
						$id= $qty['qty_id'];
						
						
					?>
							<tr>
								
									<td>
										<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
									</td>
									<td>
										<?php echo $cnt;?>
									</td>
									<td>
										<?php if(!empty($qty['qty_name'])){ echo $qty['qty_name']; }?>
									</td>
								
									
									<td>
										<a href="<?php echo base_url(); ?>admin/common/edit_quantity/<?php echo $id; ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" alt="" title="" border="0" /></a>
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
	<a href="javascript:void(0)" onclick="delete_item('exp_tbl_qty','qty_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete Quantity</strong><span class="bt_red_r"></span></a>
	<a href="<?php echo base_url(); ?>admin/common/add_quantity" class="bt_green"><span class="bt_green_lft"></span><strong>Add new Quantity</strong><span class="bt_green_r"></span></a>
</div>	
	<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>