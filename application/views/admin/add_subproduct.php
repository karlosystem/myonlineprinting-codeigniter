<?php
$tblname="exp_tbl_products";
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$products_array=$CI->common_model->get_all_list($tblname);
//debug($products_array);
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
			<form action="<?php echo base_url(); ?>admin/sub_products/save_subproduct" id="subproduct_form" name="subproduct_form" class="contact-form1" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="p_qty_option_id" name="p_qty_option_id" value="0"/>
			<div id="warning_box1"></div>		
				<table class="loginform">
						<tr class="textField">
							<td width="20%">
								Product Name<span class="red">*</span>
							</td>
							<td width="80%">
								<select class="slctfield_search" id="product_id" name="product_id">
								<option value="">select product</option>
										<?php 
										if(!empty($products_array))
										{
										foreach($products_array as $p)  {?>
										<option value="<?php  echo $p['p_id']; ?>"><?php  echo $p['p_name']; ?></option>
										<?php  } } ?>
								</select>
							</td>
						</tr>
						<tr class="textField">
							<td width="20%">
								Subproduct Name<span class="red">*</span>
							</td>
							<td width="80%">
								<input class="slctfield_search" id="sub_name" name="sub_name" />
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
								Subproduct Description<span class="red">*</span>
							</td>
							<td width="80%">
								<textarea class="slctfield_search" id="sub_description" name="sub_description" ></textarea>
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