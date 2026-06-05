<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckfinder/ckfinder.js"></script>
	
<style>
.right_content{
	width: 655px;
	float:right;
}
</style>

<div class="right_content">
<h2><?php if(!empty($title)) { echo $title; } ?></h2>

<div id="warning_box1"></div>	
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

		
		<form method="post" name="add_main_slider" id="add_main_slider" action="<?php echo base_url();?>admin/slider/save_main_slider" class="contact-form" enctype="multipart/form-data">
				<input type="hidden" name="page_id" value="<?php echo $this->uri->segment(4);?>" />
				
				<ol>
					<li>				
							<p>Name TextColor<span class="red">*</span></p>
							<input type="text" name="slider_name"  class="input-xlarge text"/>
					</li>	
						
					<li>				
							<p>Name Gray<span class="red">*</span></p>
							<input type="text" name="slider_name_gray"  class="input-xlarge text"/>
					</li>	

					<li>
							<p>Slider Link<span class="red">*</span></p>
							<input type="text" name="banner_link"  class="input-xlarge text"/>
					</li>

					<li>
							<p>Slider Description<span class="red">*</span></p>
							<p>
							<?php
								echo $this->ckeditor->editor("banner_description",''); 
							?>										
							</p>		
					</li>

					<li>
							<p>Slider Data-X<span class="red">*</span></p>
							<select name="banner_data-x-1" id="banner_data-x-1" class="input-xlarge text">
								<option value="">select direction</option>
								<option value="right">Right</option>
								<option value="left">Left</option>
							</select>
					</li>

					<li>
							<p>Slider Hoffset<span class="red">*</span></p>
							<input type="text" name="banner_data-hoffset"  class="input-xlarge text"/>
					</li>

					<li>
							<p>Slider Data-Y<span class="red">*</span></p>
							<input type="text" name="banner_data-y-1"  class="input-xlarge text"/>
					</li>
					
					<li>				
							<p>Slider Image(1920px-598px)<span class="red">*</span></p>
							<input type="file" name="slider_image" class="input-xlarge text"/>
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

</div>