<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_attributes';
$attribute_array = $this->common_model->get_all_list($tbl_name);

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
    <h1 class="mt-4"><?php echo $title; ?></h1>
    <div class="col-md-3">
      <div class="card mb-4">
        <div class="card-body">
          <form action="<?php echo base_url(); ?>admin/values/save_value" id="add_value_form" name="add_value_form" method="POST">

            <div class="mb-3">
              <label for="input_post_title" class="form-label">
                Select Attribute
              </label>
              <select type="text" name="att_id" id="att_id" class="form-select">
                <option value="">Select attribute</option>
                <?php
                foreach ($attribute_array as $a) { ?>
                  <option value="<?php echo $a['att_id'] ?>"><?php echo $a['att_name']; ?></option>

                <?php  } ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="input_post_title" class="form-label">
                Value
              </label>
              <input type="text" name="value_name" id="value_name" class="form-control">
            </div>

            <div class="row">
              <div class="col-md-12">
                <div>
                  <button type="submit" class="btn btn-primary btn-xs float-left">
                    Save
                  </button>
                  <a class="btn btn-dark btn-xs float-end" href="<?php echo base_url(); ?>admin/values/manage_values">Back to listing</a>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>