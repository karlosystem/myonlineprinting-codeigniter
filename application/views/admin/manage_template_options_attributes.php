
<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<div class="right_content">
<div id="warning_box1"></div>	
<h2><?php echo $title; ?></h2>
	<?php 


if ( $this->session->userdata("add_att_success") ) 
{
	echo "<div class='valid_box'>";
	echo $this->session->userdata("add_att_success");
	$this->session->unset_userdata("add_att_success");
	echo "</div>";	
}
if ( $this->session->userdata("add_turn_success") ) 
{
	echo "<div class='valid_box'>";
	echo $this->session->userdata("add_turn_success");
	$this->session->unset_userdata("add_turn_success");
	echo "</div>";	
}

?>
<table id="rounded-corner" >
<thead>
<tr>

<th scope="col" class="rounded-company">

					<input type="checkbox" name="main_checkbox" id="main_checkbox"  onclick="checkall();"/>
			
</th>
<th scope="col" class="rounded">
	Sr No
</th>

<th scope="col" class="rounded">
	Option Name
</th>
<th scope="col" class="rounded">
	Turnaround Time
</th>
<th scope="col" class="rounded">
	Quantity
</th>
<th scope="col" class="rounded">
	Price
</th>
<th scope="col" class="rounded-q4">
	Edit
</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($all_template_option_attributes))
{	$cnt = 1;
	foreach($all_template_option_attributes as $option_attributes)
	{
		$get_template_option_name=$this->template_model->get_temp_opt_name($option_attributes['template_opt_id']);
		$get_turnaround_name=$this->template_model->get_turnaround_name($option_attributes['template_turnaroundtime']);
		$id= $option_attributes['template_option_attribute_id'];
					
						
 ?>
				<tr>
				<td>
					<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
				</td>
				<td>
					<?php  echo $cnt; ?>
				</td>
		
				<td>
					<?php if(!empty($get_template_option_name['template_option_name'])) { echo $get_template_option_name['template_option_name']; } ?>
				</td>
				<td>
					<?php if(!empty($get_turnaround_name['turnaroundtime'])) { echo $get_turnaround_name['turnaroundtime']; } ?>
				</td>
				<td>
					<?php if(!empty($option_attributes['template_quantity'])) { echo $option_attributes['template_quantity']; } ?>
				</td>
				<td>
					<?php if(!empty($option_attributes['price'])) { echo $option_attributes['price']; } ?>
				</td>
				
				<td>
					<a href="<?php echo base_url(); ?>admin/template/edit_option_attributes/<?php if(!empty($option_attributes['template_option_attribute_id'])) { echo $option_attributes['template_option_attribute_id']; } ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" alt="" title="" border="0" /></a>
				</td>

				</tr>
<?php   $cnt ++ ;} } else { ?>
<tr>
<td colspan="9" style="text-align:center">No record found</td>
</tr>
 <?php }?>
</tbody>
</table>

<div style="float:right;margin-right:25px">

<span style="float:right;margin-top:10px;display:none" class="loader"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif"></span>
<a href="<?php echo base_url(); ?>admin/template/add_template_options_attributes" class="bt_green"><span class="bt_green_lft"></span><strong>Add Template Options Attributes</strong><span class="bt_green_r"></span></a>

<a href="#" class="bt_red" onclick="delete_item('exp_tbl_template_options_attributes','template_option_attribute_id')"><span class="bt_red_lft"></span><strong>Delete </strong><span class="bt_red_r"></span></a>
</div>
<?php  //generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>
