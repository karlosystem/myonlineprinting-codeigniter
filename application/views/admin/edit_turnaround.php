<?php
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$tbl_name='exp_tbl_template_options';
$templete_array = $this->common_model->get_all_list($tbl_name);

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


			<form action="<?php echo base_url(); ?>admin/template/update_turnaround_time" id="edit_turnaround_form" name="edit_turnaround_form" class="contact-form" method="POST" >
				<input type="hidden" name="turn_time_id" value="<?php  echo $turnaround['turn_time_id']; ?>"> 
			
				<ol>
					
						<li>
							<p>Select Option Name<span class="red">*</span></p>
							<select name="template_option_id" id="template_option_id" class="input-xlarge text">
				
							<?php if(!empty($templete_array)) { foreach($templete_array as $option_name) {?>
							<option value="<?php echo $option_name['template_option_id'];?>" <?php  if($option_name['template_option_id'] == $turnaround['template_optn_id'])  { echo 'selected="selected"';  }?> > <?php echo $option_name['template_option_name'];?></option>
							
							<?php } }?>
							</select>
					</li>

					<li>
							<p>Turnaround Time<span class="red">*</span></p>
							<input type="text"  name="turnaround_name" id="turnaround_name" class="input-xlarge text" value="<?php  if(!empty($turnaround['turnaroundtime']))  { echo $turnaround['turnaroundtime']; }?>">
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
