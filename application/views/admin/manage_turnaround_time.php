<?php  
//debug($users);
$CI=get_Instance();
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
<h2><?php  if(!empty($title)) { echo $title; } ?></h2>
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
	Templete option 
</th>

<th scope="col" class="rounded">
	Turnaround
</th>


<th scope="col" class="rounded">
	Edit
</th>

</tr>
</thead>

<tbody>
					<?php 
					if(!empty($turnaround_array))
					{
					$cnt = 1;
					foreach($turnaround_array as $u)
					{
					
					$id= $u['turn_time_id'];
					
					?>
							<tr>
								
									<td>
										<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
									</td>
									<td>
										<?php echo $cnt;?>
									</td>
								<td>
										<?php 
										if(!empty($u['template_optn_id']))
										{ 
												$tmp_id=$u['template_optn_id'];
												$tbl="exp_tbl_template_options";
												$col="template_option_id";
												$result=$CI->common_model->get_item_by_id($tbl,$col,$tmp_id);
												if(!empty($result))
												{
															echo $result["template_option_name"];
												}
									 }?>
								</td>
									<td>
										<?php if(!empty($u['turnaroundtime'])){ echo $u['turnaroundtime']; }?>
									</td>
								
									
									<td>
										<a href="<?php echo base_url(); ?>admin/template/edit_turnaround/<?php echo $id; ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" alt="" title="" border="0" /></a>
									</td>
								
							</tr>
					<?php $cnt++; }} else { ?>
						<tr>
									<td colspan='8' style='text-align:center'><b>No Record Found</b></td>
						</tr>
					<?php } ?>
					</tbody>



</table>
<div style="float:right;margin-right:25px">


<span style="float:right;margin-top:10px;display:none" class="loader"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif"></span>

<a href="javascript:void(0)" onclick="delete_item('exp_tbl_turnaround_time','turn_time_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete</strong><span class="bt_red_r"></span></a>

<a href="<?php echo base_url(); ?>admin/template/add_turnaroundtime" class="bt_green"><span class="bt_green_lft"></span><strong>Add</strong><span class="bt_green_r"></span></a>

	</div>
<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>
