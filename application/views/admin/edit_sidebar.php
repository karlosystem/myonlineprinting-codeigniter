<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<script src="<?php echo base_url();?>ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>ckfinder/ckfinder.js"></script>
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
		
		<form method="post" name="edit_sidebar" id="edit_sidebar" action="<?php echo base_url();?>admin/right_sidebar/update_sidebar" class="contact-form">
				<input type="hidden" name="sidebar_id" value="<?php echo $sidebar['id']; ?>" />				
				<ol>
					<li>				
							<p>Sidebar Title<span class="red">*</span></p>
							<input type="text" name="sidebar_title"  class="input-xlarge text"  value="<?php  echo $sidebar['sidebar_title']  ?>"/>
					</li>	
					<li>
							<p>Sidebar content<span class="red">*</span></p>	
							<p>
							<?php
								echo $this->ckeditor->editor("sidebar_content",$sidebar['sidebar_content']); 
							?>	
							</p>								
					</li>
					<li>
						
						
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

</div>
