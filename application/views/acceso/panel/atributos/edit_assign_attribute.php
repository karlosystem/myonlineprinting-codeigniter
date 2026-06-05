<?php
//$assign_attributes come from controller

$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_products';
$product_array = $this->common_model->get_all_list($tbl_name);

$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_attributes';
$attrib_array = $this->common_model->get_all_list($tbl_name);

//getting all sub product name
$tbl_name = 'exp_tbl_sub_products';
$col = "p_id";
$p_id = $assign_attributes['p_id'];
$subproduct_array = $this->common_model->get_item_by_id($tbl_name, $col, $p_id);
#debug($subproduct_array);

//getting  all value name
$tbl_name = 'exp_tbl_attribute_values';
$col = "att_id";
$sp_id = $assign_attributes['att_id'];
$value_array = $this->common_model->get_result_array_by_id($tbl_name, $col, $sp_id);
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
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-4">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/assign_attributes/update" id="add_attribute_form" name="add_attribute_form" method="POST">
          <input type="hidden" name="id" value="<?php echo $assign_attributes['id']; ?>">

          <div class="row d-flex align-items-stretch">
            <div class="col-md-4">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Select Product
                </label>
                <select type="text" name="p_id" id="p_id" class="form-select" onchange="get_subproducts(this.value)">
                  <option value="">Select Product</option>
                  <?php
                  if (!empty($product_array)) {
                    foreach ($product_array as $a) { ?>
                      <option value="<?php echo $a['p_id'] ?>" <?php if ($a['p_id'] == $assign_attributes['p_id']) {
                                                                  echo  "selected='selected'";
                                                                } ?>><?php echo $a['p_name']; ?></option>

                  <?php  }
                  } ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Select Subproduct
                </label>
                <select type="text" name="sp_id" id="sp_id" class="form-select">
                  <option value="<?php echo $subproduct_array['sp_id'] ?>">
                    <?php echo $subproduct_array['sp_name'] ?>
                  </option>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Select Attribute
                </label>
                <select type="text" name="att_id" id="att_id" class="form-select" onchange="get_attrib_value(this.value)">
                  <option value="">Select Attribute</option>
                  <?php
                  if (!empty($attrib_array)) {
                    foreach ($attrib_array as $a) { ?>
                      <option value="<?php echo $a['att_id'] ?>" <?php if ($a['att_id'] == $assign_attributes['att_id']) {
                                                                    echo  "selected='selected'";
                                                                  } ?>><?php echo $a['att_name']; ?></option>

                  <?php  }
                  } ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Select Attribute Value
                </label>
                <select type="text" name="value_id" id="value_id" class="form-select">
                  <?php
                  if (!empty($value_array)) {
                    foreach ($value_array as $v) { ?>
                      <option value="<?php echo $v['value_id']; ?>" <?php if ((int)$v['value_id'] == (int)$assign_attributes['val_id']) {
                                                                      echo  "selected='selected'";
                                                                    } ?>>
                        <?php echo $v['value_name']; ?>
                      </option>
                  <?php  }
                  } ?>

                </select>
              </div>

              <div class="mb-3">
                <div>

                  <button type="submit" class="btn btn-primary btn-xs float-left">
                    Edit
                  </button>
                  <a href="<?php echo base_url(); ?>admin/assign_attributes" class="btn btn-dark btn-xs float-end">
                    Back to Listing</a>
                </div>
              </div>

            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>