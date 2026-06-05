<script>
$(document).ready(function(){
$('#edit_user_form').validate({
		 
				rules: {
				  u_name: {
					
					required: true
				  },
				  u_password: 
				  {
					required: true,
				   
				  },
				 u_comp: 
				  {
					required: true,
				   
				  },
				   u_country: 
				  {
				   required: true
				  },
				    u_state: 
				  {
				   required: true
				  },
				   u_postcode: 
				  {
				   required: true,
				   number:true
				  },
				   u_email: 
				  {
				   required: true
				  },
				   u_phone: 
				  {
				   required: true,
				   phoneUS: true
				  }
				 
				},
				
				
				submitHandler: function(form) 
				{
							check_duplicate_email_update();
				}
			
			
		});

});


	function check_duplicate_email_update()
{
	var email=$("#u_email").val();
	var user_id=$("#user_id").val();
	//alert(user_id);
	url = base_url+"admin/users/check_duplicate_email_update";
	$.ajax({
	        type: "POST",
	        url: url,
	        data: "email="+email+"&user_id="+user_id,
	        async: true,
	        success: function(msg)
	        { 
				//alert(msg);
				if(msg==1)
				{	
					alert("email already exists.try another email");
					location.href=location.href;
					return false;
				}
				else{
					document.edit_user_form.submit();
	
				}

				
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				alert("Error occured. Please try again later.");
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
<?php

 //code for getting all countries
$tblname="exp_tbl_countries";
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$country=$CI->common_model->get_all_list($tblname);


//code for getting value of state
$tbl_state="exp_tbl_states";
$s_col="state_id";
$s_value=$result['u_state'];
$state=$CI->common_model->get_item_by_id($tbl_state,$s_col,$s_value);
//debug($state);
?>
<div class="right_content" style="min-height:400px;">
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

			<form action="<?php echo base_url(); ?>admin/users/update_user" id="edit_user_form" name="edit_user_form" class="contact-form" method="POST">
			
			<input type="hidden" name="user_id" id="user_id"  value="<?php if(!empty($result['u_id'])){ echo $result['u_id']; }  ?>" />
				<ol>
					<li>
							<p>Username<span class="red">*</span></p>
							<input type="text"  name="u_name" id="u_name" class="input-xlarge text" value="<?php  if(!empty($result['u_name'])){ echo $result['u_name']; } ?>">
					</li>
					
					<li>
							<p> Company<span class="red">*</span></p>
							<input type="text"  name="u_comp" id="u_comp" class="input-xlarge text" value="<?php  if(!empty($result['u_comp'])){ echo $result['u_comp']; } ?>">
					</li>
					<li>
							<p> Country<span class="red">*</span></p>
							<select  name="u_country" id="u_country" class="input-xlarge text" onchange="get_by_id(this.value);">
								<option value="">select country</option>
							<?php
							foreach($country as $c)
							{ ?>
								<option value=<?php echo $c["country_id"];?>  <?php if($c["country_id"]==$result['u_country']) { echo "selected"; } ?>><?php echo $c["country_name"];?></option >
							
							<?php }
							?>
							</select>
					</li>
					<li id="states">
							<p> State<span class="red">*</span></p>
							<select  name="u_state" id="u_state" class="input-xlarge text">
								<option value="<?php if(!empty( $result['u_state'])) echo $result['u_state'];  ?>"><?php if(!empty( $state['state_name'])) echo $state ['state_name']?></option>
							</select>
							<p  id ="loader" style="margin-left:20px;margin-top:-4px;display:none"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif" /></p>
					</li>
					<li>
							<p> Address Line1</p>
							<textarea   name="u_address1" id="u_address1" class="input-xlarge text"><?php  if(!empty($result['u_add_line1'])){ echo $result['u_add_line1']; } ?></textarea>
					</li>
					<li>
							<p> Address Line2</p>
							<textarea   name="u_address2" id="u_address2" class="input-xlarge text"><?php  if(!empty($result['u_add_line2'])){ echo $result['u_add_line2']; } ?></textarea>
					</li>
					<li>
							<p> Postcode<span class="red">*</span></p>
							<input type="text"  name="u_postcode" id="u_postcode" class="input-xlarge text" value="<?php  if(!empty($result['u_postcode'])){ echo $result['u_postcode']; } ?>">
					</li>
					<li>
							<p> Email<span class="red">*</span></p>
							<input type="text"  name="u_email" id="u_email" class="input-xlarge text" value="<?php  if(!empty($result['u_email'])){ echo $result['u_email']; } ?>">
					</li>
					<li>
							<p> Phone<span class="red">*</span></p>
							<input type="text"  name="u_phone" id="u_phone" class="input-xlarge text" value="<?php  if(!empty($result['u_phone'])){ echo $result['u_phone']; } ?>">
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
