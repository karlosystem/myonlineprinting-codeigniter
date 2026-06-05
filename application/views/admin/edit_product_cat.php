<div class="right_content" >
<h2><?php echo $title ?></h2>
			<form action="<?php echo base_url(); ?>admin/products/save_edit_cat" id="p_cat_editform" name="p_cat_form" class="contact-form1" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="p_cat_id" name="p_cat_id" value="<?php  if(!empty($product_cat['p_cat_id'])) { echo $product_cat['p_cat_id']; } else { echo '0'; } ?>"/>

				<input type="hidden" name="old_image" value="<?php echo $product_cat['p_cat_image']; ?>" />

			<div id="warning_box1"></div>
				<table class="loginform">
					
					<tr class="textField">
							<td width="20%">
								Categorie Name<span class="red">*</span>
							</td>
							<td width="80%">
									<input type="text" name="p_cat_name" id="p_cat_name" class="inputField"  value="<?php  if(!empty($product_cat['p_cat_name'])) { echo $product_cat['p_cat_name']; } else { echo ''; } ?>" />
							</td>

						</tr>
						
					<tr class="textField">
							<td width="20%">
								Categorie Image<span class="red">*</span>
							</td>
							<td width="80%">
								<input type="file" class="inputField" name="p_cat_image" id="p_cat_image"/>
							</td>

						</tr>
<tr class="textField">
							<td width="20%">
								Existing Image<span class="red">*</span>
							</td>
							<td width="80%">
								<?php if(!empty($product_cat['p_cat_image'])){ ?> <img src="<?php echo base_url();  ?>images/admin/category/<?php echo $product_cat['p_cat_id']  ?>/<?php  echo $product_cat['p_cat_image']; ?>"  style='height:80px;width:80px;'><?php  }?>
							</td>

						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								Description<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_description" id="p_cat_description" class="inputField"><?php  if(!empty($product_cat['p_cat_description'])) { echo $product_cat['p_cat_description']; } ?></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								About<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_about" id="p_cat_about" class="inputField"><?php  if(!empty($product_cat['p_cat_about'])) { echo $product_cat['p_cat_about']; } ?></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								Paper Type<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_paper" id="p_cat_paper" class="inputField"><?php  if(!empty($product_cat['p_cat_paper'])) { echo $product_cat['p_cat_paper']; } ?></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								Turnaround<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_turnaround" id="p_cat_turnaround" class="inputField"><?php  if(!empty($product_cat['p_cat_turnaround'])) { echo $product_cat['p_cat_turnaround']; } ?></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								Artwork<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_artwork" id="p_cat_artwork" class="inputField"><?php  if(!empty($product_cat['p_cat_artwork'])) { echo $product_cat['p_cat_artwork']; } ?></textarea>
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
