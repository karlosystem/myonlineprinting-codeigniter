<?php
$tblname="exp_tbl_products";
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$products_array=$CI->common_model->get_all_list($tblname);
//debug($subproduct);
?>
<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>
 <?php
		if($this->session->userdata("error_box"))
		{
			echo '<div class="error_box">';
			echo $this->session->userdata("success_message");
			echo '</div>';
			$this->session->unset_userdata("success_message");
			$this->session->unset_userdata("error_box");			   
		}
		if($this->session->userdata("valid_box"))
		{
			echo '<div class="valid_box">';
			echo $this->session->userdata("success_message");
			echo '</div>';
			$this->session->unset_userdata("success_message");
			$this->session->unset_userdata("valid_box");		
		}
?>
			<form action="<?php echo base_url(); ?>admin/sub_products/update_subproduct" id="subproduct_form1" name="subproduct_form1" class="contact-form1" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="sp_id" name="sp_id" value="<?php  echo $subproduct['sp_id']; ?>"/>
			<input type="hidden" id="	old_image" name="old_image" value="<?php  echo $subproduct['sp_image']; ?>"/>
		
			<div id="warning_box1"></div>		
				<table class="loginform">
						<tr class="textField">
							<td width="20%">
								Product Name<span class="red">*</span>
							</td>
							<td width="80%">
								<select class="slctfield_search" id="product_id" name="product_id">
										<?php 
										if(!empty($products_array))
										{
										foreach($products_array as $p)  {?>
										<option value="<?php  echo $p['p_id']; ?>" <?php  if($p['p_id']==$subproduct['p_id']) { echo 'selected="selected"';} ?>>
										<?php  echo $p['p_name']; ?></option>
										<?php  } } ?>
								</select>
							</td>
						</tr>
						<tr class="textField">
							<td width="20%">
								Subproduct Name<span class="red">*</span>
							</td>
							<td width="80%">
								<input class="slctfield_search" id="sub_name" name="sub_name" value="<?php if(!empty($subproduct['sp_name'])) { echo $subproduct['sp_name'];  } ?>" />
							</td>
						</tr>
						<tr class="textField">
							<td width="20%">
								Subproduct Image<span class="red">*</span>
							</td>
							<td width="80%">
								<input class="slctfield_search" id="sub_image" name="sub_image"  type="file"/>
							</td>
						</tr>
							<tr class="textField">
							<td width="20%">
								Existing Image<span class="red">*</span>
							</td>
							<td width="80%">
								<img src="<?php echo base_url(); ?>assets/images/subproducts/<?php echo $subproduct['sp_id']; ?>/thumbs/<?php  echo $subproduct['sp_image'] ?>" style="width:80px;">
							</td>
						</tr>
						<tr class="textField">
							<td width="20%">
								Subproduct Description<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea class="slctfield_search"  id="sub_description"  name="sub_description" ><?php   if(!empty($subproduct['sp_description'])) { echo $subproduct['sp_description']; }?></textarea>
								
							
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