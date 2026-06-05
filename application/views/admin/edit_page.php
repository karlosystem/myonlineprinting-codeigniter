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
		<form method="post" name="add_page" id="add_page" action="<?php echo base_url();?>admin/pages/update_page" class="contact-form" enctype="multipart/form-data">
				<input type="hidden" name="page_id" value="<?php echo $page["page_id"]; ?>" />	
				<input type="hidden" name="old_image" value="<?php echo $page['page_image']; ?>" />				
				<ol>
					<li>				
						<p>Page Name<span class="red">*</span></p>
						<input type="text" name="page_name"  class="input-xlarge text" value="<?php  echo $page["page_name"]  ?>"/>						
					</li>	
					<li>
						<p>Page Title<span class="red">*</span></p>
						<input type="text" name="page_title"  class="input-xlarge text"  value="<?php  echo $page["page_title"];?>"/>
					</li>	
					<li>
						<p>Page Leyenda<span class="red">*</span></p>
						<textarea name="page_leyenda" id="page_leyenda" cols="30" rows="10"><?php  echo $page["page_leyenda"];?></textarea>
					</li>	
					<li>
						<p>Page Meta Title<span class="red">*</span></p>
						<input type="text" name="page_meta_title" class="input-xlarge text"  value="<?php  echo $page["page_meta_title"]  ?>"/>
					</li>	
					<li>
						<p>Page Meta Description<span class="red">*</span></p>
						<input type="text" name="page_meta_description" class="input-xlarge text"  value="<?php  echo $page["page_meta_description"]  ?>"/>
					</li>	
					<li>
						<p>Page Meta Keywords<span class="red">*</span></p>
						<input type="text" name="page_meta_keywords" class="input-xlarge text"  value="<?php  echo $page["page_meta_keywords"]  ?>"/>
					</li>	

					<li>
						<p>Page Icono<span class="red">*</span></p>
						<input type="text" name="page_icono" class="input-xlarge text" value="<?php echo $page["page_icono"];?>"/>
					</li>	

					<li>				
							<p>Page Image (557px-396px)<span class="red">*</span></p>
							<input type="file" name="page_image" class="input-xlarge text"/>
					</li>	
					 
					<li>
					<p>Existing Image<span class="red">*</span></p>
					<img src="<?php echo base_url();?>assets/images/admin/main_page_image/<?php echo $page['page_id'] ?>/<?php echo $page['page_image'] ?>" style="height:80px;width:80px;"/>
					</li>

					<li>
						<p>Page Description<span class="red">*</span></p>	
						<p>
						<?php
							echo $this->ckeditor->editor("page_description","page_description",$page['page_description']); 
						?>	
						</p>							
					</li>		
					<li>
							<p>Status</p>
							<input type="checkbox" name="page_status" id="page_status" value="1" <?php if($page['page_status']==1) echo "checked";?> />
					</li>
					<li>
							<p>Portada</p>
							<input type="checkbox" name="page_portada" id="page_portada" value="1" <?php if($page['page_portada']==1) echo "checked";?>/>
					</li>							
					<li>
					</li>
					<li>
					<div style="margin-left:130px;">
						<span class="bt_green_lft"></span>
							<input type="submit" value="Update" class="submit_btn"/>		
						<span class="bt_green_r"></span>
					</div>
					</li>

				</ol>
			</form>
			
   
</div>

</div>