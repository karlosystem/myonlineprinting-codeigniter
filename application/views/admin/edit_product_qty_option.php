<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>
			<form action="<?php echo base_url(); ?>admin/products/save_edit_qty_option" id="p_qty_form" name="p_qty_form" class="contact-form1" method="POST">
			<input type="hidden" id="p_qty_option_id" name="p_qty_option_id" value="<?php  if(!empty($product_cat['p_qty_option_id'])) { echo $product_cat['p_qty_option_id']; } else { echo "0"; } ?>"/>
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
										<option value="<?php echo $val['p_cat_id'];?>"  <?php if($product_cat['p_qty_cat_id'] ==$val['p_cat_id']) { echo "selected='selected'"; } ?>><?php echo $val['p_cat_name'];?></option>
									  <?php } ?>
								</select>
							</td>
						</tr>
						<tr class="textField">
							<td width="20%">
								Qty Option<span class="red">*</span>
							</td>
							<td width="80%">
								<input type="text" class="inputField" name="p_qty_name" id="p_qty_name" value="<?php  if(!empty($product_cat['p_qty_option_name'])) { echo $product_cat['p_qty_option_name']; } else { echo ""; } ?>" />
							</td>
						</tr>
						<tr class="textField">
							<td>
							&nbsp;
							</td>
							<td>
							<span class="bt_green_lft"></span>
									<input type="submit" value="Update"  class="submit_btn"/>		
							<span class="bt_green_r"></span>
							</td>
						</tr>
						
				</table>
		
			</form>

</div>
<!-- end of right content-->
</div>