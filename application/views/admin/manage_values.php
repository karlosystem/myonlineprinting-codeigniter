<?php
$CI=&get_Instance();
$CI->load->model("admin/common_model");
?>
<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<div class="right_content">
<div id="warning_box1"></div>	
<h2><?php echo $title; ?></h2>
	
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
	Attribute Name
</th>

<th scope="col" class="rounded">
	Value Name
</th>

<th scope="col" class="rounded-q4">
	Edit
</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($value))
{
	$cnt = 1;
	foreach($value as $v)
	{
		
		$id= $v['value_id'];
					
						
 ?>
				<tr>
				<td>
					<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
				</td>
				<td>
					<?php  echo $cnt; ?>
				</td>
		
				<td>
					<?php

					if(!empty($v['att_id'])) {
					
						$tbl_name='exp_tbl_attributes';
						$col='att_id';
						$att_id=$v['att_id'];

						$attribute_name = $this->common_model->get_item_by_id($tbl_name,$col,$att_id);
						if(!empty($attribute_name['att_name'])) {
								echo  $attribute_name['att_name'];
						}
					}
					?>
				</td>
				<td>
					<?php if(!empty($v['value_name'])) { echo $v['value_name']; } ?>
				</td>
				<td>
					<a href="<?php echo base_url(); ?>admin/values/edit_value/<?php if(!empty($v['value_id'])) { echo $v['value_id']; } ?>"><img src="<?php echo base_url(); ?>assets/images/admin/user_edit.png" /></a>
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
<a href="<?php echo base_url(); ?>admin/values/add_value" class="bt_green"><span class="bt_green_lft"></span><strong>Add Attribute Value</strong><span class="bt_green_r"></span></a>

<a href="#" class="bt_red" onclick="delete_item('exp_tbl_attribute_values','value_id')"><span class="bt_red_lft"></span><strong>Delete Value</strong><span class="bt_red_r"></span></a>
</div>
<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>