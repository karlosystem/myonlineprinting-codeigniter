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
<script>
  $(document).ready(function() {
    $('#update_contact_form').validate({
      rules: {
        heading: {
          required: true
        },
        address: {
          required: true
        },
        tel: {
          required: true,
          phoneUS: true
        },
        fax: {
          required: true
        },
        email: {
          required: true
        },
        opening_hours: {
          required: true
        },
      },
    });
  })
</script>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php if (!empty($title)) {
                        echo $title;
                      } ?></h1>

    <div class="card mb-4">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/copyservice/update_contact_page" id="update_contact_form" name="update_contact_form" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="contact_id" value="<?php echo $contact_array[0]['id'];  ?>" />

          <input type="hidden" name="old_image01" value="<?php echo $contact_array[0]['banner01']; ?>" />
          <input type="hidden" name="old_image02" value="<?php echo $contact_array[0]['banner02']; ?>" />
          <input type="hidden" name="old_image03" value="<?php echo $contact_array[0]['banner03']; ?>" />

          <div class="row d-flex align-items-stretch">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Heading
                </label>
                <textarea rows="6" name="heading" id="heading" class="form-control"><?php echo $contact_array[0]['heading']; ?></textarea>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Address
                </label>
                <input type="text" name="address" id="address" class="form-control" value="<?php echo $contact_array[0]['address']; ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Telephone
                </label>
                <input type="text" name="tel" id="tel" class="form-control" value="<?php echo $contact_array[0]['tel']; ?>">
              </div>

            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Zip Code
                </label>
                <input type="text" name="zip_code" id="zip_code" class="form-control" value="<?php echo $contact_array[0]['zip_code']; ?>">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  FAX
                </label>
                <input type="text" name="fax" id="fax" class="form-control" value="<?php echo $contact_array[0]['fax']; ?>">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Email
                </label>
                <input type="text" name="email" id="email" class="form-control" value="<?php echo $contact_array[0]['email']; ?>">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Opening Hours
                </label>
                <input type="text" name="opening_hours" id="opening_hours" class="form-control" value="<?php echo $contact_array[0]['opening_hours']; ?>">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Numero de whastapp
                </label>
                <input type="text" name="whastapp" id="whastapp" class="form-control" value="<?php echo $contact_array[0]['whastapp']; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="input_banner_01" class="form-label">
                  Banner Image 01 (849px-227px)
                </label>
                <input type="file" name="banner01" class="form-control" />
              </div>
              <div class="mb-3">
                <img src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner01']; ?>" style="width:470px;">
              </div>
              <div class="mb-3">
                <label for="input_banner_02" class="form-label">
                  Banner Image 02 (264px - 444px)
                </label>
                <input type="file" name="banner02" class="form-control" />
              </div>
              <div class="mb-3">
                <center>
                  <img src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner02']; ?>" style="width:70px;">
                </center>
              </div>
              <div class="mb-3">
                <label for="input_banner_03" class="form-label">
                  Banner Image 03 (1141px - 200px)
                </label>
                <input type="file" name="banner03" class="form-control" />
              </div>
              <div class="mb-3">
                <center>
                  <img src="<?php echo base_url(); ?>assets/images/admin/publicidad/<?php echo $contact_array[0]['id']; ?>/<?php echo $contact_array[0]['banner03']; ?>" style="width:510px;">
                </center>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="float-right">
                <input type="submit" value="Save" class="btn btn-primary btn-xs float-left" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</main>