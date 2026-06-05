<?php
if ($this->session->userdata("error_box")) {
  echo '<div class="error_box">';
  echo $this->session->userdata("success_message");
  echo '</div>';
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("error_box");
}
if ($this->session->userdata("valid_box")) {
  echo '<div class="valid_box">';
  echo $this->session->userdata("success_message");
  echo '</div>';
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("valid_box");
}
?>

<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Preview Contact</h1>
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" name="edit_contact" id="edit_contact">
          <input type="hidden" name="contact_id" value="<?php echo $result['id']; ?>" />
          <div class="row d-flex align-items-stretch">
            <div class="col-md-4">
              <!-- title -->
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Name
                </label>
                <input disabled type="text" name="contact_name" class="form-control" value="<?php echo $result['name']  ?>" />
              </div>
              <!-- slug -->
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Mobile
                </label>
                <input disabled type="text" name="contact_name" class="form-control" value="<?php echo $result['mobile']  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Email
                </label>
                <input disabled type="text" name="contact_name" class="form-control" value="<?php echo $result['email']  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Date
                </label>
                <input disabled type="text" name="contact_name" class="form-control" value="<?php echo $result['create_at']  ?>" />
              </div>

              <!-- description -->
              <div class="mb-3">
                <label for="input_post_description" class="form-label">
                  Enquiry
                </label>
                <textarea disabled id="input_post_description" name="description" placeholder="Descripcion" class="form-control" rows="3"><?php echo $result['enquiry']  ?></textarea>
              </div>

            </div>
            <div class="col-md-8">
              <!-- catgeory -->
              <div class="mb-3">
                <label for="input_post_description" class="form-label">

                </label>
                <div class="form-control overflow-auto" style="height: 350px">

                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="row">
          <div class="col-md-12">
            <div class="float-right">
              <a class="btn btn-warning px-4" href="<?php echo base_url(); ?>admin/copyservice/list_contact_us">Back</a>
              <button type="submit" class="btn btn-primary px-4">
                Edit
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>