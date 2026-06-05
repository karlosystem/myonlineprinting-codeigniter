<?php  
//debug($users);
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$tbl_name='exp_tbl_countries';
$all_countries = $CI->common_model->get_all_list($tbl_name);
?>
<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<div class="right_content">
<div id="warning_box1"></div>	
<h2><?php echo $title;?></h2>
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
	Name
</th>
<th scope="col" class="rounded">
	Country
</th>
<th scope="col" class="rounded">
	Email
</th>
<th scope="col" class="rounded">
	Status
</th>
<th scope="col" class="rounded">
	Edit
</th>

</tr>
</thead>

<tbody>
					<?php 
					if(!empty($users))
					{
					$cnt = 1;
					foreach($users as $u)
					{
					
					$id= $u['u_id'];
					
						if($u['u_status'] == '1')
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_users\',\'u_status\',\'0\', \'u_id\',\''.$id.'\');" />';
						}
						else
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_users\',\'u_status\',\'1\', \'u_id\',\''.$id.'\');" />';
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
										<?php if(!empty($u['u_name'])){ echo $u['u_name']; }?>
									</td>
									<td>
									<?php if(!empty($u['u_country'])){foreach ($all_countries as $row){if($row["country_id"]==$u['u_country']){echo ($row['country_name']); }}} ?>
										
									</td>
									<td>
										<?php if(!empty($u['u_email'])){ echo $u['u_email']; }?>
									</td>
									<td>
										<?php  echo $str; ?>
									</td>
									<td>
										<a href="<?php echo base_url(); ?>admin/users/edit_user/<?php echo $id; ?>">
										<img src="<?php echo base_url(); ?>assets/images/admin/user_edit.png" /></a>
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
<a href="javascript:void(0)" onclick="delete_item('exp_tbl_users','u_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete user</strong><span class="bt_red_r"></span></a>

<a href="<?php echo base_url(); ?>admin/users/add_user" class="bt_green"><span class="bt_green_lft"></span><strong>Add  user</strong><span class="bt_green_r"></span></a>
	</div>
<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>