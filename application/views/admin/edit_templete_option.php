<style>
.right_content{
	width: 655px;
	float:right;
}
</style>

<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>.
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
			<form action="<?php echo base_url(); ?>admin/template/update_templete_option" id="edit_template_option" name="edit_template_option" class="contact-form" method="POST" >
			<input type="hidden" name="templete_id" value="<?php  echo $templete_detail["template_option_id"]; ?>">
				<ol>
			
					<li>
							<p> Option Name<span class="red">*</span></p>
							<input type="text" name="template_option_name" id="template_option_name"  class="input-xlarge text" value="<?php  echo $templete_detail["template_option_name"]; ;?>"/>
					</li>
					
					
					<li>
					<div style="margin-left:130px;">
						<span class="bt_green_lft"></span>
							<input type="submit" value="Update"  class="submit_btn"/>		
						<span class="bt_green_r"></span>
					</div>
					</li>
					
				</ol>
		
			</form>

</div>
<!-- end of right content-->
</div>
