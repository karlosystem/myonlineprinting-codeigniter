<?php
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$tbl_name='exp_tbl_template_options';
$option_array = $this->common_model->get_all_list($tbl_name);

$tbl_name='exp_tbl_turnaround_time';
$turnaround_array = $this->common_model->get_all_list($tbl_name);

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


			<form action="<?php echo base_url(); ?>admin/template/update_templete_attributes" id="edit_templete_attribute_form" name="edit_templete_attribute_form" class="contact-form" method="POST" >
			<input type="hidden" name="attrib_id" value="<?php  echo $templete_attribute['template_option_attribute_id'];  ?>" />
			
				<ol>
					
					<li>
							<p>Option Name<span class="red">*</span></p>
							<select type="text"  name="option_id" id="option_id" class="input-xlarge text">
					
							<?php 
							foreach($option_array as $a)  {?>
								<option value="<?php  echo $a['template_option_id'] ?>" <?php  if($a['template_option_id'] ==$templete_attribute['template_opt_id']) {   echo "selected='selected'"; } ?>><?php echo $a['template_option_name']; ?></option>
							
							<?php  } ?>
							</select>
					</li>
				
						<li>
							<p>Turnaround time<span class="red">*</span></p>
							<select type="text"  name="turnaround_id" id="turnaround_id" class="input-xlarge text">
						
							<?php 
							foreach($turnaround_array as $a)  {?>
								<option value="<?php  echo $a['turn_time_id'] ?>" <?php  if($a['turn_time_id']==$templete_attribute['template_turnaroundtime']) {   echo "selected='selected'"; } ?>><?php echo $a['turnaroundtime']; ?></option>
							
							<?php  } ?>
							</select>
					</li>


					<li>
							<p>Quantity<span class="red">*</span></p>
							<input type="text"  name="quantity" id="quantity" class="input-xlarge text" value="<?php   if(!empty($templete_attribute['template_quantity']))  {  echo  $templete_attribute['template_quantity']; }?>">
					</li>
				
					<li>
							<p>Price<span class="red">*</span></p>
							<input type="text"  name="price" id="price" class="input-xlarge text" value="<?php   if(!empty($templete_attribute['price']))  		{  echo  $templete_attribute['price']; }?>">
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
