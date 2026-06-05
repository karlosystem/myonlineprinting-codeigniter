<style>
.right_content{
	width: 655px;
	float:right;
}
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckfinder/ckfinder.js"></script>
	

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
		<form method="post" name="edit_main_slider" id="edit_main_slider" action="<?php echo base_url();?>admin/slider/update_main_slider" class="contact-form" enctype="multipart/form-data">
				<input type="hidden" name="slider_id" value="<?php echo $slider['banner_id']; ?>" />
				<input type="hidden" name="old_image" value="<?php echo $slider['banner_image']; ?>" />				
				<ol>
					<li>				
							<p>Name TextColor<span class="red">*</span></p>
							<input type="text" name="slider_name" class="input-xlarge text" value="<?php if(!empty($slider['banner_title'])) { echo  $slider['banner_title']; }  ?>"/>
					</li>
					<li>				
							<p>Name Gray<span class="red">*</span></p>
							<input type="text" name="slider_name_gray" class="input-xlarge text" value="<?php if(!empty($slider['banner_title_gray'])) { echo  $slider['banner_title_gray']; }  ?>"/>
					</li>
					<li>				
							<p>Slider Link<span class="red">*</span></p>
							<input type="text" name="banner_link"  class="input-xlarge text" value="<?php if(!empty($slider['banner_link'])) { echo $slider['banner_link']; }  ?>"/>
					</li>					
					<li>
							<p>Slider Description<span class="red">*</span></p>
							<p>
							<?php
								echo $this->ckeditor->editor("banner_description","banner_description",$slider['banner_description']); 
							?>							
							</p>
					</li>
					<li>
							<p>Slider Data-X<span class="red">*</span></p>
							<select name="banner_data-x-1" id="banner_data-x-1" class="input-xlarge text">
								<option value="">select direction</option>
								<option value="right" <?php echo $select=($slider['banner_data-x-1']=="right")?"selected":"";?>>Right</option>
								<option value="left" <?php echo $select=($slider['banner_data-x-1']=="left")?"selected":"";?>>Left</option>
							</select>
					</li>

					<li>
							<p>Slider Data-Y<span class="red">*</span></p>
							<input type="text" name="banner_data-y-1" value="<?php if(!empty($slider['banner_data-y-1'])) { echo  $slider['banner_data-y-1']; } ?>" class="input-xlarge text"/>
					</li>

					<li>
							<p>Slider Hoffset<span class="red">*</span></p>
							<input type="text" name="banner_data-hoffset" value="<?php if(!empty($slider['banner_data-hoffset'])) { echo  $slider['banner_data-hoffset']; }  ?>" class="input-xlarge text"/>
					</li>

					<li>				
							<p>Slider Image (1920px-598px)<span class="red">*</span></p>
							<input type="file" name="slider_image" class="input-xlarge text"/>
					</li>	
					<li>
				
							<p>Existing Image<span class="red">*</span></p>
							<img src="<?php echo base_url();?>assets/images/admin/main_slider_image/<?php echo $slider['banner_id'] ?>/<?php echo $slider['banner_image'] ?>" style="height:80px;width:80px;"/>
							
						
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
