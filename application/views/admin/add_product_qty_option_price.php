<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>

			<div id="insert_box"></div>
				
				<table class="loginform">
				
						<tr class="textField">
							<td width="20%">
								Categories Name<span class="red">*</span>
							</td>
							<td width="80%">
								<select class="slctfield_search" id="p_cat_id" name="p_cat_id" onchange="get_attribute_qty_id(this.value);">
									<option value="">Please Select</option>
										<?php foreach($all_products_cat as $val){ ?>					  
										<option value="<?php echo $val['p_cat_id'];?>" ><?php echo $val['p_cat_name'];?></option>
									  <?php } ?>
								</select>
							</td>
						</tr>
					
						<tr class="textField" >
							<td width="20%">
								Attribute Type<span class="red">*</span>
							</td>
							<td width="80%" id="u_attribute">
								<select class="slctfield_search" id="p_a_type" name="p_a_type">
									<option value="">Please Select</option>
										
								</select>
							</td>
						</tr>
						
							<tr class="textField">
								<td width="20%">
									Select Turnaround<span class="red">*</span>
								</td>
								<td width="80%" id="u_p_turnaround">
									<select class="slctfield_search" id="p_turnaround" name="p_turnaround" >
										<option value="">Please Select</option>
											
									</select>
								</td>
							</tr>
							
							<tr class="textField">
								<td width="20%">
									Printed Color Sides<span class="red">*</span>
								</td>
								<td width="80%" id="u_p_color">
									<select class="slctfield_search" id="p_color" name="p_color" >
										<option value="">Please Select</option>
											
									</select>
								</td>
							</tr>
						</span>
						
						<tr class="textField">
							<td width="20%">
								Qty Option<span class="red">*</span>
							</td>
							<td width="80%" id="u_p_qty">
								<select class="slctfield_search" id="p_o_qty" name="p_o_qty">
									<option value="">Please Select</option>
								</select>
							</td>
						</tr>
						
						
						<tr class="textField">
								<td width="20%">
									Qty<span class="red">*</span>
								</td>
								<td width="80%">
								<input type="text" class="inputField" name="p_qty" id="p_qty"/>
						</td>
						
						<tr class="textField">
								<td width="20%">
									Price<span class="red">*</span>
								</td>
								<td width="80%">
								<input type="text" class="inputField" name="p_price" id="p_price"/>
						</td>
						<tr class="textField">
							<td>
							&nbsp;
							</td>
							<td>
							<span class="bt_green_lft"></span>
									<input type="image" value="Submit"  class="submit_btn" onclick="save_all_attr_qty_option();"/>		
							<span class="bt_green_r"></span>
							</td>
						</tr>
						
				</table>
		
	

</div>
<!-- end of right content-->
</div>