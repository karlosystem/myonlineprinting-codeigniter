<script>
  $(document).ready(function() {
    $('#edit_size_form').validate({
      rules: {
        size_name: {
          required: true
        },
      },

    });
  })
</script>
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
        <form action="<?php echo base_url(); ?>admin/common/update_size" id="edit_size_form" name="edit_size_form" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="size_id" value="<?php echo $size_detail['size_id'];  ?>" />

          <div class="row d-flex align-items-stretch">
            <div class="col-md-2">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Size
                </label>
                <input type="text" name="size_name" id="size_name" class="form-control" value="<?php echo $size_detail["size_name"]; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <div class="float-left">
                <input type="submit" value="Save" class="btn btn-info" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>