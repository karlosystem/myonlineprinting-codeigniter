<style>
.right_content{
	width: 655px;
	float:right;
}
label.error{

padding-left:50px; 
width:50%;
}
</style>

<script>

function get_turnaroud_time(option_id)
{
			url = base_url+'admin/template/get_turnaroud_time';
		
			$.ajax({
							type: "POST",
							url: url,
							data: "option_id="+option_id,
							async: true,
							success: function(msg)
							{ 
					
								if(msg)
								{	
									$("#turn_time").html(msg);
									
								}
								
					
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert("Error occured. Please try again later.");
					}
				
						});

}

</script>

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
			<form action="<?php echo base_url(); ?>admin/template/save_template_option_attributes" id="add_template_option_attribute_form" name="add_template_option_attribute_form" class="contact-form" method="POST" >
				<ol>
			
					<li>
							<p style="width:180px">Select Option Name<span class="red">*</span></p>
							<select name="template_option_id" id="template_option_id" class="input-xlarge text" onchange="get_turnaroud_time(this.value);">
							<option value=""> Select Option name</option>
							<?php if(!empty($get_all_option_name)) {foreach($get_all_option_name as $option_name) {?>
							<option value="<?php echo $option_name['template_option_id'];?>" > <?php echo $option_name['template_option_name'];?></option>
							
							<?php } }?>
							</select>
					</li>
					<li>
							<p style="width:180px">Enter Turnaround Time<span class="red">*</span></p>
							<span id="turn_time"><select name="turnaround_time" id="turnaround_time"  class="input-xlarge text">
							<option value="">Select Turnaround Time</option>
							
							</select></span>
					</li>
					<li>
							<p style="width:180px">Enter Quantity<span class="red">*</span></p>
							<input type="text" name="qty" id="qty"  class="input-xlarge text" />
					</li>
					<li>
							<p style="width:180px">Enter price<span class="red">*</span></p>
							<input type="text" name="price" id="price"  class="input-xlarge text" />
					</li>
					
					
					<li>
					<div style="margin-left:180px;">
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
