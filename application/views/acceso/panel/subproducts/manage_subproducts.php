<main>
  <div class="container-fluid px-2">
    <h1 class="mt-4">Maintance SubProducts</h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/sub_products/add_subproduct" class="btn btn-primary btn-xs float-end"><b>+</b> Add new SubProduct</a>

        <a href="#" onclick="delete_item('exp_tbl_sub_products','sp_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Items</a>


      </div>
    </div>

    <div class="card mb-1">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Mantenimiento
      </div>
      <div class="card-body">
        <table id="datatablesSimple" class="table table-custom table-hover ">
          <thead class="table-dark">
            <tr>
              <th align="center" scope="col">
                <input type="checkbox" name="main_checkbox" id="main_checkbox" onclick="checkall();" />
              </th>
              <th>Id</th>
              <th>Name</th>
              <th>Product</th>
              <th>Photo</th>
              <th>Status</th>
              <th>Special</th>
              <th>Order</th>
              <th>Date</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($subproducts)) {
              $cnt = 1;
              foreach ($subproducts as $p) {
                $id = $p['sp_id'];
                if ($p['sp_status'] == '1') {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'sp_status\',\'0\', \'sp_id\',\'' . $id . '\');" />';
                } else {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'sp_status\',\'1\', \'sp_id\',\'' . $id . '\');" />';
                }
                if ($p['special_status'] == '1') {
                  $str_special = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'special_status\',\'0\', \'sp_id\',\'' . $id . '\');" />';
                } else {
                  $str_special = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_sub_products\',\'special_status\',\'1\', \'sp_id\',\'' . $id . '\');" />';
                }
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td>
                    <?php echo $cnt; ?>
                  </td>
                  <td>
                    <?php if (!empty($p['sp_name'])) {
                      echo $p['sp_name'];
                    } ?>
                  </td>
                  <td>
                    <?php
                    if (!empty($p['p_id'])) {
                      $tbl_name = "exp_tbl_products";
                      $col = "p_id";
                      $value = $p['p_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['p_name'])) {
                        echo $result['p_name'];
                      }
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($p['sp_name'])) { ?>
                      <img src="<?php echo base_url(); ?>assets/images/subproducts/<?php echo $p['sp_id'] ?>/thumbs/<?php echo $p['sp_image']; ?>" style="width:80px;height:80px;">
                    <?php } ?>
                  </td>

                  <td>
                    <?php echo $str; ?>
                  </td>

                  <td>
                    <?php echo $str_special; ?>
                  </td>

                  <td>
                    <?php if (!empty($p['sp_order'])) {
                      echo $p['sp_order'];
                    } ?>
                  </td>

                  <td>
                    <?php if (!empty($p['sp_date'])) {
                      echo $p['sp_date'];
                    } ?>
                  </td>

                  <td>
                    <a href="<?php echo base_url(); ?>admin/sub_products/edit_subproduct/<?php echo $id; ?>" class="btn btn-app">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                  </td>


                </tr>
              <?php $cnt++;
              }
            } else { ?>
              <tr>
                <td colspan='8' style='text-align:center'><b>No Record Found</b></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>