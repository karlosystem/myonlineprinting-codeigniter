<script>
$(document).ready(function(){
$('#edit_size_form').validate({
			
						rules: 
						{
							  size_name: 
							  {
								required: true
							  },
						},
							  
							 	
		
			});

})


</script>


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


			<form action="<?php echo base_url(); ?>admin/common/update_size" id="edit_size_form" name="edit_size_form" class="contact-form" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="size_id" value="<?php  echo $size_detail['size_id'];  ?>" />
			
				<ol>
					
					<li>
							<p>Quantity<span class="red">*</span></p>
							<input type="text"  name="size_name" id="size_name" class="input-xlarge text" value="<?php  echo $size_detail["size_name"]; ?>">
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
