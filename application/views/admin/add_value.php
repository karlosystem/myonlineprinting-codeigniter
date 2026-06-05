<?php
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$tbl_name='exp_tbl_attributes';
$attribute_array = $this->common_model->get_all_list($tbl_name);
?>
<style>
.right_content{
	width: 655px;
	float:right;
}
</style>

<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>


<?php 
if ( $this->session->userdata("valid_box") ) 
{
	echo "<div class='valid_box'>";
	echo $this->session->userdata("success_message");
	$this->session->unset_userdata("success_message");
	$this->session->unset_userdata("valid_box");
	echo "</div>";	
}
else if ( $this->session->userdata("error_box") ) 
{
	echo "<div class='error_box'>";
	echo $this->session->userdata("success_message");
	$this->session->unset_userdata("success_message");
	$this->session->unset_userdata("error_box");
	echo "</div>";
}
?>


			<form action="<?php echo base_url(); ?>admin/values/save_value" id="add_value_form" name="add_value_form" class="contact-form" method="POST" >
			
			
				<ol>
					
					<li>
							<p>Select Attribute<span class="red">*</span></p>
							<select type="text"  name="att_id" id="att_id" class="input-xlarge text">
							<option value="">Select attribute</option>
							<?php 
							foreach($attribute_array as $a) { ?>
								<option value="<?php  echo $a['att_id'] ?>"><?php echo $a['att_name']; ?></option>
							
							<?php  } ?>
							</select>
					</li>
					<li>
							<p>Value<span class="red">*</span></p>
							<input type="text"  name="value_name" id="value_name" class="input-xlarge text">
					</li>
					<li>
					<div style="margin-left:130px;">
						<span class="bt_green_lft"></span>
							<input type="submit" value="Submit"  class="submit_btn"/>		
						<span class="bt_green_r"></span>
					</div>
					</li>
					
				</ol>
		
			</form>

</div>
<!-- end of right content-->
</div>
