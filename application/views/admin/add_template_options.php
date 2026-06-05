<style>
.right_content{
	width: 655px;
	float:right;
}
</style>

<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>.
	<?php 
if ( $this->session->userdata("check_success") ) 
{
	echo "<div class='valid_box'>";
	echo $this->session->userdata("check_success");
	$this->session->unset_userdata("check_success");
	echo "</div>";	
}

?>
			<form action="<?php echo base_url(); ?>admin/template/save_template_option" id="add_template_option_form" name="add_template_option_form" class="contact-form" method="POST" >
				<ol>
			
					<li>
							<p>Enter Option Name<span class="red">*</span></p>
							<input type="text" name="template_option_name" id="template_option_name"  class="input-xlarge text" />
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
