<?php
$tblname = "exp_tbl_products";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$products_array = $CI->common_model->get_all_list($tblname);
//debug($subproduct);
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
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/sub_products/update_subproduct" id="subproduct_form1" name="subproduct_form1" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="sp_id" name="sp_id" value="<?php echo $subproduct['sp_id']; ?>" />
          <input type="hidden" id="	old_image" name="old_image" value="<?php echo $subproduct['sp_image']; ?>" />

          <div class="row d-flex align-items-stretch">
            <div class="col-md-6">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Product Name
                </label>
                <select class="form-select" id="product_id" name="product_id">
                  <?php
                  if (!empty($products_array)) {
                    foreach ($products_array as $p) { ?>
                      <option value="<?php echo $p['p_id']; ?>" <?php if ($p['p_id'] == $subproduct['p_id']) {
                                                                  echo 'selected="selected"';
                                                                } ?>>
                        <?php echo $p['p_name']; ?></option>
                  <?php  }
                  } ?>
                </select>
              </div>
              <!-- subname -->
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Subproduct Name
                </label>
                <input class="form-control" id="sub_name" name="sub_name" value="<?php if (!empty($subproduct['sp_name'])) {
                                                                                    echo $subproduct['sp_name'];
                                                                                  } ?>" />
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
                echo $this->ckeditor->editor("sp_description", 'sp_description02', $subproduct['sp_description']);
                ?>
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-xs float-left">
                  Edit
                </button>
                <a href="<?php echo base_url(); ?>admin/sub_products/manage_subproducts/" class="btn btn-dark btn-xs float-end">
                  Back to Listing</a>
              </div>

            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Date (Autogenerado - No obligatorio)
                </label>
                <input type="text" name="p_date" id="p_date" value="<?php if (!empty($subproduct['sp_date'])) {
                                                                      echo $subproduct['sp_date'];
                                                                    } ?>" class="form-control" readonly />
              </div>

              <!-- Preview Image -->
              <div class="mb-3">
                <img src="<?php echo base_url(); ?>assets/images/subproducts/<?php echo $subproduct['sp_id']; ?>/thumbs/<?php echo $subproduct['sp_image'] ?>" style="width:150px;">
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Meta Title (Programador)
                </label>
                <input type="text" name="sp_meta_title" id="sp_meta_title" class="form-control" value="<?php if (!empty($subproduct['sp_meta_title'])) {
                                                                                                          echo $subproduct['sp_meta_title'];
                                                                                                        } ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Meta Description (Programador)
                </label>
                <textarea class="form-control" name="sp_meta_description" id="sp_meta_description"><?php if (!empty($subproduct['sp_meta_description'])) {
                                                                                                      echo $subproduct['sp_meta_description'];
                                                                                                    } ?></textarea>
              </div>


            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>