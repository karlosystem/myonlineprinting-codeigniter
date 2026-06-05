<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<?php


$tblname="exp_tbl_countries";
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$country=$CI->common_model->get_all_list($tblname);
//debug($result);
?>
<div class="right_content" style="min-height:400px;">
<h2><?php echo $title ?></h2>





			<form action="<?php echo base_url(); ?>admin/users/save_user" id="add_user_form" name="add_user_form" class="contact-form" method="POST">
			
			
				<ol>
					<li>
							<p>Username<span class="red">*</span></p>
							<input type="text"  name="u_name" id="u_name" class="input-xlarge text">
					</li>
					<li>
							<p> Password<span class="red">*</span></p>
							<input type="text"  name="u_password" id="u_password" class="input-xlarge text">
					</li>
					<li>
							<p> Company<span class="red">*</span></p>
							<input type="text"  name="u_comp" id="u_comp" class="input-xlarge text">
					</li>
					<li>
							<p> Country<span class="red">*</span></p>
							<select  name="u_country" id="u_country" class="input-xlarge text" onchange="get_by_id(this.value);">
								<option value="">select country</option>
							<?php
							foreach($country as $c)
							{
								echo '<option value='.$c["country_id"].'>'.$c["country_name"].'</option>';
							
							}
							?>
							</select>
					</li>
					<li id="states">
							<p>User State<span class="red">*</span></p>
							<select  name="u_state" id="u_state" class="input-xlarge text">
								<option value="">select state</option>
							</select>
							<p  id ="loader" style="margin-left:20px;margin-top:-4px;display:none"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif" /></p>
					</li>
					<li>
							<p> Address Line1</p>
							<textarea   name="u_address1" id="u_address1" class="input-xlarge text"></textarea>
					</li>
					<li>
							<p> Address Line2</p>
							<textarea   name="u_address2" id="u_address2" class="input-xlarge text"></textarea>
					</li>
					<li>
							<p> Postcode<span class="red">*</span></p>
							<input type="text"  name="u_postcode" id="u_postcode" class="input-xlarge text">
					</li>
					<li>
							<p> Email<span class="red">*</span></p>
							<input type="text"  name="u_email" id="u_email" class="input-xlarge text">
					</li>
					<li>
							<p> Phone<span class="red">*</span></p>
							<input type="text"  name="u_phone" id="u_phone" class="input-xlarge text">
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
