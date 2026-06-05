<div class="right_content" style="min-height:400px;">
<h2><?php echo $title; ?></h2>
			<form action="<?php echo base_url(); ?>admin/products/save_attribute" id="p_attribute_form" name="p_attribute_form" class="contact-form1" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="p_a_id" name="p_a_id" value="0"/>
			<div id="warning_box1"></div>
					<table class="loginform">
						<tr class="textField">
							<td width="20%">
								Attribute Image<span class="red">*</span>
							</td>
							<td width="80%">
								<p class="add_more"><input class="img" style="margin:0.625em 0em;" type="file" id="p_a_image" name="p_a_image"/> </p>
							</td>
						</tr>
					
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
									Attribute Type<span class="red">*</span>
								</td>
								<td width="80%">
								<input type="text" class="inputField" name="p_a_name" id="p_a_name"/>
						</td>
						</tr>
						
							<tr class="textField">
								<td width="20%">
									Select Turnaround<span class="red">*</span>
								</td>
								
							<td width="80%">
									<select class="slctfield_search" id="p_turnaround" name="p_turnaround">
										<option value="">Please Select</option>			  
										  <option value="1" >48 Hour Dispatch</option>
										  <option value="2" >5 Day Dispatch (SAVE 10%)</option>
										  <option value="3" >Both</option>
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
										  <option value="1" >Full Colour 1 Side</option>
										  <option value="2" >Full Colour 2 Side</option>
										  <option value="3" >Full Colour  Both Side</option>
									</select>
							</td>
						</tr>
						<tr class="textField">
								<td width="20%">
									About Attribute<span class="red">*</span>
								</td>
								<td width="80%">
								<textarea class="inputField" name="p_a_about" id="p_a_about"></textarea>
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
