<style>
	.right_content {
		width: 655px;
		float: right;
	}
</style>

<?php //debug($get_admin_detail);
?>
<div class="right_content">
	<h2><?php echo $title; ?></h2>
	<?php
	if ($this->session->userdata("valid_box")) {
		echo '<div class="valid_box">';
		echo $this->session->userdata("success_detail_message");
		echo '</div>';
		$this->session->unset_userdata("success_detail_message");
		$this->session->unset_userdata("valid_box");
	}

	$id = $this->uri->segment(4);

	?>

	<form method="post" class="contact-form" id="admin_detail_form" action="<?php if ($id == 4) { ?><?php echo base_url(); ?>admin/admin/update_admin_detail<?php } ?>">

		<fieldset>
			<ol>
				<li>
					<div class="control-group">
						<p>Username<span class="red">*</span></p>
						<input type="text" value="<?php echo $get_admin_detail['username']; ?>" id="user_name" name="user_name" class="input-xlarge text" <?php if ($id == 4) {
																																																																							} else { ?>disabled<?php } ?>>
					</div>
				</li>

				<li>
					<p>Email<span class="red">*</span></p>
					<input type="text" class="input-xlarge text" name="email" id="email" value="<?php echo $get_admin_detail['email']; ?>" <?php if ($id == 4) {
																																																																} else { ?>disabled<?php } ?>>
				</li>
				<li>
					<div style="margin-left:130px;">
						<span class="bt_green_lft"></span>
						<?php if ($id == 4) { ?>
							<input type="submit" value="Submit" class="submit_btn" />
						<?php } else { ?>
							<a href="<?php echo base_url(); ?>admin/admin/change_account/4"><input type="button" value="Edit" class="submit_btn" /></a>
						<?php } ?>
						<span class="bt_green_r"></span>
					</div>



				</li>

			</ol>

		</fieldset>

	</form>

</div>
<!-- end of right content-->
</div>