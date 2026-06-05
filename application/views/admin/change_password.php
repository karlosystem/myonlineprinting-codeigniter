<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<div class="right_content">
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

		<form  method="post" class="contact-form"  id="password_form" action="<?php echo base_url(); ?>admin/admin/update_password">
	
				<fieldset>
				<ol>
					<li>
					<div class="control-group">
					<p>Old Password<span class="red">*</span></p>
							<input type="text" value=""name="old_password"  class="input-xlarge text">
					</div>
					</li>
					
					<li>
					<p>New Password<span class="red">*</span></p>
							  <input type="password" class="input-xlarge text" name="new_password" >
					</li>
					<li>
					<p>Re-Enter Password<span class="red">*</span></p>
							  <input type="password" class="input-xlarge text" name="confirm_password" >
					</li>
					<li>
					<div style="margin-left:130px;">
						<span class="bt_green_lft"></span>
							<input type="submit" value="Submit"  class="submit_btn"/>		
						<span class="bt_green_r"></span>
					</div>
		


					</li>
		
				</ol>
				
				</fieldset>
              
         </form>

</div>
<!-- end of right content-->
</div>