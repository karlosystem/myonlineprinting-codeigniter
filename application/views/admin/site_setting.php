<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<?php
$tblname="exp_tbl_paypal_setting";
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$result=$CI->common_model->get_all_list($tblname);
//debug($result);
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




			<form action="<?php echo base_url(); ?>admin/admin/update_site_setting" id="setting_form" name="setting_form"class="contact-form" method="POST">
			
			
				<ol>
					<li>
							<p>Business Email<span class="red">*</span></p>
							<input type="text" value="<?php if(!empty($result[0]['business_email'])) { echo $result[0]['business_email']; } ?>" name="b_email" id="b_email" class="input-xlarge text">
					</li>
					<li>
							<p>api username<span class="red">*</span></p>
							<input type="text" value="<?php if(!empty($result[0]['api_username'])) { echo $result[0]['api_username']; } ?>"name="api_username" id="api_username" class="input-xlarge text">
					</li>
					<li>
							<p>api password</p>
							<input type="password" value="<?php if(!empty($result[0]['api_password'])) { echo $result[0]['api_password']; } ?>" name="api_password" id="api_password" class="input-xlarge text">
					</li>
					<li>
							<p>api signature<span class="red">*</span></p>
							<input type="text" value="<?php if(!empty($result[0]['api_signature'])) { echo $result[0]['api_signature']; } ?>" name="api_signature" id="api_signature" class="input-xlarge text">
					</li>
					<li>
							<p>Environment<span class="red">*</span></p>
							<select name="environment" id="environment" class="input-xlarge text">
							<option value="test" <?php if($result[0]['enviroment']=="test") { echo "selected"; } ?>>test</option>
							<option value="live" <?php  if($result[0]['enviroment']=="live") { echo "selected"; } ?>>live</option>
							
							</select>
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