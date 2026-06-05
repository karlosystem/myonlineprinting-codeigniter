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
        ID
    </th>
    <th scope="col" class="rounded">
       Name
    </th>
    <th scope="col" class="rounded">
       Mobile
    </th>
    <th scope="col" class="rounded">
       Email
    </th>
    <!--<th scope="col" class="rounded">
        status
    </th>-->
    <th scope="col" class="rounded">
        Preview
    </th>

    </tr>
    </thead>

<tbody>
					<?php 
					if(!empty($contacts))
					{
					$cnt = 1;
					foreach($contacts as $u)
					{
					
					$id= $u['id'];
										
					?>
							<tr>
								
									<td>
										<input type="checkbox" name="child_checkbox"  value="<?php echo $id;?>" />
									</td>
									<td>
										<?php echo $cnt;?>
									</td>
									<td>
										<?php if(!empty($u['name'])){ echo $u['name']; }?>
									</td>
									<td>
										<?php if(!empty($u['mobile'])){ echo $u['mobile']; }?>
                                    </td>
                                    <td>
										<?php if(!empty($u['email'])){ echo $u['email']; }?>
									</td>
									
								<!--	<td>
										<?php  echo $str; ?>
									</td>-->
									<td>
                                        <a href="<?php echo base_url(); ?>admin/copyservice/preview_contact/<?php echo $id; ?>">
                                            <img src="<?php echo base_url(); ?>images/admin/user_edit.png" />
                                        </a>
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
    </div>
    <?php  generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>

</div>
<!-- end of right content-->
</div>