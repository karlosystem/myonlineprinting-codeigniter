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

        <form action="<?php echo base_url(); ?>admin/attributes/save_attribute" id="add_attribute_form" name="add_attribute_form" method="POST" enctype="multipart/form-data">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-2 offset-md-3 text-center">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Attribute Name <code>(*)</code>
                </label>
                <input type="text" name="att_name" id="att_name" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 offset-md-3 text-center">
              <div class="float-right">
                <button type="submit" class="btn btn-primary px-4">
                  Save
                </button>
                <a class="btn btn-warning px-4" href="<?php echo base_url(); ?>admin/attributes/manage_attributes">Back to Listing</a>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</main>