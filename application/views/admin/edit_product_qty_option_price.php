<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>
				<form action="<?php echo base_url(); ?>admin/products/save_edit_qty_price" id="p_attribute_form" name="p_attribute_form" class="contact-form1" method="POST" >
				<input type="hidden" id="p_qty_price_id" name="p_qty_price_id" value="<?php if(!empty($all_products_cat['p_qty_price_id'])){ echo $all_products_cat['p_qty_price_id']; } ?>"/>
				<table class="loginform">
						<tr class="textField">
							<td width="20%">
								Categories Name<span class="red">*</span>
							</td>
							<td width="80%">
								<select class="slctfield_search" id="p_cat_id" name="p_cat_id" onchange="get_attribute_qty_id(this.value);">
									<option value="">Please Select</option>
										<?php foreach($products_cat as $val){ ?>					  
										<option value="<?php echo $val['p_cat_id'];?>" <?php if($val['p_cat_id'] == $all_products_cat['p_price_cat_id'] ) { echo "selected='selected'"; }?> ><?php echo $val['p_cat_name'];?></option>
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
										<?php foreach($all_attribute as $att){ ?>
										<option  <?php if($all_products_cat['p_q_atr_id'] == $att['p_a_id']){ echo "selected='selected'"; } ?> value="<?php echo $att['p_a_id'];?>"><?php if(!empty($all_products_cat['p_a_type'])){ echo $all_products_cat['p_a_type']; } ?></option>
										<?php } ?>
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
											<?php if($all_products_cat['p_a_turnaround_status'] == '3'){ ?>
											<option value="2"  <?php if('2'== $all_products_cat['p_turnaround'] ) { echo "selected='selected'"; }?>>5 Day Dispatch (SAVE 10%)</option>
											<option value="1" <?php if('1'== $all_products_cat['p_turnaround'] ) { echo "selected='selected'"; }?> >48 Hour Dispatch</option>
											<?php  } else if($all_products_cat['p_a_turnaround_status'] == '2'){ ?>
											<option value="2"  <?php if('2'== $all_products_cat['p_turnaround'] ) { echo "selected='selected'"; }?>>5 Day Dispatch (SAVE 10%)</option>
											<?php } else if($all_products_cat['p_a_turnaround_status'] == '1') { ?>
											<option value="1" <?php if('1'== $all_products_cat['p_turnaround'] ) { echo "selected='selected'"; }?> >48 Hour Dispatch</option>
											<?php } ?>
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
											<?php if($all_products_cat['p_a_print_status'] == '3'){ ?>
											<option value="2" <?php if('2'== $all_products_cat['p_color'] ) { echo "selected='selected'"; }?>  >Full Colour 2 Side</option>
											<option value="1" <?php if('1'== $all_products_cat['p_color'] ) { echo "selected='selected'"; }?> >Full Colour 1 Side</option>
											<?php  } else if($all_products_cat['p_a_print_status'] == '2'){ ?>
											<option value="2"  <?php if('2'== $all_products_cat['p_color'] ) { echo "selected='selected'"; }?>>Full Colour 2 Side</option>
											<?php } else if($all_products_cat['p_a_print_status'] == '1') { ?>
											<option value="1"  <?php if('1'== $all_products_cat['p_color'] ) { echo "selected='selected'"; }?>>Full Colour 1 Side</option>
											<?php } ?>
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
									<?php foreach($all_qty as $qty ) { ?>
									<option value="<?php echo $all_products_cat['p_qty_option_id'];?>"  <?php if($qty['p_qty_option_id']==$all_products_cat['p_qty_option_id']){ echo "selected='selected'"; } ?> ><?php if(!empty($all_products_cat['p_qty_option_name'])){ echo $all_products_cat['p_qty_option_name']; } ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						
						
						<tr class="textField">
								<td width="20%">
									Qty<span class="red">*</span>
								</td>
								<td width="80%">
								<input type="text" class="inputField" name="p_qty" id="p_qty" value="<?php if(!empty($all_products_cat['p_qty'])){ echo $all_products_cat['p_qty']; } ?>"/>
						</td>
						
						<tr class="textField">
								<td width="20%">
									Price<span class="red">*</span>
								</td>
								<td width="80%">
								<input type="text" class="inputField" name="p_price" id="p_price" value="<?php if(!empty($all_products_cat['p_price'])){ echo $all_products_cat['p_price']; } ?>"/>
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
		
				</form>

</div>
<!-- end of right content-->
</div>