<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>
			<form action="<?php echo base_url(); ?>admin/products/save_cat" id="p_cat_form" name="p_cat_form" class="contact-form1" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="p_cat_id" name="p_cat_id" value="0"/>
			<div id="warning_box1"></div>
				
				<table class="loginform">
						<tr class="textField">
							<td width="20%">
								Categorie Name<span class="red">*</span>
							</td>
							<td width="80%">
								<input type="text" class="inputField" name="p_cat_name" id="p_cat_name"/>
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
						</tr>
<tr class="textField">
							<td width="20%">
								Description<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_description" id="p_cat_description" class="inputField"></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								About<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_about" id="p_cat_about" class="inputField"></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								Paper Type<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_paper" id="p_cat_paper" class="inputField"></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								Turnaround<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_turnaround" id="p_cat_turnaround" class="inputField"></textarea>
							</td>
						</tr>
						</tr>
<tr class="textField">
							<td width="20%">
								Artwork<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea  name="p_cat_artwork" id="p_cat_artwork" class="inputField"></textarea>
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
