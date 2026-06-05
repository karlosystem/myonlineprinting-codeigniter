<?php
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
        <form method="post" id="password_form" action="<?php echo base_url(); ?>admin/admin/update_password">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-3">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Old Password
                </label>
                <input type="text" value="" name="old_password" class="form-control">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  New Password
                </label>
                <input type="text" value="" name="new_password" class="form-control">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Confirm Password
                </label>
                <input type="text" value="" name="confirm_password" class="form-control">
              </div>
              <div class="mb-3">
                <div class="col-md-2">
                  <div class="float-right">
                    <input type="submit" value="Save" class="btn btn-info" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>