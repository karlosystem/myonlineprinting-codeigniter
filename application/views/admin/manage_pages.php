<?php  
//debug($users);

?>
<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<div class="right_content">
<div id="warning_box1"></div>	

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
						Page Name
					</th>
					<th scope="col" class="rounded">
						Page Title
					</th>

					<!--<th scope="col" class="rounded">
						status
					</th>-->
					<th scope="col" class="rounded">
						Edit
					</th>

					</tr>
					</thead>

				<tbody>
					<?php 
					if(!empty($pages))
					{
					$cnt = 1;
					foreach($pages as $u)
					{
					
					$id= $u['page_id'];
					
						if($u['page_status'] == '1')
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_static_pages\',\'page_status\',\'0\', \'page_id\',\''.$id.'\');" />';
						}
						else
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_static_pages\',\'page_status\',\'1\', \'page_id\',\''.$id.'\');" />';
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
										<?php if(!empty($u['page_name'])){ echo $u['page_name']; }?>
									</td>
									<td>
										<?php if(!empty($u['page_title'])){ echo $u['page_title']; }?>
									</td>
									
								<!--	<td>
										<?php  echo $str; ?>
									</td>-->
									<td>
										<a href="<?php echo base_url(); ?>admin/pages/edit_page/<?php echo $id; ?>">
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


<span style="float:right;margin-top:10px;display:none" class="loader"><img src="<?php echo base_url(); ?>assets/images/admin/ajax-loader.gif"></span>

<a href="javascript:void(0)" onclick="delete_item('exp_tbl_static_pages','page_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete Page</strong><span class="bt_red_r"></span></a>

<a href="<?php echo base_url(); ?>admin/pages/add_page" class="bt_green"><span class="bt_green_lft"></span><strong>Add  Page</strong><span class="bt_green_r"></span></a>
	</div>
<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>