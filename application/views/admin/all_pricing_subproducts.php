<?php

//debug($product_array);

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
	Subproduct Name
</th>
<th scope="col" class="rounded">
	Assign Pricing
</th>

</tr>
</thead>
<tbody>
<?php
if(!empty($sub_products))
{
	$cnt = 1;
	foreach($sub_products as $a)
	{
	
		$id= $a['sp_id'];
					
						
 ?>
				<tr>
				<td>
					<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
				</td>
				<td>
					<?php  echo $cnt; ?>
				</td>
		
				<td>
					<?php if(!empty($a['sp_name'])) { echo $a['sp_name']; } ?>
				</td>
				
				<td>
					<a href="<?php echo base_url(); ?>admin/pricing/set_price/<?php if(!empty($a['p_id'])) { echo $a['p_id']; } ?>/<?php if(!empty($a['sp_id'])) { echo $a['sp_id']; } ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" alt="" title="" border="0" /></a>
				</td>

				</tr>
<?php   $cnt ++ ;} } else { ?>
<tr>
<td colspan="9" style="text-align:center">No record found</td>
</tr>
 <?php }?>
</tbody>
</table>


<?php  //generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>