<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Maintance Products</h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/products/add_product" class="btn btn-primary btn-xs float-end"><b>+</b> Add new Product</a>

        <a href="#" onclick="delete_product('exp_tbl_products','p_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Items</a>

      </div>
    </div>
    <div class="card mb-2">
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
              <th>Photo</th>
              <th>Estado</th>
              <th>Order</th>
              <th>Date</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($products)) {
              $cnt = 1;
              foreach ($products as $p) {
                $id = $p['p_id'];
                if ($p['p_status'] == '1') {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_products\',\'p_status\',\'0\', \'p_id\',\'' . $id . '\');" />';
                } else {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_products\',\'p_status\',\'1\', \'p_id\',\'' . $id . '\');" />';
                } ## cierro if p_status
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td><?php echo $cnt; ?></td>
                  <td><?php if (!empty($p['p_name'])) {
                        echo $p['p_name'];
                      } ?></td>
                  <td align="center">
                    <img src="<?php echo base_url(); ?>assets/images/products/<?php echo $p['p_id']; ?>/thumbs/<?php echo $p['p_image'] ?>" style="width:80px;">
                  </td>
                  <td align="center"><?php echo $str; ?></td>
                  <td align="center"><?php if (!empty($p['p_order'])) {
                                        echo $p['p_order'];
                                      } ?></td>
                  <td><?php if (!empty($p['date'])) {
                        echo $p['date'];
                      } ?></td>
                  <td align="center">
                    <a href="<?php echo base_url(); ?>admin/products/edit_product/<?php if (!empty($p['p_id'])) {
                                                                                    echo $p['p_id'];
                                                                                  } ?>" class="btn btn-app">
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