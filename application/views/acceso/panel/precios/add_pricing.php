<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");

//getting quantities
$tbl_name = 'exp_tbl_qty';
$qty_array = $this->common_model->get_all_list($tbl_name);

//getting sizes
$tbl_name1 = 'tbl_size';
$size_array = $this->common_model->get_all_list($tbl_name1);

//
$p_id = $this->uri->segment(4);
$sp_id = $this->uri->segment(5);

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
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body">
          <form action="<?php echo base_url(); ?>admin/pricing/save_price" id="add_pricing_form" name="add_pricing_form" method="POST">
            <input type="hidden" name="p_id" id="p_id" value="<?php echo $p_id; ?>" />
            <input type="hidden" name="sp_id" id="sp_id" value="<?php echo $sp_id; ?>" />

            <?php
            $counter = 0;
            foreach ($attributes_names as  $a) {

              $p_id = $a['p_id'];
              $sp_id = $a['sp_id'];
              $att_id = $a['att_id'];
            ?>
              <div class="mb-3">
                <label>(<?php echo $a['att_id']; ?>) : <?php echo $a['att_name']; ?><span class="red">*</span></label>
                <?php echo get_values($p_id, $sp_id, $att_id, $counter); ?>
              </div>
            <?php $counter++;
            } ?>
            <div class="mb-3">
              <label>Select Quantity<span class="red">*</span></label>
              <select name="quantity" id="quantity" class="form-select">
                <option value="">select qty</option>
                <?php
                if (!empty($qty_array)) {
                  foreach ($qty_array as $q) { ?>
                    <option value="<?php echo $q["qty_id"]; ?>"><?php echo $q["qty_name"] ?></option>
                <?php }
                }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label>Select Size<span class="red">*</span></label>
              <select name="size" id="size" class="form-select">
                <option value="">select size</option>
                <?php
                if (!empty($size_array)) {
                  foreach ($size_array as $s) { ?>
                    <option value="<?php echo $s["size_id"]; ?>"><?php echo $s["size_name"] ?></option>
                <?php }
                }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label>Price<span class="red">*</span></label>
              <input type="text" name="price" id="price" class="form-control" />
            </div>

            <div class="mb-3">
              <div class="float-left">
                <span class="bt_green_lft"></span>
                <input type="submit" value="Save" class="btn btn-primary" />
                <span class="bt_green_r"></span>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>