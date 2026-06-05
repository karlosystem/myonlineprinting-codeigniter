<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_products';
$product_array = $this->common_model->get_all_list($tbl_name);

$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_attributes';
$attrib_array = $this->common_model->get_all_list($tbl_name);
?>

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
  <div class="container-fluid px-2">
    <h1 class="mt-2"><?php echo $title ?></h1>

    <div class="card mb-1">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/assign_attributes/save" id="assign_attribute_form" name="assign_attribute_form" method="POST">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-4">
              <!-- title -->
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Select Product <code>(*)</code>
                </label>
                <select type="text" name="p_id" id="p_id" class="form-select" onchange="get_subproducts(this.value)">
                  <option value="">Select Product</option>
                  <?php
                  foreach ($product_array as $a) { ?>
                    <option value="<?php echo $a['p_id'] ?>"><?php echo $a['p_name']; ?></option>

                  <?php  } ?>
                </select>
              </div>
              <!-- subproduct -->
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Select Subproduct <code>(*)</code>
                </label>
                <select type="text" name="sp_id" id="sp_id" class="form-select">
                  <option value="">Select Subproduct</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Select Attribute <code>(*)</code>
                </label>
                <select type="text" name="att_id" id="att_id" class="form-select" onchange="get_attrib_value(this.value)">
                  <option value="">Select Attribute</option>
                  <?php
                  foreach ($attrib_array as $a) { ?>
                    <option value="<?php echo $a['att_id'] ?>"><?php echo $a['att_name']; ?></option>

                  <?php  } ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Select Attribute value <code>(*)</code>
                </label>
                <select type="text" name="value_id" id="value_id" class="form-select">
                  <option value="">Select attribute value</option>
                </select>
              </div>

              <div class="mb-3">
                <div class="float-right">

                  <button type="submit" class="btn btn-primary px-4">
                    Save
                  </button>

                  <a class="btn btn-dark btn-xs float-end" href="<?php echo base_url(); ?>admin/assign_attributes">
                    Back to Listing
                  </a>

                </div>
              </div>

            </div>
            <div class="col-md-8">
              <!-- catgeory -->
              <div class="mb-3">
                <label for="input_post_description" class="form-label">

                </label>
                <div class="form-control overflow-auto" style="height: 886px">

                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>

  </div>
</main>