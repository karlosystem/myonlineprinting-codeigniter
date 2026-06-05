<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>
			<form action="<?php echo base_url(); ?>admin/products/save_edit_attribute" id="p_attribute_editform" name="p_attribute_form" class="contact-form1" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="p_a_id" name="p_a_id" value="<?php  if(!empty($product_cat['p_a_id'])) { echo $product_cat['p_a_id']; } else { echo 0; } ?>"/>
			<div id="warning_box1"></div>
				
					<table class="loginform">
					
						<tr class="textField">
							<td width="20%">
								Attribute Image<span class="red">*</span>
							</td>
							<td width="80%">
								<p class="add_more"><input class="img" style="margin:0.625em 0em;" type="file" id="p_a_image" name="p_a_image" /> </p>
							</td>
						</tr>
						
						<?php
							 if(!empty($product_cat['p_a_image']))
							 {
						?>
							<tr>
							<td>&nbsp;</td>
								<td class="textField1">
									<table>	
										<tr>
											<td width="70" valign="bottom">
											<img src="<?php echo base_url();?>images/products/<?php echo $product_cat['p_a_id'].'/thumbs/'.$product_cat['p_a_image'];?>" alt="Image" width="60" />
											<br />
											<input type="hidden" id="old_a_image" name="old_a_image" value="<?php echo $product_cat['p_a_image']; ?>" />
										</tr>
									</table>
								</td>
							</tr>		
						<?php } else {  ?>
						<tr>
							<td>&nbsp;</td>
								<td class="textField1">
									<table>	
										<tr>
											<td width="70" valign="bottom">
											<img src="<?php echo base_url();?>images/image_not_available.jpg" alt="Image" width="60" />
											<br />
											<input type="hidden" id="old_a_image" name="old_a_image" value="" />
										</tr>
									</table>
								</td>
							</tr>
						<?php } ?>
					
						<tr class="textField">
							<td width="20%">
								Categories Name<span class="red">*</span>
							</td>
							<td width="80%">
								<select class="slctfield_search" id="p_cat_id" name="p_cat_id">
									<option value="">Please Select</option>
										<?php foreach($all_products_cat as $val){ ?>					  
										<option value="<?php echo $val['p_cat_id'];?>"  <?php if($product_cat['p_c_id'] ==$val['p_cat_id']) { echo "selected='selected'"; } ?>><?php echo $val['p_cat_name'];?></option>
									  <?php }?>
								</select>
							</td>
						</tr>
						
						<tr class="textField">
								<td width="20%">
									Attribute Type<span class="red">*</span>
								</td>
								<td width="80%">
								<input type="text" class="inputField" name="p_a_name" id="p_a_name" value="<?php  if(!empty($product_cat['p_a_type'])) { echo $product_cat['p_a_type']; } else { echo ""; } ?>"/>
							</td>
						</tr>
						
						<tr class="textField">
								<td width="20%">
									Select Turnaround<span class="red">*</span>
								</td>
								
							<td width="80%">
									<select class="slctfield_search" id="p_turnaround" name="p_turnaround">
										<option value="">Please Select</option>			  
										  <option value="1" <?php if($product_cat['p_a_turnaround_status'] =='1'){ echo "selected='selected'"; } ?>>48 Hour Dispatch</option>
										  <option value="2"  <?php if($product_cat['p_a_turnaround_status'] =='2'){ echo "selected='selected'"; } ?>>5 Day Dispatch (SAVE 10%)</option>
										  <option value="3"  <?php if($product_cat['p_a_turnaround_status'] =='3'){ echo "selected='selected'"; } ?>>Both</option>
									</select>
							</td>
						</tr>
						
						
						<tr class="textField">
								<td width="20%">
									Printed Color Sides<span class="red">*</span>
								</td>
								
						<td width="80%">
								<select class="slctfield_search" id="color_side" name="color_side">
									<option value="">Please Select</option>			  
										<option value="1" <?php if($product_cat['p_a_print_status'] =='1'){ echo "selected='selected'"; } ?>>Full Colour 1 Side</option>
									  <option value="2" <?php if($product_cat['p_a_print_status'] =='2'){ echo "selected='selected'"; } ?>>Full Colour 2 Side</option>
									  <option value="3" <?php if($product_cat['p_a_print_status'] =='3'){ echo "selected='selected'"; } ?> >Full Colour  Both Side</option>
								</select>
							</td>
						</tr>
						<tr class="textField">
								<td width="20%">
									About Attribute<span class="red">*</span>
								</td>
								<td width="80%">
								<textarea class="inputField" name="p_a_about" id="p_a_about"><?php if(!empty($product_cat['p_a_about'])) { echo $product_cat['p_a_about']; }  ?></textarea>
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
