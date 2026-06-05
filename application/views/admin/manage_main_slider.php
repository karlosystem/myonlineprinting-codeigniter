<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<div class="right_content">
<h2><?php if(!empty($title)) { echo $title; } ?></h2>
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
				Slider Name
			</th>
			<th scope="col" class="rounded">
				Slider Image
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
					if(!empty($slider))
					{
					$cnt = 1;
					foreach($slider as $u)
					{
					
					$id= $u['banner_id'];
					
						if($u['status'] == '1')
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_main_slider\',\'status\',\'0\', \'banner_id\',\''.$id.'\');" />';
						}
						else
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_main_slider\',\'status\',\'1\', \'banner_id\',\''.$id.'\');" />';
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
										<?php if(!empty($u['banner_title'])){ echo $u['banner_title']; }?>
									</td>
									<td>
										<?php if(!empty($u['banner_image'])){
										?>
											<img src="<?php echo base_url();?>assets/images/admin/main_slider_image/<?php echo $u['banner_id'] ?>/<?php echo $u['banner_image'] ?>" style="height:80px;width:80px;"/>
										
										<?php }?>										
									</td>
									<td>
										<?php  echo $str; ?>
									</td>
									<td>
										<a href="<?php echo base_url(); ?>admin/slider/edit_main_slider/<?php echo $id; ?>">
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

			<div style="float:right;margin-right:60px">

					<span style="float:right;margin-top:10px;display:none" class="loader">
					<img src="<?php echo base_url(); ?>assets/images/admin/ajax-loader.gif">
				</span>

					<a href="javascript:void(0)" onclick="delete_main_slider('exp_tbl_main_slider','banner_id')" class="bt_red"><span class="bt_red_lft"></span><strong>Delete Slider</strong><span class="bt_red_r"></span></a>

					<a href="<?php echo base_url(); ?>admin/slider/add_main_slider" class="bt_green"><span class="bt_green_lft"></span><strong>Add  Slider</strong><span class="bt_green_r"></span></a>

			</div>

<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>


</div>
<!-- end of right content-->
</div>