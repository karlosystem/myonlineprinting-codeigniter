<?php
$tblname = "exp_tbl_products";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$products_array = $CI->common_model->get_all_list($tblname);
//debug($products_array);
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
  <div class="container-fluid px-4">
    <h1 class="mt-4">Add Sub Products</h1>

    <div class="card mb-1">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/sub_products/save_subproduct" id="subproduct_form" name="subproduct_form" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="p_qty_option_id" name="p_qty_option_id" value="0" />
          <div class="row d-flex align-items-stretch">
            <div class="col-md-6">
              <!-- product -->
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Product Name <code>(*)</code>
                </label>
                <select class="form-select" id="product_id" name="product_id">
                  <option value="">select product</option>
                  <?php
                  if (!empty($products_array)) {
                    foreach ($products_array as $p) { ?>
                      <option value="<?php echo $p['p_id']; ?>"><?php echo $p['p_name']; ?></option>
                  <?php  }
                  } ?>
                </select>
              </div>
              <!-- subname -->
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Subproduct Name <code>(*)</code>
                </label>
                <input type="text" class="form-control" id="sub_name" name="sub_name" />
              </div>
              <!-- Image -->
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Sub Product Image *.jpg (800px ancho - 600px alto)
                </label>
                <input class="form-control" id="sub_image" name="sub_image" type="file" />
              </div>

              <!-- content -->
              <div class="mb-3">
                <label for="input_post_content" class="form-label">
                  Content
                </label>
                <?php
                echo $this->ckeditor->editor("sub_description", '');
                ?>
              </div>


            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Date (Autogenerado - No obligatorio)
                </label>
                <input type="text" name="p_date" id="p_date" class="form-control" readonly placeholder="Enter Date" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Destacado
                </label>
                <div class="form-check">
                  <input type="checkbox" name="p_destacado" id="p_destacado" class="form-check-input" value="1" />
                </div>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Promocion
                </label>
                <div class="form-check">
                  <input type="checkbox" name="p_promocion" id="p_promocion" class="form-check-input" value="1" />
                </div>

              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Meta Title (Programador)
                </label>
                <input name="sp_meta_title" id="sp_meta_title" type="text" class="form-control " placeholder="Enter Meta Title" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Meta Description (Programador)
                </label>
                <input name="sp_meta_description" id="sp_meta_description" type="text" class="form-control " placeholder="Enter Meta Description" />
              </div>


            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div>
                <button type="submit" class="btn btn-primary btn-xs float-left">
                  Save
                </button>
                <a class="btn btn-dark btn-xs float-end" href="<?php echo base_url(); ?>admin/sub_products/manage_subproducts">Back to listing</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</main>