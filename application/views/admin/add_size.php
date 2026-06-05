<script>
$(document).ready(function(){
$('#add_size_form').validate({
			
						rules: 
						{
							  size_name: 
							  {
								required: true
							  },
						},
							  submitHandler: function(form) 
							  {
									var size_name=$("#size_name").val();
									//alert(qty_name);
									ajax_check_duplicate_size(size_name);
							  }
							 	
		
			});

})

function ajax_check_duplicate_size(size_name)
{
	//alert(qty_name);
	url = base_url+"admin/common/check_duplicate_size";

	$.ajax({
		type: "POST",
		url: url,
		data: "size_name="+size_name,
		success: function(msg) 
		{
			
			if(msg==1)
			{ 
				alert("OOPS!!!!!size already exists. Please try another");
				return false;
			} 
			else 
			{
				document.add_size_form.submit();
			}
		}								
	});	


}
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


			<form action="<?php echo base_url(); ?>admin/common/save_size" id="add_size_form" name="add_size_form" class="contact-form" method="POST" enctype="multipart/form-data">
			
			
				<ol>
					
					<li>
							<p>Size<span class="red">*</span></p>
							<input type="text"  name="size_name" id="size_name" class="input-xlarge text">
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
