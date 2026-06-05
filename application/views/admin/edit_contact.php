<style>
.right_content{
	width: 655px;
	float:right;
}
</style>
<script src="<?php echo base_url();?>ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>ckfinder/ckfinder.js"></script>
<div class="right_content">
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
    <form method="post" name="edit_contact" id="edit_contact" action="" class="contact-form">
		<input type="hidden" name="contact_id" value="<?php echo $result['id']; ?>" />
        <ol>
            <li>
                <p>Name<span class="red">*</span></p>
                <input type="text" name="contact_name" class="input-xlarge text"  value="<?php  echo $result['name']  ?>"/>
            </li>	
            <li>
                <p>Mobile<span class="red">*</span></p>
                <input type="text" name="contact_mobile" class="input-xlarge text"  value="<?php  echo $result['mobile']  ?>"/>
            </li>	
            <li>
                <p>Email<span class="red">*</span></p>
                <input type="text" name="contact_email" class="input-xlarge text"  value="<?php  echo $result['email']  ?>"/>
            </li>	
            <li>
                <p>Enquiry<span class="red">*</span></p>
                <input type="text" name="contact_enquiri" class="input-xlarge text"  value="<?php  echo $result['enquiry']  ?>"/>
            </li>	
            <li>
                <p>Create at<span class="red">*</span></p>
                <input type="text" name="contact_create" class="input-xlarge text"  value="<?php  echo $result['create_at']  ?>"/>
            </li>	
        </ol>
    </form>

</div>