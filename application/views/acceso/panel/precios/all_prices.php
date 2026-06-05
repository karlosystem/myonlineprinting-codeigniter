<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
?>
<main>
  <div class="container-fluid px-2">
    <h1 class="mt-4"><?php echo $title; ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/pricing/all_products_pricing" class="btn btn-primary btn-xs float-end"><b>+</b> Add Price</a>

        <a href="#" onclick="delete_item('exp_tbl_pricing','pricing_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Items</a>

      </div>
    </div>
    <div class="card mb-1">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Mantenimiento
      </div>
      <div class="card-body">
        <table id="datatablesSimple" class="table table-custom table-hover">
          <thead class="table-dark">
            <tr>
              <th align="center" scope="col">
                <input type="checkbox" name="main_checkbox" id="main_checkbox" onclick="checkall();" />
              </th>
              <th>Id</th>
              <th>Product</th>
              <th>Subproducts</th>
              <th>Attributes</th>
              <th>Price</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($price_array)) {
              $cnt = 1;
              foreach ($price_array as $a) {
                $id = $a['pricing_id'];
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td>
                    <?php echo $cnt; ?>
                  </td>
                  <td>
                    <?php
                    if (!empty($a['p_id'])) {
                      $tbl_name = "exp_tbl_products";
                      $col = "p_id";
                      $value = $a['p_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['p_name'])) {
                        echo $result['p_name'];
                      }
                    }
                    ?>
                  </td>
                  <td>
                    <?php if (!empty($a['sp_id'])) {

                      $tbl_name = "exp_tbl_sub_products";
                      $col = "sp_id";
                      $value = $a['sp_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['sp_name'])) {
                        echo $result['sp_name'];
                      }
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($a['combination'])) {
                      $c_array = explode(",", $a['combination']);

                      foreach ($c_array as $c) {
                        $tbl_name = "exp_tbl_attribute_values";
                        $col = "value_id";
                        $value = $c;
                        $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                        if (!empty($result['value_name'])) {
                          echo $result['value_name'] . ",<br/>";
                        }
                      }
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($a['price'])) {
                      echo $a['price'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($a['date_add'])) {
                      echo $a['date_add'];
                    } ?>
                  </td>
                  <td align="center">
                    <a href="<?php echo base_url(); ?>admin/pricing/edit_pricing/<?php echo $id; ?>" class="btn btn-app">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                  </td>
                </tr>
              <?php $cnt++;
              }
            } else { ?>
              <tr>
                <td colspan="9" style="text-align:center">No record found</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>



  </div>
</main>