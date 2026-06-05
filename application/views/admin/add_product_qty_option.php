<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>
			<form action="<?php echo base_url(); ?>admin/products/save_qty_option" id="p_qty_form" name="p_qty_form" class="contact-form1" method="POST">
			<input type="hidden" id="p_qty_option_id" name="p_qty_option_id" value="0"/>
			<div id="warning_box1"></div>		
				<table class="loginform">
						<tr class="textField">
							<td width="20%">
								Categories Name<span class="red">*</span>
							</td>
							<td width="80%">
								<select class="slctfield_search" id="p_cat_id" name="p_cat_id">
									<option value="">Please Select</option>
										<?php foreach($all_products_cat as $val){ ?>					  
										<option value="<?php echo $val['p_cat_id'];?>" ><?php echo $val['p_cat_name'];?></option>
									  <?php } ?>
								</select>
							</td>
						</tr>
						<tr class="textField">
							<td width="20%">
								Qty Option<span class="red">*</span>
							</td>
							<td width="80%">
								<input type="text" class="inputField" name="p_qty_name" id="p_qty_name"/>
							</td>
						</tr>
						<tr class="textField">
							<td>
								&nbsp;
							</td>
							<td>
							<span class="bt_green_lft"></span>
									<input type="submit" value="Submit"  class="submit_btn"/>		
							<span class="bt_green_r"></span>
							</td>
						</tr>
						
				</table>
		
			</form>

</div>
<!-- end of right content-->
</div>