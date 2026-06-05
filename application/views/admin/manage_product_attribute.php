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
					Product Cat name
				</th>
				<th scope="col" class="rounded">
					Image
				</th>
				<th scope="col" class="rounded">
					Product Attibute name
				</th>
				<th scope="col" class="rounded">
					Status
				</th>
				<th scope="col" class="rounded-q4">
					Edit
				</th>
				</tr>
				</thead>
				<tbody>
					<?php 
					if(!empty($all_products_attribute))
					{
					$cnt = 1;
					foreach($all_products_attribute as $p_attribute)
					{
		
						$id= $p_attribute['p_a_id'];
						
						if(!empty($p_attribute['p_a_image']))
						{
							 $src = "images/products/".$id."/thumbs/".$p_attribute['p_a_image'];
						}	
						 else
						 {
							$src =  "images/image_not_available.jpg";
						 }
					 
						if ( !file_exists($src) ) 
						{
							$src =  "images/image_not_available.jpg";
						}
						$src = base_url().$src;
					
						if($p_attribute['p_a_status'] == '1')
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_products_attribute\', \'p_a_status\', \'0\', \'p_a_id\', \''.$id.'\');" />';
						}
						else
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_products_attribute\', \'p_a_status\', \'1\', \'p_a_id\', \''.$id.'\');" />';
						}
					?>
							<tr>
								
									<td>
										<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
									</td>
									<td>
										<?php echo $cnt;?>
									</td>
									<td>
										<?php if(!empty($p_attribute['p_cat_name'])){ echo $p_attribute['p_cat_name']; }?>
									</td>
									<td>
										<img src="<?php echo $src; ?>"  height="50" width="50" />
									</td>
									<td>
										<?php if(!empty($p_attribute['p_a_type'])){ echo $p_attribute['p_a_type']; }?>
									</td>
									
									<td>
										<?php  echo $str; ?>
									</td>
									<td>
										<a href="<?php echo base_url(); ?>admin/products/edit_p_attribute/<?php echo $id; ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" alt="" title="" border="0" /></a>
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
	<a href="javascript:void(0)" onclick="delete_item('exp_tbl_products_attribute','p_a_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete items</strong><span class="bt_red_r"></span></a>
	<a href="<?php echo base_url(); ?>admin/products/add_product_attribute" class="bt_green"><span class="bt_green_lft"></span><strong>Add new item</strong><span class="bt_green_r"></span></a>
</div>	
	<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>