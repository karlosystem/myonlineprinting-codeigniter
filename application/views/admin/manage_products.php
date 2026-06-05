<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-latest.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/blue/style.css" media="screen" />
<script>
$(document).ready(function() 
    { 
        $("#myTable").tablesorter({ 
			// sort on the first column and third column, order asc 
			headers: {0: { sorter: false},1: { sorter: false},4: { sorter: false},5: { sorter: false},6: { sorter: false}}
		}); 
    } 
); 
</script>
<style>
.right_content{
	width: 655px;
	float:right;
}
.header{
	width:auto;
	height:auto;
}
</style>
<div class="right_content">
<div id="warning_box1"></div>	
<h2><?php echo $title; ?></h2>
<table id="myTable" class="tablesorter">
<thead>
<tr>

<th scope="col" class="rounded-company" >

					<input type="checkbox" name="main_checkbox" id="main_checkbox"  onclick="checkall();"/>
								
					</th>
					<th scope="col" class="rounded">
						Sr No
					</th>

					<th scope="col" class="rounded">
						Name
					</th>
					<th scope="col" class="rounded">
						Description
					</th>
					<th scope="col" class="rounded">
						About
					</th>
					<th scope="col" class="rounded">
						Date
					</th>
					<th scope="col" class="rounded">
						Order
					</th>
					<!--th scope="col" class="rounded">
						Status
					</th-->
					<th scope="col" class="rounded-q4">
						Edit
					</th>
					</tr>
					</thead>
					<tbody>
				<?php
					if(!empty($products))
					{
					$cnt = 1;
					foreach($products as $p)
					{
						
						$id= $p['p_id'];
									
						if($p['p_status'] == '1')
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_products\',\'p_status\',\'0\', \'p_id\',\''.$id.'\');" />';
						}
						else
						{
							$str = '<img style="cursor:pointer;" src="'.base_url().'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_products\',\'p_status\',\'1\', \'p_id\',\''.$id.'\');" />';
						}
				?>
				<tr>
				<td>
					<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
				</td>
				<td>
					<?php  echo $cnt; ?>
				</td>
		
				<td>
					<?php if(!empty($p['p_name'])) { echo $p['p_name']; } ?>
				</td>
				<td>
					<?php if(!empty($p['p_discription'])) { echo substr($p['p_discription'],0,50);} ?>
				</td>
				<td>
					<?php if(!empty($p['p_about'])) { echo substr($p['p_about'],0,50); } ?>
				</td>
				<td>
					<?php if(!empty($p['date'])) { echo $p['date']; } ?>
				</td>
				<td>
					<?php if(!empty($p['p_order'])) { echo $p['p_order']; } ?>
				</td>

			<!--	<td>
					<?php echo $str; ?>
				</td>-->
			
				<td>
				<a href="<?php echo base_url(); ?>admin/products/edit_product/<?php if(!empty($p['p_id'])) { echo $p['p_id']; } ?>"><img src="<?php echo base_url(); ?>assets/images/admin/user_edit.png" /></a>
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
<a href="<?php echo base_url(); ?>admin/products/add_product" class="bt_green"><span class="bt_green_lft"></span><strong>Add new item</strong><span class="bt_green_r"></span></a>

<a href="#" class="bt_red" onclick="delete_product('exp_tbl_products','p_id')"><span class="bt_red_lft"></span><strong>Delete items</strong><span class="bt_red_r"></span></a>
</div>
<?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
</div>
<!-- end of right content-->
</div>
