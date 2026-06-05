<?php
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$tbl_name='exp_tbl_attributes';
$attribute_array = $this->common_model->get_all_list($tbl_name);
?>
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
		<form action="<?php echo base_url(); ?>admin/pricing/update_pricing" id="update_pricing_form" name="update_pricing_form" class="contact-form" method="POST" >
			<input type="hidden" name="pricing_id" value="<?php echo $pricing['pricing_id'];  ?>" />
			<ol>
				<li>
						<p>Price<span class="red">*</span></p>
						<input type="text"  name="price" id="price" class="input-xlarge text" value="<?php   if(!empty($pricing['price']))  {  echo  $pricing['price']; }?>" required>
				</li>
				<li>
				<div style="margin-left:130px;">
					<span class="bt_green_lft"></span>
						<input type="submit" value="Update Price"  class="submit_btn"/>		
					<span class="bt_green_r"></span>
				</div>
				</li>
				
			</ol>
		</form>
</div>
<!-- end of right content-->
</div>
