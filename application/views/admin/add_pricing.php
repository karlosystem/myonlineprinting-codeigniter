<?php
$CI=&get_Instance();
$CI->load->model("admin/common_model");

//getting quantities
$tbl_name='exp_tbl_qty';
$qty_array = $this->common_model->get_all_list($tbl_name);



//getting sizes
$tbl_name1='tbl_size';
$size_array = $this->common_model->get_all_list($tbl_name1);

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
$p_id=$this->uri->segment(4);
$sp_id=$this->uri->segment(5);

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


			<form action="<?php echo base_url(); ?>admin/pricing/save_price" id="add_pricing_form" name="add_pricing_form" class="contact-form" method="POST" >
			<input type="hidden" name="p_id"  id="p_id" value="<?php  echo $p_id; ?>" />
			<input type="hidden" name="sp_id"  id= "sp_id" value="<?php  echo $sp_id; ?>" />
				<ol>
					
					<?php
						$counter=0;
						foreach($attributes_names as  $a) {
					
						$p_id=$a['p_id'];
						$sp_id=$a['sp_id'];
						$att_id=$a['att_id'];
					?>
					<li>
							<p><?php echo $a['att_name'] ;?><span class="red">*</span></p>
							<?php  echo get_values($p_id,$sp_id,$att_id,$counter);?>
					</li>
					<?php   $counter++; } ?>
					<li>
							<p>Select Quantity<span class="red">*</span></p>
							<select name="quantity" id="quantity"  class="input-xlarge text" />
									<option value="">select qty</option>
									<?php 
									if(!empty($qty_array))
									{
											foreach($qty_array as $q){ ?>
												<option value="<?php  echo $q["qty_id"]; ?>"><?php  echo $q["qty_name"] ?></option>
									<?php } 
									}
									?>
							</select>
					</li>
					
					<li>
							<p>Select Size<span class="red">*</span></p>
							<select name="size" id="size"  class="input-xlarge text" />
									<option value="">select size</option>
									<?php 
									if(!empty($size_array))
									{
											foreach($size_array as $s){ ?>
												<option value="<?php  echo $s["size_id"]; ?>"><?php  echo $s["size_name"] ?></option>
									<?php } 
									}
									?>
							</select>
					</li>
					
					<li>
							<p>Price<span class="red">*</span></p>
							<input type="text" name="price" id="price"  class="input-xlarge text" />
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
