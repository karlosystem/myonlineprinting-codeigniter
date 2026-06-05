<script>
$(document).ready(function(){

			$("#add_turnaround_form").validate({
			rules:{
					turnaround_time:{required:true },
					template_option_id:{required: true}
				},

			submitHandler:function(form){
					
							check_duplicate_turnaround();
			}

			});

});
function check_duplicate_turnaround()
{
				var option_id=$("#template_option_id").val();
				var turnaround=$("#turnaround_time").val();

				$.ajax({
						type:"POST",
						url:base_url+"admin/template/check_duplicate_turnaround",
						data:"option_id="+option_id+"&turnaround="+turnaround,
									
						success:function(msg)
						{	
												
							if(msg==1)
							{
									alert("OOPS!!!! turnaround time already exists for this option");
									return false;
							}
							else{
									document.add_turnaround_form.submit();
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
label.error{

padding-left:50px; 
width:50%;
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
			<form action="<?php echo base_url(); ?>admin/template/save_turnaround_time" id="add_turnaround_form" name="add_turnaround_form" class="contact-form" method="POST" >
				<ol>
			
					<li>
							<p style="width:180px;">Select Option Name<span class="red">*</span></p>
							<select name="template_option_id" id="template_option_id" class="input-xlarge text">
							<option value=""> Select Option name</option>
							<?php if(!empty($get_all_option_name)) {foreach($get_all_option_name as $option_name) {?>
							<option value="<?php echo $option_name['template_option_id'];?>" > <?php echo $option_name['template_option_name'];?></option>
							
							<?php } }?>
							</select>
					</li>
					<li>
							<p style="width:180px;">Enter Turnaround Time<span class="red">*</span></p>
							<input type="text" name="turnaround_time" id="turnaround_time" class="input-xlarge text">
							
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
