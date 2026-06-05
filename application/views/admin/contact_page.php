<?php 
//debug($contact_array);

?>
<script>
$(document).ready(function(){
$('#update_contact_form').validate({
			
						rules: 
						{
							  heading: 
							  {
								required: true
							  },
								address: 
							  {
								required: true
							  },
							  tel: 
							  {
								required: true,
								phoneUS: true
							  },
								fax: 
							  {
								required: true
							  },
								email: 
							  {
								required: true
							  },
								opening_hours: 
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


			<form action="<?php echo base_url(); ?>admin/copyservice/update_contact_page" id="update_contact_form" name="update_contact_form" class="contact-form" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="contact_id" value="<?php  echo $contact_array[0]['id'];  ?>" />
			
				<ol>
					
					<li>
							<p>Heading<span class="red">*</span></p>
							<textarea  name="heading" id="heading" class="input-xlarge text"><?php  echo $contact_array[0]['heading'];?></textarea>
					</li>
					<li>
							<p>Address<span class="red">*</span></p>
							<input type="text"  name="address" id="address" class="input-xlarge text" value="<?php  echo $contact_array[0]['address'];?>">
					</li>	
					
					<li>
							<p>Telephone<span class="red">*</span></p>
							<input type="text"  name="tel" id="tel" class="input-xlarge text" value="<?php  echo $contact_array[0]['tel'];?>">
					</li>
					<li>
							<p>Zip Code<span class="red">*</span></p>
							<input type="text"  name="zip_code" id="zip_code" class="input-xlarge text" value="<?php  echo $contact_array[0]['zip_code'];?>">
					</li>					
					<li>
							<p>Fax<span class="red">*</span></p>
							<input type="text"  name="fax" id="fax" class="input-xlarge text" value="<?php  echo $contact_array[0]['fax'];?>">
					</li>			
					<li>
							<p>Email<span class="red">*</span></p>
							<input type="text"  name="email" id="email" class="input-xlarge text" value="<?php  echo $contact_array[0]['email'];?>">
					</li>		
					<li>
							<p>Opening Hours<span class="red">*</span></p>
							<input type="text"  name="opening_hours" id="opening_hours" class="input-xlarge text" value="<?php  echo $contact_array[0]['opening_hours'];?>">
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
