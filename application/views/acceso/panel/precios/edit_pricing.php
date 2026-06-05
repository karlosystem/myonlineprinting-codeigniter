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
  <div class="container-fluid px-2">
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <form action="<?php echo base_url(); ?>admin/pricing/update_pricing" id="update_pricing_form" name="update_pricing_form" method="POST">
            <input type="hidden" name="pricing_id" value="<?php echo $pricing['pricing_id'];  ?>" />
            <div class="row d-flex align-items-stretch">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Product Price
                </label>
                <input type="text" name="price" id="price" class="form-control" value="<?php if (!empty($pricing['price'])) {
                                                                                          echo  $pricing['price'];
                                                                                        } ?>" required>
              </div>

              <div class="mb-3">
                <div>
                  <a class="btn btn-dark btn-xs float-end" href="<?php echo base_url(); ?>admin/pricing/manage_price">
                    Back to Listing
                  </a>
                  <input type="submit" value="Edit" class="btn btn-primary btn-xs float-left" />
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>


  </div>
</main>