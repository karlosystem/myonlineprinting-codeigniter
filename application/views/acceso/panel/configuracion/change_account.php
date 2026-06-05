<?php
$id = $this->uri->segment(4);
if ($this->session->userdata("valid_box")) {
  echo "<div class='alert alert-success' role='alert'>";
  echo $this->session->userdata("success_message");
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("valid_box");
  echo "</div>";
} else if ($this->session->userdata("error_box")) {
  echo "<div class='alert alert-danger' role='alert'>";
  echo $this->session->userdata("success_message");
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("error_box");
  echo "</div>";
}
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" id="admin_detail_form" action="<?php if ($id == 4) { ?><?php echo base_url(); ?>admin/admin/update_admin_detail<?php } ?>">

          <div class="row d-flex align-items-stretch">
            <div class="col-md-3">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Username
                </label>
                <input type="text" value="<?php echo $get_admin_detail['username']; ?>" id="user_name" name="user_name" class="form-control" <?php if ($id == 4) {
                                                                                                                                              } else { ?>disabled<?php } ?>>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Email
                </label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $get_admin_detail['email']; ?>" <?php if ($id == 4) {
                                                                                                                                  } else { ?>disabled<?php } ?>>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-md-3 float-left">
              <div class="float-left">
                <?php if ($id == 4) { ?>
                  <input type="submit" value="Submit" class="btn btn-info" />
                <?php } else { ?>
                  <a href="<?php echo base_url(); ?>admin/admin/change_account/4"><input type="button" value="Edit" class="btn btn-info" /></a>
                <?php } ?>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>